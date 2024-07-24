<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Wishlist;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'id', 'product_id');
    }

    public function ratingCalculation()
    {
        $ratings =Review::where('product_id', $this->id )->get(); // Fetch all ratings associated with this product
        if ($ratings->isEmpty()) {
            return;
        }
    
        $reviewCount = $ratings->count();
        $starRatingSum = $ratings->sum('star_rating');
    
        $averageRating = $starRatingSum / $reviewCount;
    
        $data = [
            'reviewCount' => $reviewCount,
            'starRating'  => $starRatingSum,
            'averageRating' => $averageRating
        ];
    
        return $data;
    }
}
