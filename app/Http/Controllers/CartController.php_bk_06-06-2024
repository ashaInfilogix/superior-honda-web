<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id'=> 'required',
            'quantity'  => 'required', // Added integer validation and minimum quantity
        ]);

        $productDetail = Product::with('productImages')->findOrFail($request->product_id);
        $productImage = $productDetail->productImages->first();

        $cart = session()->get('cart', []);
        // Check if the product already exists in the cart
        $productExists = false;
        foreach ($cart['products'] ?? [] as $key => $product) {
            if ($product['id'] == $request->product_id) {
                $cart['products'][$key]['quantity'] += $request->quantity;
                $cart['products'][$key]['product_total_amount'] = $product['quantity'] * $product['price'];
                $productExists = true;
                break;
            }
        }

        // If the product doesn't exist, add it to the cart
        if (!$productExists) {
            $cart['products'][] = [
                "id" => $request->product_id,
                "quantity" => $request->quantity,
                "product_code" => $productDetail->product_code,
                "name" => $productDetail->product_name,
                "price" => $productDetail->cost_price,
                "product_total_amount" => $productDetail->cost_price *  $request->quantity,
                "image" => $productImage ? $productImage->images : null
            ];
        }

        // Recalculate cart totals
        $cart_quantity = 0;
        $sub_total = 0;
        foreach ($cart['products'] as $product) {
            $cart_quantity += $product['quantity'];
            $sub_total += $product['quantity'] * $product['price'];
        }
        
        // Update cart totals
        $cart['quantity'] = $cart_quantity;
        $cart['sub_total'] = $sub_total;
        $cart['formatted_sub_total'] = '$'.(number_format($sub_total ,2));
        
        $applied_coupons = $cart['applied_coupons'] ?? [];
        $cart['applied_coupons'] = $applied_coupons;

        if($cart['applied_coupons']) {
            $sub_total -= $cart['discount_amount'];
            $cart['grand_total'] =  $sub_total;
            $cart['formatted_grand_total'] = '$'. Number_Format( $cart['grand_total'] , 2);
            $cart['discount_amount'] = $cart['discount_amount'];
        } else {
            $cart['grand_total'] = $sub_total;
            $cart['formatted_grand_total'] = '$'.(number_format($sub_total ,2));
            $cart['discount_amount'] = '$'. 0.00;
        }
        
        $cart['count']  = count($cart['products']);
        session()->put('cart', $cart);

        if (Auth::check()) {
            $user_id = Auth::id();
            // Save or update cart data in the database
            Cart::updateOrCreate(
                ['user_id' => $user_id],
                ['cart' => json_encode($cart)]
            );
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

     public function update(Request $request)
    {
        if ($request->product_id && $request->qty) {
            $cart = session()->get('cart');
            // Check if the product already exists in the cart
            $productExists = false;
            foreach ($cart['products'] ?? [] as $key => $product) {
                $cart['products'][$key]['product_total_amount'] = $product['quantity'] * $product['price'];
                if ($product['id'] == $request->product_id) {
                    $cart['products'][$key]['quantity'] = $request->qty;
                    $cart['products'][$key]['product_total_amount'] = $request->qty * $product['price'];
                    $productExists = true;
                    break;
                }
            }

            if (!$productExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in the cart.'
                ]);
            }

            // Recalculate cart totals
            $cart_quantity = 0;
            $sub_total = 0;
            foreach ($cart['products'] as $product) {
                $cart_quantity += $product['quantity'];
                $sub_total += $product['quantity'] * $product['price'];
            }

            // Update cart totals
            $cart['quantity'] = $cart_quantity;
            $cart['sub_total'] = $sub_total;
            $cart['formatted_sub_total'] = '$'.(number_format($sub_total ,2));

            $applied_coupons = $cart['applied_coupons'] ?? [];
            $cart['applied_coupons'] = $applied_coupons;

            if($cart['applied_coupons']) {
                $sub_total -= $cart['discount_amount'];
                $cart['grand_total'] =  $sub_total;
                $cart['formatted_grand_total'] = '$'. Number_Format( $cart['grand_total'] , 2);
                $cart['discount_amount'] = $cart['discount_amount'];
            } else {
                $cart['grand_total'] = $sub_total;
                $cart['formatted_grand_total'] = '$'.(number_format($sub_total ,2));
                $cart['discount_amount'] = '$'. 0.00;
            }
            $cart['count']  = count($cart['products']);
            session()->put('cart', $cart);
            if (Auth::check()) {
                $user_id = Auth::id();
                Cart::updateOrCreate(
                    ['user_id' => $user_id],
                    ['cart' => json_encode($cart)]
                );
            }

            return response()->json([
                'success' => true,
                'cart' => $cart,
                'message' => 'Cart quantity updated successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product ID and quantity are required.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Request $request)
    {
        if ($request->product_id) {
            $cart = session()->get('cart');

            foreach ($cart['products'] ?? [] as $key => $product) {
                if ($product['id'] == $request->product_id) {
                    unset($cart['products'][$key]); // Unset the product from the cart
                    break; // Exit the loop once product is found and removed
                }
            }

            // Recalculate cart total quantity
            $cart_quantity = 0;
            foreach ($cart['products'] as $product) {
                $cart_quantity += $product['quantity'];
            }
            // Recalculate cart total amount
            $sub_total = 0;
            foreach ($cart['products'] as $product) {
                $sub_total += $product['price'] * $product['quantity']; // Corrected accessing price
            }

            // Update cart object
            $cart['quantity'] = $cart_quantity;
            $cart['sub_total'] = $sub_total;
            $cart['formatted_sub_total'] = '$' . number_format($sub_total, 2);

            $applied_coupons = $cart['applied_coupons'] ?? [];
            $cart['applied_coupons'] = $applied_coupons;

            if($cart['applied_coupons'] &&  count($cart['products']) > 0) {
                $sub_total -= $cart['discount_amount'];
                $cart['grand_total'] =  $sub_total;
                $cart['formatted_grand_total'] = '$'. Number_Format( $cart['grand_total'] , 2);
                $cart['discount_amount'] = $cart['discount_amount'];
            } else {
                $cart['grand_total'] = $sub_total;
                $cart['formatted_grand_total'] = '$'.(number_format($sub_total ,2));
                $cart['discount_amount'] = '$'. 0.00;
            }

            $cart['count'] = count($cart['products']);

            session()->put('cart', $cart);

            if (Auth::check()) {
                $user_id = Auth::id();
                Cart::updateOrCreate(
                    ['user_id' => $user_id],
                    ['cart' => json_encode($cart)]
                );
            }

            return response()->json([
                'success' => true,
                'cart'    => $cart,
                'message' => 'Product is successfully removed from cart.'
            ]);
        }
    }

    public function clearCart(Request $request)
    {
        $request->session()->flush();

        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        }

        return redirect()->back()->with('success', 'All Products removed from cart');
    }

    public function couponCode(Request $request)
    {
        $couponExists = Coupon::where('coupon_code', $request->coupon_code)
                                ->whereDate('start_date', '<=', now())
                                ->whereDate('end_date', '>=', now())
                                ->where('status', 'Active')
                                ->first();

        if($couponExists) {
            $cart = session()->get('cart');

            $discountAmount = 0;
            if ($couponExists->discount_type === 'percentage') {
                $discountAmount = ($couponExists->discount_amount / 100) * $cart['sub_total'];
            } else if ($couponExists->discount_type === 'fixed') {
                $discountAmount = $couponExists->discount_amount;
            }

            $cart['grand_total'] -= $discountAmount;
            $cart['formatted_grand_total'] = '$'. Number_Format( $cart['grand_total'] , 2);
            $cart['discount_amount'] = $discountAmount;

            $cart['applied_coupons'][] = [
                'id'              => $couponExists->id,
                'coupon_code'     => $couponExists->coupon_code,
                'discount_type'   => $couponExists->discount_type,
                'discount_amount' => $couponExists->discount_amount,
                'use_limit'       => $couponExists->use_limit
            ];

            session()->put('cart', $cart);

            if (Auth::check()) {
                Cart::updateOrCreate(
                    ['user_id' => Auth::id()],
                    ['cart' => json_encode($cart)]
                );
            }

            return response()->json([
                'success' => true,
                'cart'    => $cart,
                'message' => 'Coupon code applied'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Coupon code does not exist or is not valid'
            ]);
        }
    }

    public function checkout()
    {
        $countries = Country::all();
        return view('cart.checkout', compact('countries'));
    }

    public function order(Request $request)
    {
        if (session('cart') && isset(session('cart')['products'])) {
            $phone = NULL;
            $email = NULL;
            $order['billing_address'] = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'postal_code' => $request->postal_code,
            ];

            $order['shipping_address'] = [
                'first_name' => $request->shipping_first_name,
                'last_name' => $request->shipping_last_name,
                'company_name' => $request->shipping_company_name,
                'address' => $request->shipping_address,
                'apartment' => $request->shipping_apartment,
                'city' => $request->shipping_city,
                'country_id' => $request->shipping_country_id,
                'state_id' => $request->shipping_state_id,
                'postal_code' => $request->shipping_postal_code,
            ];

            $field = filter_var($request->input('email_or_phone'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
            if($field == 'email' ) {
                $email = $request->email_or_phone;
            } else {
                $phone = $request->email_or_phone;
            }

            Order::create([
                'user_id'         => Auth::id() ?? NULL,
                'email'           =>  $email,
                'phone_number'    => $phone,
                'billing_address' => json_encode($order['billing_address']),
                'shipping_address'=> json_encode($order['shipping_address']) ?? json_encode($order['billing_address']),
                'cart_items'      => json_encode(session('cart')),
                'order_notes'     => $request->order_notes,
                'payment_details' => Null
            ]);

            $request->session()->flush();

            return redirect()->back();
        } else {
            return redirect()->route('checkout')->with('error', 'Cart is empty.');
        }

    }
}
