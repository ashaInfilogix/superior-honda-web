<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VehicleCategory;
use App\Models\VehicleModel;
use App\Models\VehicleBrand;
use App\Models\VehicleType;
use App\Models\VehicleModelVariant;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::where('cus_id', Auth::id())->latest()->get();

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = VehicleCategory::all();

        return view('vehicles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vehicle::create([
            'cus_id'            => Auth::id(),
            'category_id'       => $request->category_id,
            'brand_id'          => $request->brand_name,
            'model_id'          => $request->model_name,
            'varient_model_id'  => $request->model_variant_name,
            'type_id'           => $request->vehicle_type,
            'vehicle_no'        => $request->vehicle_no,
            'year'              => $request->year,
            'color'             => $request->color,
            'chasis_no'         => $request->chasis_no,
            'engine_no'         => $request->engine_no,
            'additional_details' => $request->additional_detail
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicle = Vehicle::where('id', $vehicle->id)->first();

        $categories = VehicleCategory::all();
        $brands = VehicleBrand::all();
        $vehicleModels = VehicleModel::all();
        $vehicleTypes = VehicleType::all();
        $modelVariants = VehicleModelVariant::all();

        return view('vehicles.edit', compact('vehicle', 'categories', 'brands', 'vehicleModels', 'vehicleTypes','modelVariants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'category_id'  => 'required',
            'vehicle_no'   => 'required',
            'year'         => 'required'
        ]);

        $vehicle = Vehicle::where('id', $vehicle->id)->first();

        $vehicle->update([
            'cus_id'            => Auth::id(),
            'category_id'       => $request->category_id,
            'brand_id'          => $request->brand_name,
            'model_id'          => $request->model_name,
            'varient_model_id'  => $request->model_variant_name,
            'type_id'           => $request->vehicle_type,
            'vehicle_no'        => $request->vehicle_no,
            'year'              => $request->year,
            'color'             => $request->color,
            'chasis_no'         => $request->chasis_no,
            'engine_no'         => $request->engine_no,
            'additional_details' => $request->additional_detail
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        Vehicle::where('id', $Vehicle->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle deleted successfully.'
        ]);
    }

    public function getVehicleBrand(Request $request)
    {
        $vehicleBrands = VehicleBrand::where('category_id', $request->category_id)->get();
        $vehicleTypes = VehicleType::where('category_id', $request->category_id)->get();

        $options='<option value="">Select Brand </option>';
        if($vehicleBrands) {
            foreach($vehicleBrands as $brand)
            {
                $options .= '<option value="'.  $brand->id .'">'. $brand->brand_name	 .'</option>';
            }
        }

        $vehicleTypeOption = '<option value="">Select Vehicle Type</option>';
        if($vehicleTypes) {
            foreach($vehicleTypes as $vehicleType)
            {
                $vehicleTypeOption .= '<option value="'.  $vehicleType->id .'">'. $vehicleType->vehicle_type	 .'</option>';
            }
        }

        return response()->json([
            'options' => $options,
            'vehicleTypeOption' => $vehicleTypeOption
        ]);
    }

    public function getVehicleModel(Request $request)
    {
        $vehicleModels = VehicleModel::where('brand_id', $request->brand_id)->get();
        $options ='<option value="">Select Model</option>';
        foreach($vehicleModels as $model)
        {
            $options .= '<option value="'.  $model->id .'">'. $model->model_name	 .'</option>';
        }

        return response()->json([
            'options' => $options
        ]);
    }

    public function getVehicleModelVariant(Request $request)
    {
        $vehicleModelVariants = VehicleModelVariant::where('model_id', $request->model_id)->get();
        $options='<option value="">Select Model Variant</option>';
        foreach($vehicleModelVariants as $modelVariants)
        {
            $options .= '<option value="'.  $modelVariants->id .'">'. $modelVariants->variant_name	 .'</option>';
        }

        return response()->json([
            'options' => $options
        ]);
    }

}
