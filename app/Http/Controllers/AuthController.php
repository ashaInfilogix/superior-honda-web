<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'password'    => Hash::make('password')
        ])->assignRole('Customer');

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }
}
