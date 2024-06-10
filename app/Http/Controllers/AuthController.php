<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyOtp;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $loginType = $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->input('email_or_phone'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        $credentials[$field] = $request->input('email_or_phone');
        $credentials['password'] = $request->input('password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $cart = session('cart');
            if ($cart && Auth::check()) {
                Cart::updateOrCreate(
                    ['user_id' => Auth::id()],
                    ['cart' => json_encode($cart)]
                );
            }

            $cartData = Cart::where('user_id', Auth::id())->first();
            if ($cartData) {
                $cart = json_decode($cartData->cart, true);
                session()->put('cart', $cart);
            }

            $wishlist = session('wishlist');
            if ($wishlist && Auth::check()) {
                $oldProducts = Wishlist::where('user_id', Auth::id())->delete();
                foreach($wishlist['wishlist-products'] as $key => $value) {
                    Wishlist::create([
                        'user_id' => Auth::id(),
                        'product_id' => $value['product_id']
                    ]);
                }
            }

            $wishlistData = Wishlist::where('user_id', Auth::id())->get();
            $wishlist['wishlist-products'] = [];
            if ($wishlistData) {
                foreach($wishlistData as $key => $wishlistValue) {
                     $wishlist['wishlist-products'][] =  ['product_id' => $wishlistValue->product_id];
                }
                session()->put('wishlist', $wishlist);
            }

            return redirect()->intended('/');
        }

        return back()->with('message','The provided credentials do not match our records.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
        ]);
        User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone_number' => $request->phone_number,
            'password'    => Hash::make($request->password)
        ])->assignRole('Customer');

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user){
            $otp = rand(1000, 9999);
            $data = [
                'otp' => $otp,
                'name' => $request->name,
                'email' => $request->email
            ];

            Mail::to($request->email)->send(new VerifyOtp($data));

            $user->update([
                'otp' => $otp
            ]);

            return response()->json([
                'success'  => true,
                'message'  => 'OTP sent successfully to your email address.',
                'email'     => $request->email
            ]);
        } else {
            return response()->json([
                'success'  => false,
                'message'  => 'User not found',
            ]);

        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp'   => 'required|max:4',
            'email' => 'required'
        ]);

        $otp = User::where('email', $request->email)->first();

        if ($otp && $otp->otp == $request->otp) {
            $otp->update([
                'otp' => NULL
            ]);

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.',
                'email'   => $request->email
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This OTP is not valid please enter valid OTP.',
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'new_password'  => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user) {
            if (Hash::check($request->new_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your old password has been detected. Please select a new and unique password for your account.'
                ]);
            } else {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Password changed successfully.'
                ]);
            }
        }
    }
}
