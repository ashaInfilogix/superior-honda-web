@extends('layouts.app')

@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ route('index')}}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Account</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start login section  -->
    <div class="login__section section--padding">
        <div class="container">
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col">
                            <div class="alert alert-success" id="success-message" style="display: none;"></div>
                            <div class="alert alert-danger" id="error-container" style="display: none;"></div>
                            <div class="account__login">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title mb-10">Login</h2>
                                    <p class="account__login--header__desc">Login if you area a returning customer.</p>
                                </div>

                                @if (session('message'))
                                    <div class="alert alert-danger">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <div class="account__login--inner">
                                    <form method="post" action="{{ route('authenticate') }}" name="login" class="md-float-material form-material">
                                        @csrf
                                        <label>
                                            <input class="account__login--input" name="email_or_phone" placeholder="Email / Phone Number" type="text">
                                        </label>
                                        <label>
                                            <input class="account__login--input" name="password" placeholder="Password" type="password">
                                        </label>
                                        <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                                <span class="checkout__checkbox--checkmark"></span>
                                                <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                    Remember me</label>
                                            </div>
                                            <button class="account__login--forgot"  type="button">Forgot Your Password?</button>
                                        </div>
                                        <button class="account__login--btn primary__btn" type="submit">Login</button>
                                    </form>
                                    <br/>
                                    <p class="account__login--signup__text">Don,t Have an Account? <button type="submit">Sign up now</button></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="account__login register" id="registerBlock">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title mb-10">Create an Account</h2>
                                    <p class="account__login--header__desc">Register here if you are a new customer</p>
                                </div>
                                <div class="account__login--inner">
                                <form method="post" action="{{ route('register') }}" class="md-float-material form-material" name="register">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>
                                                <input class="account__login--input" placeholder="First Name" type="text" name="first_name">
                                            </label>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>
                                                <input class="account__login--input" placeholder="Last Name" type="text" name="last_name">
                                            </label>
                                        </div>
                                    </div>
                                    <label>
                                        <input class="account__login--input" placeholder="Email Addres" type="email" name="email">
                                    </label>
                                    @error('email')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                    @enderror
                                    <label>
                                        <input class="account__login--input" placeholder="Phone Number" type="number" name="phone_number">
                                    </label>
                                    <label>
                                        <input class="account__login--input" placeholder="Password" type="password" name="password" id="password">
                                    </label>
                                    <label>
                                        <input class="account__login--input" placeholder="Confirm Password" type="password"  name="confirm_password">
                                    </label>
                                    <button class="account__login--btn primary__btn mb-10" type="submit">Submit & Register</button>
                                    <div class="account__login--remember position__relative">
                                        <input class="checkout__checkbox--input" id="check2" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label login__remember--label" for="check2">
                                            I have read and agree to the terms & conditions</label>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="account__login forgot-password" id="forgotPasswordBlock" style="display: none;">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title mb-10">Forgot Password</h2>
                                </div>
                                <div class="account__login--inner send-otp">
                                    <form method="post" action="{{ route('forgot-password') }}" class="md-float-material form-material" name="forgot">
                                        @csrf
                                        <label>
                                            <input class="account__login--input" placeholder="Email Addres" type="email" name="email">
                                        </label>
                                        <button class="account__login--btn primary__btn mb-10" type="submit">Submit</button>
                                    </form>
                                </div>

                                <div class="otp-section" style="display: none;">
                                    <form method="post" action="{{ route('verify-otp') }}" class="md-float-material form-material" name="otpForm">
                                        @csrf
                                        <label>
                                            <input type="hidden" name="email" id="forgot-email" value="">
                                            <input class="account__login--input" placeholder="Enter OTP" type="text" name="otp">
                                        </label>
                                        <button class="account__login--btn primary__btn mb-10" type="submit">Verify OTP</button>
                                    </form>
                                </div>

                                <div class="change-password" style="display: none;">
                                    <form method="post" action="#" class="md-float-material form-material" name="change-password">
                                        @csrf
                                        <input type="hidden" name="email" id="change-email" value="">
                                        <label>
                                            <input class="account__login--input" placeholder="New Password" type="password" name="new_password" id="new_password">
                                        </label>
                                        <label>
                                            <input class="account__login--input" placeholder="Confirm Password" type="password"  name="new_confirm_password">
                                        </label>
                                        <button class="account__login--btn primary__btn mb-10" type="submit">Change Password </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>     
    </div>
    <!-- End login section  -->

    <!-- Start shipping section -->
    <section class="shipping__section">
        <div class="container">
            <div class="shipping__inner style2 d-flex">
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">  
                        <img src="{{ asset('assets/images/other/shipping1.webp') }}" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">Free Shipping</h2>
                        <p class="shipping__content--desc">Free shipping over $100</p>
                    </div>
                </div>
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">  
                        <img src="{{ asset('assets/images/other/shipping2.webp')}}" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">Support 24/7</h2>
                        <p class="shipping__content--desc">Contact us 24 hours a day</p>
                    </div>
                </div>
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">  
                        <img src="{{ asset('assets/images/other/shipping3.webp') }}" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">100% Money Back</h2>
                        <p class="shipping__content--desc">You have 30 days to Return</p>
                    </div>
                </div>
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">  
                        <img src="{{ asset('assets/images/other/shipping4.webp') }}" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">Payment Secure</h2>
                        <p class="shipping__content--desc">We ensure secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End shipping section -->
