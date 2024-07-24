@extends('layouts.my-account')

@section('my-account')
    <div class="row">
        <div class="col-md-6">
            <h2 class="account__content--title h3 mb-20">Add Vehicles</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('vehicles.index') }}" class="primary__btn slider__btn">Go Back
            </a>
        </div>
        <div class="account__table--area">
            <div class="card-block">
                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="account__login--input">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="model_name" class>Vehicle Type</label>
                            <select class="account__login--input" id="vehicle_type" name="vehicle_type">
                                <option value="" selected disabled>Select Vehicle Type</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="brand_name" class>Brand Name</label>
                            <select class="account__login--input" id="brand_name" name="brand_name">
                                <option value="" selected disabled>Select Brand</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="model_name" class>Model Name</label>
                            <select class="account__login--input" id="model_name" name="model_name">
                                <option value="" selected disabled>Select Model</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="model_variant_name" class>Model Variant Name</label>
                            <select class="account__login--input" id="model_variant_name" name="model_variant_name">
                                <option value="" selected disabled>Select Model Variant Name</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <x-input-text name="vehicle_no" label="Vehicle No"
                                value="{{ old('vehicle_no') }}"></x-input-text>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <x-input-text name="engine_no" label="Engine No"
                                value="{{ old('engine_no') }}"></x-input-text>
                        </div>

                        <div class="col-md-6 form-group">
                            <x-input-text name="year" label="Year" value="{{ old('year') }}"></x-input-text>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <x-input-text name="color" label="Color" value="{{ old('color') }}"></x-input-text>
                        </div>

                        <div class="col-md-6 form-group">
                            <x-input-text name="chasis_no" label="Chasis No"
                                value="{{ old('chasis_no') }}"></x-input-text>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="branch">Additional Detail</label>
                            <textarea id="additional_detail" name="additional_detail" class="account__login--input" rows="2" cols="50"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="primary__btn slider__btn">Save</button>
                </form>
            </div>

        </div>
    </div>
    <x-include-plugins vehicle></x-include-plugins>
@endsection
