<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Wishlist;

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
}