@endsection

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $(".account__login--forgot").click(function(){
                $("#registerBlock").hide();
                $("#forgotPasswordBlock").show();
            });

            $(".account__login--signup__text").click(function(){
                $("#registerBlock").show();
                $("#forgotPasswordBlock").hide();
            });

            $('[name="register"]').validate({
                rules: {
                    first_name: "required",
                    email: "required",
                    phone_number: "required",
                    password: "required",
                    confirm_password: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    first_name: "Please enter first name",
                    email: "Please enter email",
                    phone_number: "Please enter phone_number",
                    password: "Please enter password",
                    confirm_password: {
                        required: 'Please enter confirm password.',
                        equalTo: 'Confirm Password do not match with password.',
                    }
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
        
            $('[name="login"]').validate({
                rules: {
                    email_or_phone: "required",
                    password: "required",
                },
                messages: {
                    email_or_phone: "Please enter your email or phone number.",
                    password: "Please enter your password.",
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

            $('[name="forgot"]').validate({
                rules: {
                    email: "required"
                },
                messages: {
                    email: "Please enter email",
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
                    $.ajax({
                        url: "{{ route('forgot-password')}}",
                        type: "POST",
                        data: $(form).serialize(), // Serialize form data
                        success: function(response) {
                            if(response.success) {
                                $('#forgot-email').val(response.email);
                                // $("#forgotPasswordBlock").show();
                                $('.send-otp').hide();
                                $('.otp-section').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            $('[name="otpForm"]').validate({
                rules: {
                    email: "required",
                    otp: "required",
                },
                messages: {
                    email: "Please enter email",
                    otp: "Please enter Otp."
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
                    $.ajax({
                        url: "{{ route('verify-otp')}}",
                        type: "POST",
                        data: $(form).serialize(), // Serialize form data
                        success: function(response) {
                            if(response.success) {
                                $('#change-email').val(response.email);
                                $('.send-otp').hide();
                                $('.otp-section').hide();
                                $('.change-password').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            $('[name="change-password"]').validate({
                rules: {
                    email: "required",
                    new_password: "required",
                    new_confirm_password: {
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    email: "Please enter email",
                    new_password: "Please enter password",
                    new_confirm_password: {
                        required: 'Please enter confirm password.',
                        equalTo: 'Confirm Password do not match with password.',
                    }
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
                    $.ajax({
                        url: "{{ route('change-password')}}",
                        type: "POST",
                        data: $(form).serialize(), // Serialize form data
                        success: function(response) {
                            if(response.success == true) {
                                $('#success-message').html(response.message);
                                $('#success-message').show();
                                setTimeout(function() {
                                    $('#success-message').fadeOut('slow');
                                }, 3000);
                                $("#registerBlock").show();
                                $('.send-otp').hide();
                                $('.otp-section').hide();
                                $('.change-password').hide();
                            } else {
                                $('#error-container').html(response.message);
                                $('#error-container').show();
                                setTimeout(function() {
                                    $('#error-container').fadeOut('slow');
                                }, 3000);

                            }
                        },
                    });
                }
            });
        });
    </script>
 