<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $review = Review::updateOrCreate(
                [
                    'user_id'       => Auth::id(),
                    'product_id'    => $request->product_id,
                ],
                [
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'comments'      => $request->comments,
                    'star_rating'   => $request->rating,
                ]
            );
    
            return response()->json([
                'success' => true,
                'value'   => 1,
                'review'  => $review
            ]);
        } else {
            session()->put('review', $request->all());

            return response()->json([
                'success' => false,
                'value'   => 0
            ]);
        }
    }

    public function show(Review $review)
    {
        return response()->json(['review' => $review]);
    }
}
