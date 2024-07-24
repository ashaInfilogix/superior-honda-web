<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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
		}
		else
		{
			return;
		}
	
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $grandTotal
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('captureTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ]
        ]);

        // if (isset($order['id'])) {
        //     foreach ($order['links'] as $link) {
        //         if ($link['rel'] === 'approve') {
        //             // Redirect the user to the PayPal approval URL
        //             return redirect()->away($link['href']);
        //         }
        //     }
        // }

        return response()->json($order);
    }

//     public function createTransactionCard()
// {
//     $provider = new PayPalClient;
//     $provider->setApiCredentials(config('paypal'));
//     $provider->setAccessToken($provider->getAccessToken());

//     $order = $provider->createOrder([
//         "intent" => "CAPTURE",
//         "purchase_units" => [
//             [
//                 "amount" => [
//                     "currency_code" => "USD",
//                     "value" => "100.00"
//                 ]
//             ]
//         ],
//         "application_context" => [
//             "return_url" => route('captureTransaction'),
//             "cancel_url" => route('cancelTransaction'),
//         ]
//     ]);

//     return response()->json($order);
// }


    public function captureTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $result = $provider->capturePaymentOrder($request->query('token'));

        // You can handle the result as needed, e.g., save to the database, show a success message, etc.
        return response()->json($result);
    }

    public function cancelTransaction()
    {
        // Handle the cancel action, e.g., show a cancel message or redirect to a specific page
        return "Transaction has been canceled";
    }
}
