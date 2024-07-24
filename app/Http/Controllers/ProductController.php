<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\VehicleBrand;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('productImages','wishlist')->latest()->paginate(9);
        foreach($products as $key => $product) {
            $averageRating = $product->ratingCalculation();
            $products[$key]['reviewCount'] = $averageRating['reviewCount'] ?? 0;
            $products[$key]['starRating'] = $averageRating['starRating'] ?? 0;
            $products[$key]['averageRating'] = $averageRating['averageRating'] ?? 0;
        }

        $productCategories = ProductCategory::with('products')->latest()->limit(8)->get();
        $brands = VehicleBrand::latest()->limit(8)->get();
        foreach($productCategories as $key=>$product)
        {
            $productCategories[$key]['items'] = Product::where('category_id', $product->id)->count();
            $productCategories[$key]['productImages'] = ProductImage::where('product_id', $product->id)->first();
        }
        return view('products.index', compact('products', 'productCategories','brands'));
    }

    public function accesories()
    {
        $products = Product::with('productImages','wishlist')->where('access_series', 1)->latest()->paginate(9);
<<<<<<< Updated upstream
=======
        foreach($products as $key => $product) {
            $averageRating = $product->ratingCalculation();
            $products[$key]['reviewCount'] = $averageRating['reviewCount'] ?? 0;
            $products[$key]['starRating'] = $averageRating['starRating'] ?? 0;
            $products[$key]['averageRating'] = $averageRating['averageRating'] ?? 0;
        }
>>>>>>> Stashed changes
        $productCategories = ProductCategory::with('products')->latest()->limit(8)->get();
        $brands = VehicleBrand::latest()->limit(8)->get();
        foreach($productCategories as $key=>$product)
        {
            $productCategories[$key]['items'] = Product::where('category_id', $product->id)->count();
            $productCategories[$key]['productImages'] = ProductImage::where('product_id', $product->id)->first();
        }
        return view('accesories.index', compact('products', 'productCategories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.view');
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
    public function show(Product $product)
    {
        $product = Product::with('productImages')->where('id', $product->id)->first();
        $reviews = Review::where('product_id', $product->id)->latest()->get();

        return view('products.view', compact('product', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function categoryProduct($id)
    {
        $products = Product::with('productImages')->where('category_id', $id)->latest()->paginate(9);

        return view('products.category-product', compact('products'));
    }
}
