@extends('layouts.my-account')

@section('my-account')
    <div class="account__content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="account__content--title h3 mb-20">My Profile</h2>
        <div class="card-block">
            <form action="{{ route('profile.update',['profile'=> Auth::id() ])}}" name="create-address" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="account__login--input" value="{{ Auth::user()->first_name }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="account__login--input" value="{{ Auth::user()->last_name }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="account__login--input" value="{{ Auth::user()->email }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="account__login--input" value="{{ Auth::user()->phone_number }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <x-input-text name="phone_lime" label="Phone (Lime)" value="{{ Auth::user()->phone_lime }}" ></x-input-text>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" name="date_of_birth" id="datepicker" class="account__login--input datepicker" value="{{ Auth::user()->date_of_birth }}" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-md-6 form-group">
                        <x-input-text name="lic_no" label="Lic No" value="{{ Auth::user()->lic_no }}" ></x-input-text>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <x-input-text name="address" label="Address" value="{{ Auth::user()->address }}" ></x-input-text>
                    </div>
                </div>
                {{-- <button class="new__address--btn primary__btn">Save Address</button> --}}
                <button type="submit" class="new__address--btn primary__btn mb-25">Save</button>
            </form>
        </div>
    </div>

    <x-include-plugins datePicker></x-include-plugins>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $('[name="create-address"]').validate({
                rules: {
                    first_name: "required",
                    phone_number: "required",
                },
                messages: {
                    first_name: "Please enter first name",
                    phone_number: "Please enter phone number",
                },
                errorClass: "text-danger f-12",
                errorElement: "span",
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

