<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wishlists.index');
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
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }

    public function wishlistAddRemove(Request $request)
    {
        if(auth()->check()) {
            $wishlist = Wishlist::where('product_id', $request->product_id)
                                ->where('user_id', auth()->id())
                                ->first();
            if($wishlist) {
                $wishlist->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist successfully',
                ]);
            } else {
                Wishlist::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to wishlist successfully',
                ]);
            }
        } else {
            return redirect()->route('login');
        }
    }
}
