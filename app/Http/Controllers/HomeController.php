<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\VehicleBrand;
use App\Models\ProductImage;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesProduct;
use App\Models\Review;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function showHomePage()
    {
        $today = Carbon::now();
    	$productCategory = ProductCategory::get();
        $mainBanners = Banner::with('product')->where('type', 'main_banner')->where('status', 'active')->get();
        $sideBanners = Banner::with('product')->where('type', 'side_banner')->where('size', '250*165 px')->where('status', 'active')->get();
        $leftBanners = Banner::with('product')->where('type', 'side_banner')->where('size', '435*202 px')->where('status', 'active')->get();
        $centerBanners = Banner::with('product')->where('type', 'center_banner')->where('size', '435*202 px')->where('status', 'active')->get();
        $rightBanners = Banner::with('product')->where('type', 'side_banner')->where('size', '280*547 px')->where('status', 'active')->get();
        $salesProducts = SalesProduct::with('product')->where('status', 0)->whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->get();

        foreach( $salesProducts as $salesKey => $salesProduct) {
            $salesProducts[$salesKey]['productImages'] = ProductImage::where('product_id', $salesProduct->product_id)->get();
            $review = Review::where('product_id', $salesProduct->product_id);
            $totalStarRating = $review->sum('star_rating');
            $reviewCount = $review->count();
            if ($reviewCount > 0) {
                $averageRating = $totalStarRating / $reviewCount;
            } else {
                $averageRating = 0; // Default to zero or any other handling logic
            }
            
            $salesProducts[$salesKey]['reviewRating'] = $averageRating;
            $salesProducts[$salesKey]['reviewCount'] = $reviewCount;
        }
        $productData = [];
    	$propularData = [];
    	foreach ($productCategory as $key => $value)
        {
    		$productData[$value->name] = [
    			'productData' => $this->getProductsDetailsWithImages($value->id),
    			'id'=>$value->id,
    			'cat_image'=> $value->category_images
    		];

    	}

    	return view('index')->with([
                                'mainBanners'   => $mainBanners,
                                'sideBanners'   => $sideBanners,
                                'centerBanners' => $centerBanners,
                                'rightBanners'  => $rightBanners,
                                'leftBanners'   => $leftBanners,
                                'productData'   => $productData,
                                'salesProducts' => $salesProducts,
                                'popularProductData' => $this->getPopularProductsDetailsWithImages()
                            ]);
    }

    private function getProductsDetailsWithImages($category_id)
    {
        $dataToReturn = [];
        $productsData = Product::where('category_id',$category_id)->whereNull('deleted_at')->limit(8)->get();
        foreach ($productsData as $key => $value) {
            # code...
            $productImages = ProductImage::where('product_id',$value->id)->get();

            $value['productsImages'] = $productImages;
            $dataToReturn[] = $value;
        }
        return $dataToReturn;
    }

    private function getPopularProductsDetailsWithImages()
    {
        $dataToReturn = [];
        $productsData = Product::where('popular',1)->whereNull('deleted_at')->limit(8)->get();
        foreach ($productsData as $key => $value) {
            # code...
            $productImages = ProductImage::where('product_id',$value->id)->get();

            $value['productsImages'] = $productImages;
            $dataToReturn[] = $value;
        }
        return $dataToReturn;
    }
}
