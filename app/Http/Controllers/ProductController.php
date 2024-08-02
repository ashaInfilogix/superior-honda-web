<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\VehicleBrand;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;

        $products = Product::with('ProductCategory','productImages','wishlist')->whereHas('productCategory', function ($query) {
                        $query->whereNull('deleted_at');
                    });
        if($request->search) {
            $products = $products->where('product_name', 'like', '%' . $request->search . '%' );
        }
        if($request->brandId) {
            $products  = $products->where('brand_id', $request->brandId);
        }
        $products = $products->latest()->paginate($perPage);

        if($request->page > $products->lastPage()){
            return redirect()->to('/products?perPage='.$perPage.'&page='.$products->lastPage());
        }

        foreach($products as $key => $product) {
            $averageRating = $product->ratingCalculation();
            $products[$key]['reviewCount'] = $averageRating['reviewCount'] ?? 0;
            $products[$key]['starRating'] = $averageRating['starRating'] ?? 0;
            $products[$key]['averageRating'] = $averageRating['averageRating'] ?? 0;
        }

        $topRatedProducts = Product::with(['productImages', 'ProductCategory'])
                            ->select('products.id', 'products.product_name', 'products.cost_price')
                            ->join('reviews', 'products.id', '=', 'reviews.product_id')
                            ->selectRaw('AVG(reviews.star_rating) as averageRating')
                            ->selectRaw('SUM(reviews.star_rating) as totalStarRating')
                            ->selectRaw('COUNT(reviews.product_id) as reviewCount')
                            ->whereHas('ProductCategory', function ($query) {
                                $query->whereNull('deleted_at');
                            })
                            ->groupBy('products.id', 'products.product_name', 'products.cost_price')
                            ->orderBy('averageRating', 'desc')->limit(3)->get();

        $brands = VehicleBrand::latest()->limit(8)->get();

        $productCategories = ProductCategory::with('products')->latest()->limit(8)->get();
        foreach($productCategories as $key=> $product)
        {
            $productCategories[$key]['items'] = Product::where('category_id', $product->id)->count();
            $productCategories[$key]['productImages'] = ProductImage::where('product_id', $product->id)->first();
        }

        if ($request->ajax()) {
            $productsHtml = view('products.partisal.products', compact('products'))->render();
            $paginationHtml = $products->appends(['perPage' => $perPage])->links()->render();
            return response()->json([
                'success'   => true,
                'productsHtml' => $productsHtml,
            ]);
        }

        return view('products.index', compact('products', 'productCategories','brands', 'topRatedProducts','perPage'));
    }

    public function accesories(Request $request)
    {
        $products = Product::with('ProductCategory','productImages','wishlist')->whereHas('productCategory', function ($query) {
                            $query->whereNull('deleted_at');
                        })->where('access_series', 1);

        if($request->brandId) {
            $products  = $products->where('brand_id', $request->brandId);
        }
                        
        $products  = $products->latest()->paginate(9);

        foreach($products as $key => $product) {
            $averageRating = $product->ratingCalculation();
            $products[$key]['reviewCount'] = $averageRating['reviewCount'] ?? 0;
            $products[$key]['starRating'] = $averageRating['starRating'] ?? 0;
            $products[$key]['averageRating'] = $averageRating['averageRating'] ?? 0;
        }

        $topRatedProducts = Product::with(['productImages', 'ProductCategory'])
                                ->select('products.id', 'products.product_name', 'products.cost_price')
                                ->join('reviews', 'products.id', '=', 'reviews.product_id')
                                ->selectRaw('AVG(reviews.star_rating) as averageRating')
                                ->selectRaw('SUM(reviews.star_rating) as totalStarRating')
                                ->selectRaw('COUNT(reviews.product_id) as reviewCount')
                                ->whereHas('ProductCategory', function ($query) {
                                    $query->whereNull('deleted_at');
                                })
                                ->groupBy('products.id', 'products.product_name', 'products.cost_price')
                                ->orderBy('averageRating', 'desc')->where('access_series', 1)->limit(3)->get();

        $productCategories = ProductCategory::with('products')->latest()->limit(8)->get();
        $brands = VehicleBrand::latest()->limit(8)->get();
        foreach($productCategories as $key=>$product)
        {
            $productCategories[$key]['items'] = Product::where('category_id', $product->id)->count();
            $productCategories[$key]['productImages'] = ProductImage::where('product_id', $product->id)->first();
        }

        if ($request->ajax()) {
            $productsHtml = view('products.partisal.products', compact('products'))->render();
            return response()->json([
                'success'   => true,
                'productsHtml' => $productsHtml,
            ]);
        }

        return view('accesories.index', compact('products', 'productCategories','brands','topRatedProducts'));
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
        $averageRating = $product->ratingCalculation();
        $product['reviewCount'] = $averageRating['reviewCount'] ?? 0;
        $product['starRating'] = $averageRating['starRating'] ?? 0;
        $product['averageRating'] = $averageRating['averageRating'] ?? 0;

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
