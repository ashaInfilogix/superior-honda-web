<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Empty Check for the wishlists.
        $wishlists  = [];
        $sessionProduct = session('wishlist');
        if($sessionProduct) {
            $product_ids = array_column($sessionProduct['wishlist-products'], 'product_id');
            $wishlists = Product::whereNull('deleted_at')->with('productImages')->wherein('id', $product_ids)->latest()->get();
            foreach($wishlists as $key => $wishlist) {
                $productImage = ProductImage::where('product_id', $wishlist->id)->first();
                $wishlists[$key]['product_image'] =  optional($productImage)->images;
            }
        }
        $products = Product::whereNull('deleted_at')->with('productImages', 'wishlist')->latest()->take(5)->get();
        return view('wishlists.index', compact('wishlists', 'products'));
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
        $wishlist = session()->get('wishlist', ['wishlist-products' => []]);
        $productId = $request->product_id;

        $wishlistProducts = $wishlist['wishlist-products'];
        $productExists = false;

        foreach ($wishlistProducts as $key => $product) {
            if ($product['product_id'] == $productId) {
                unset($wishlistProducts[$key]);
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $wishlistProducts[] = ['product_id' => $productId];
        }

        $wishlistProducts = array_values($wishlistProducts);

        $wishlist['wishlist-products'] = $wishlistProducts;

        $wishlist['count']  = count($wishlist['wishlist-products']);
        session()->put('wishlist', $wishlist);

        if(Auth::check()) {
            $oldProducts = Wishlist::where('user_id', Auth::id())->delete();
            foreach($wishlist['wishlist-products'] as $key => $value) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $value['product_id']
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product ' . ($productExists ? 'removed from' : 'added to') . ' wishlist successfully!',
            'wishlist' => $wishlist,
        ]);
    }


}
