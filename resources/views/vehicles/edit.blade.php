@extends('layouts.my-account')

@section('my-account')
    <div class="row">
        <div class="col-md-6">
            <h2 class="account__content--title h3 mb-20">Edit Vehicles</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('vehicles.index') }}" class="primary__btn slider__btn">Go Back
            </a>
        </div>
        <div class="account__table--area">
            <div class="card-block">
                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="account__login--input">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"  @selected($vehicle->category_id ==  $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="model_name" class>Vehicle Type</label>
                            <select class="account__login--input" id="vehicle_type" name="vehicle_type">
                                <option value="" selected disabled>Select Vehicle Type</option>
                                @if($vehicleTypes)
                                    @foreach($vehicleTypes as $vehicleType)
                                        <option value="{{$vehicleType->id}}" @selected($vehicle->type_id == $vehicleType->id)>{{ $vehicleType->vehicle_type }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="brand_name" class>Brand Name</label>
                            <select class="account__login--input" id="brand_name" name="brand_name" placeholder="Select Brand">
                                <option value="" selected disabled>Select Brand</option>
                               @if($brands)
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" @selected($vehicle->brand_id == $brand->id)>{{ $brand->brand_name }}</option>
                                    @endforeach
                               @endif
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="model" class>Model Name</label>
                            <select class="account__login--input" id="model_name" name="model_name">
                                <option value="" selected disabled>Select Model</option>
                                @if($vehicleModels)
                                    @foreach($vehicleModels as $vehicleModel)
                                        <option value="{{$vehicleModel->id}}" @selected($vehicle->model_id == $vehicleModel->id)>{{ $vehicleModel->model_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="model_variant_name" class>Model Variant Name</label>
                            <select class="account__login--input" id="model_variant_name" name="model_variant_name">
                                <option value="" selected disabled>Select Model Variant Name</option>
                                @if($modelVariants)
                                    @foreach($modelVariants as $modelVariants)
                                        <option value="{{$modelVariants->id}}" @selected($vehicle->varient_model_id == $modelVariants->id)>{{ $modelVariants->variant_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <x-input-text name="vehicle_no" label="Vehicle No"
                                value="{{ old('vehicle_no', $vehicle->vehicle_no) }}"></x-input-text>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <x-input-text name="engine_no" label="Engine No"
                                value="{{ old('engine_no', $vehicle->engine_no) }}"></x-input-text>
                        </div>

                        <div class="col-md-6 form-group">
                            <x-input-text name="year" label="Year" value="{{ old('year', $vehicle->year) }}"></x-input-text>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <x-input-text name="color" label="Color" value="{{ old('color', $vehicle->color) }}"></x-input-text>
                        </div>

                        <div class="col-md-6 form-group">
                            <x-input-text name="chasis_no" label="Chasis No"
                                value="{{ old('chasis_no', $vehicle->chasis_no) }}"></x-input-text>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="branch">Additional Detail</label>
                            <textarea id="additional_detail" name="additional_detail" class="account__login--input" rows="2" cols="50">{{ $vehicle->additional_details}}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="primary__btn slider__btn">Save</button>
                </form>
            </div>

        </div>
    </div>
    <x-include-plugins vehicle></x-include-plugins>
@endsection
