<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Product::with('ProductCategory','productImages')->whereHas('productCategory', function ($query) {
            $query->whereNull('deleted_at');
        })->where('is_service', 1)->whereNull('deleted_at')->latest()->get();
        // $services = Service::latest()->get();
        $reviews = Review::with('user')->latest()->take(5)->get();
        $settingEmail   = Setting::where('key','email')->first();
        $settingContact = Setting::where('key','contact')->first();

        return view('services.index', compact('services','reviews', 'settingEmail', 'settingContact'));
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
    public function show(Service $service)
    {
        $service = Product::where('id', $service->id)->with('ProductCategory')->whereHas('productCategory', function ($query) {
            $query->whereNull('deleted_at');
        })->where('is_service', 1)->latest()->first();

        $service['productImages'] = ProductImage::where('product_id', $service->id)->pluck('images')->first();

        $settingEmail   = Setting::where('key','email')->first();
        $settingContact = Setting::where('key','contact')->first();

        return view('services.view', compact('service', 'settingEmail', 'settingContact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
