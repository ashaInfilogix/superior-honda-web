<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Banner extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function scopeWithActiveProducts($query)
    {
        return $query->whereHas('product', function($query) {
            $query->whereNull('deleted_at'); // Filter for active products
        });
    }
}
