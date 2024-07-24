<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\VehicleBrand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{

    public function showHomePage(){

    	$productCategory = ProductCategory::get();
    	$productData = [];
    	
    	foreach ($productCategory as $key => $value) {
    		# code...
    		
    		$productData[$value->name] = [
    			'productData' => $this->getProductsDetailsWithImages($value->id),
    			'id'=>$value->id,
    			'cat_image'=> $value->category_images
    		];

    	}
    	// echo "<pre>";
    	// print_r($productData);
    	// die;
    	return view('index')->with(
    								[
    									'productData'=>$productData,
                                        'popularProductData' => $this->getPopularProductsDetailsWithImages($value->id)
    								]
    							  );
    }
    private function getProductsDetailsWithImages($category_id)
    {
            $dataToReturn = [];
            $productsData = Product::where('category_id',$category_id)->get();
            foreach ($productsData as $key => $value) {
                # code...
                $productImages = ProductImage::where('product_id',$value->id)->get();

                $value['productsImages'] = $productImages;
                $dataToReturn[] = $value;
            }
            return $dataToReturn;
    }
    private function getPopularProductsDetailsWithImages($category_id)
    {
            $dataToReturn = [];
            $productsData = Product::where('popular',1)->get();
            foreach ($productsData as $key => $value) {
                # code...
                $productImages = ProductImage::where('product_id',$value->id)->get();

                $value['productsImages'] = $productImages;
                $dataToReturn[] = $value;
            }
            return $dataToReturn;
    }
}
