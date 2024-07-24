<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Country;
use App\Models\State;
use App\Models\EmailTemplate;
use App\Mail\OrderEmail;

class PayPalController extends Controller
{
	public function createTransaction($order_id = null)
	{
		$provider = new PayPalClient;
		$provider->setApiCredentials(config('paypal'));
		$provider->setAccessToken($provider->getAccessToken());
		$grandTotal = 0;

		if (session('cart') && isset(session('cart')['products'])) {
			$grandTotal = session('cart')['grand_total'];
		} else {
			return;
		}

		$order = $provider->createOrder([
			"intent" => "CAPTURE",
			"purchase_units" => [
				[
					"reference_id" => $order_id,
					"amount" => [
						"currency_code" => "USD",
						"value" => $grandTotal
					]
				]
			],
			"application_context" => [
				"return_url" => route('captureTransaction', ['order_id' => $order_id]),
				"cancel_url" => route('cancelTransaction'),
			]
		]);

		return response()->json([
			'orderID' => $order['id'],
			'order_id' => $order_id,
			'links' => $order['links']
		]);
	}

	public function captureTransaction(Request $request)
	{
		$provider = new PayPalClient;
		$provider->setApiCredentials(config('paypal'));
		$provider->setAccessToken($provider->getAccessToken());

		$order_id = $request->query('order_id');
		$result = $provider->capturePaymentOrder($request->query('token'));
		$invoice = $this->sendInvoice($order_id, $result);
		// Use the order_id as needed, for example, save it to the database
		// DB::table('orders')->where('id', $order_id)->update(['paypal_status' => $result['status']]);

        $request->session()->forget('cart');

		return response()->json([
			'order_id' => $order_id,
			'result' => $result
		]);
	}

	public function cancelTransaction()
	{
		// Handle the cancel action, e.g., show a cancel message or redirect to a specific page
		return "Transaction has been canceled";
	}

	public function sendInvoice($order_id, $result)
	{
		$orderData = Order::where('order_id', $order_id)->first();
		

		$email = $orderData->email;
		$invoice = Invoice::orderByDesc('invoice_no')->first();
			if (!$invoice) {
				$invCode =  'INV0001';
			} else {
				$numericPart = (int)substr($invoice->invoice_no, 3);
				$nextNumericPart = str_pad($numericPart + 1, 4, '0', STR_PAD_LEFT);
				$invCode = 'INV' . $nextNumericPart;
			}

			$invoiceData = Invoice::create([
				'user_id' => Auth::id(),
				'order_id'=> $orderData->id,
				'invoice_no' => $invCode
			]);

			$orderPdfData = Order::where('id', $invoiceData->order_id)->first();
			$billingAddress = json_decode($orderPdfData->billing_address, true);
			$shippingAddress = json_decode($orderPdfData->shipping_address, true);
			$cartItems = json_decode($orderPdfData->cart_items, true);
			if($invoiceData) {

				$countryBillingAddress = Country::where('id', $billingAddress['country_id'])->first();
				if ($countryBillingAddress) {
					$billingAddress['country_name'] = $countryBillingAddress->name;
				}

				$stateBillingAddress = State::where('id', $billingAddress['state_id'])->first();
				if ($stateBillingAddress) {
					$billingAddress['state_name'] = $stateBillingAddress->name;
				}

				$countryShippingAddress = Country::where('id', $shippingAddress['country_id'])->first();
				if ($countryShippingAddress) {
					$shippingAddress['country_name'] = $countryShippingAddress->name;
				}

				$stateShippingAddress = State::where('id', $shippingAddress['state_id'])->first();
				if ($stateShippingAddress) {
					$shippingAddress['state_name'] = $stateShippingAddress->name;
				}

				$orderPdfData->billingAddress = $billingAddress;
				$orderPdfData->shippingAddress = $shippingAddress;
				$orderPdfData->cart_items = $cartItems;
				$orderPdfData->invoiceNo = $invoiceData->invoice_no;

				$pdf = PDF::loadView('invoice.view', compact('orderPdfData'));
				$filePath = storage_path('app/public/invoice'.$invoiceData->id.'.pdf');
				$pdf->save($filePath);
	
				Mail::send('email.invoice', ['orderPdfData' => $orderPdfData], function ($message) use ($email, $filePath) {
					$message->to($email)
							->subject('Your Invoice')
							->attach($filePath);
				});

				if (file_exists($filePath)) {
					unlink($filePath);
				}
			}

			$emailTemplate = EmailTemplate::where('email_template', 'order')->first();
			if($emailTemplate) {
				$orderSummary = '';
				foreach (session('cart')['products'] as $key =>  $item) {
					$orderSummary .= "Item " . ($key + 1) . " : $item[name], Quantity: $item[quantity], Price: $item[price]";
					$orderSummary .= "<br>";
				}

					$replacements = [
						'{{user_name}}' => $billingAddress['first_name'].' '.$billingAddress['last_name'],
						'{{order_id}}'  => $order_id,
						'{{created_at}}' => now(),
						'{{order_summary}}' => $orderSummary,
						'{{formatted_grand_total}}' => session('cart')['formatted_grand_total'],
						'{{logo}}' => 'your_logo_url',
						'{{date}}' => date('Y')
					];

				$content = str_replace(array_keys($replacements), array_values($replacements), $emailTemplate->content);
				Mail::to($email)->send(new OrderEmail($content));
			}

			$orderData->update([
				'payment_id'     => $result['id'],
				'payment_status' => json_encode($result['payment_source'])
			]);

		return $invoice;
	}
}
