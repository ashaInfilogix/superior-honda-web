@extends('layouts.app')
<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}&currency=USD"></script>
<style>
    
    /* Style for the popup background */
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
    }

    /* Popup content */
    .popup-content {
        background-color: white;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        max-width: 500px; /* Maximum width */
        border-radius: 10px;
    }

    /* Close button */
    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start checkout page area -->
    <div class="checkout__page--area section--padding">
        <div class="container">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <form name="checkout" method="post" id="checkout">
                @csrf
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="main checkout__mian">
                            <div class="checkout__content--step section__contact--information">
                                <div
                                    class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                    <h2 class="section__header--title h3">Contact information</h2>
                                    <p class="layout__flex--item">
                                        Already have an account?
                                        <a class="layout__flex--item__link" href="{{ route('login') }}">Log in</a>
                                    </p>
                                </div>
                                <div class="customer__information">
                                    <div class="checkout__email--phone mb-12">
                                        <div class="col-12 mb-20">
                                            <input class="checkout__input--field border-radius-5" placeholder="Email" type="text" name="email">
                                        </div>

                                        <div class="col-12 mb-20">
                                            <input class="checkout__input--field border-radius-5" placeholder="Phone number" type="text" name="phone_number">
                                        </div>
                                    </div>
                                    {{-- <div class="checkout__checkbox">
                                        <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label" for="check1">
                                            Email me with news and offers</label>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="checkout__content--step section__shipping--address">
                                <div class="section__header mb-25">
                                    <h2 class="section__header--title h3">Billing Details</h2>
                                </div>
                                <div class="section__shipping--address__content">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                            <div class="checkout__input--list ">
                                                <label class="checkout__input--label" for="input1">Fist Name <span
                                                        class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5"
                                                    placeholder="First name (optional)" id="input1" type="text"
                                                    name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label" for="input2">Last Name <span
                                                        class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5"
                                                    placeholder="Last name" id="input2" type="text" name="last_name">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label" for="input3">Company Name <span
                                                        class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5"
                                                    placeholder="Company (optional)" id="input3" type="text"
                                                    name="company_name">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label" for="input4">Address <span
                                                        class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="Address1"
                                                    id="input4" type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <input class="checkout__input--field border-radius-5"
                                                    placeholder="Apartment, suite, etc. (optional)" type="text"
                                                    name="apartment">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label" for="input5">Town/City <span
                                                        class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5" placeholder="City"
                                                    id="input5" type="text" name="city">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label" for="country">Country/region
                                                    <span class="checkout__input--label__star">*</span></label>
                                                <div class="checkout__input--select select">
                                                    <select id="country" name="country_id"
                                                        class="checkout__input--select__field border-radius-5">
                                                        <option>Select Country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label class="checkout__input--label" for="input12">State
                                                <span class="checkout__input--label__star">*</span></label>
                                            <select id="state" name="state_id"
                                                class="checkout__input--select__field ">
                                                <option>Select State</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <div class="checkout__input--list">
                                                <label class="checkout__input--label" for="input6">Postal Code
                                                    <span class="checkout__input--label__star">*</span></label>
                                                <input class="checkout__input--field border-radius-5"
                                                    placeholder="Postal code" id="input6" type="text"
                                                    name="postal_code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <details class ="shippingAddress" open>
                                    <summary class="checkout__checkbox mb-20" >
                                        <input class="checkout__checkbox--input" id="checkbox" type="checkbox" checked>
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <span class="checkout__checkbox--label">Ship to a different address?</span>
                                    </summary>
                                    <div class="section__shipping--address__content">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                <div class="checkout__input--list ">
                                                    <label class="checkout__input--label" for="input7">Fist Name
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="First name (optional)" id="input7" type="text"
                                                        name="shipping_first_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label" for="input8">Last Name
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Last name" id="input8" type="text"
                                                        name="shipping_last_name">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label" for="input9">Company Name
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Company (optional)" id="input9" type="text"
                                                        name="shipping_company_name">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label" for="input10">Address
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Address1" id="input10" type="text"
                                                        name="shipping_address">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Apartment, suite, etc. (optional)" type="text"
                                                        name="shipping_apartment">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label" for="input11">Town/City
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="City" id="input11" type="text"
                                                        name="shipping_city">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label" for="country2">Country/region
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <div class="checkout__input--select select">
                                                        <select id="shipping_country" name="shipping_country_id"
                                                            class="checkout__input--select__field border-radius-5">
                                                            <option>Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label class="checkout__input--label" for="input12">State
                                                <span class="checkout__input--label__star">*</span></label>
                                                <select id="shipping_state" name="shipping_state_id"
                                                    class="checkout__input--select__field ">
                                                    <option>Select State</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label" for="input12">Postal Code
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Postal code" id="input12" type="text"
                                                        name="shipping_postal_code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </details>
                                {{-- <div class="checkout__checkbox">
                                    <input class="checkout__checkbox--input" id="checkbox2" type="checkbox">
                                    <span class="checkout__checkbox--checkmark"></span>
                                    <label class="checkout__checkbox--label" for="checkbox2">
                                        Save this information for next time</label>
                                </div> --}}
                            </div>
                            <div class="order-notes mb-20">
                                <label class="checkout__input--label" for="order">Order Notes <span
                                        class="checkout__input--label__star">*</span></label>
                                <textarea class="checkout__notes--textarea__field border-radius-5" id="order" name="order_notes"
                                    placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"></textarea>
                            </div>
                            <div class="checkout__content--step__footer d-flex align-items-center">
                                <a class="continue__shipping--btn primary__btn border-radius-5"
                                    href="{{ route('index') }}">Continue
                                    To Shipping</a>
                                <a class="previous__link--content" href="{{ route('cart') }}">Return to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                            <div class="cart__table checkout__product--table">
                                <table class="cart__table--inner">
                                    <tbody class="cart__table--body">
                                        @if (session('cart') && isset(session('cart')['products']))
                                            @foreach (session('cart')['products'] as $key => $product)
                                                <tr class="cart__table--body__items">
                                                    <td class="cart__table--body__list">
                                                        <div class="product__image two  d-flex align-items-center">
                                                            <div class="product__thumbnail border-radius-5">
                                                                <a class="display-block" href="#"><img
                                                                        class="display-block border-radius-5"
                                                                        src="{{ env('BASE_IMAGE_PATH')}}{{$product['image'] }}"
                                                                        alt="cart-product"></a>
                                                                <span
                                                                    class="product__thumbnail--quantity">{{ $product['quantity'] }}</span>
                                                            </div>
                                                            <div class="product__description">
                                                                <h4 class="product__description--name"><a
                                                                        href="#">{{ $product['name'] }}</a>
                                                                </h4>
                                                                <span class="product__description--variant">Product Code:
                                                                    {{ $product['product_code'] }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cart__table--body__list">
                                                        <span
                                                            class="cart__price">${{ number_format($product['price'], 2) }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <h3 class="font-bold text-center mt-5">{{__('Cart is empty')}}</h3>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="checkout__discount--code d-flex">
                                <form class="d-flex" action="#">
                                    <label>
                                        <input class="checkout__discount--code__input--field border-radius-5"
                                            name="coupon-code" id="coupon-code"
                                            @isset(session('cart')['applied_coupons']['coupon_code']) value=" {{ session('cart')['applied_coupons']['coupon_code'] }}"  @endisset
                                            placeholder="Gift card or discount code" type="text">
                                        <div class="error-message text-danger"></div>
                                    </label>
                                    @isset(session('cart')['applied_coupons']['coupon_code'])
                                    <button class="checkout__discount--code__btn primary__btn border-radius-5 remove-code" data-type="remove" type="button" >Remove Coupon</button>
                                    <button class="checkout__discount--code__btn primary__btn border-radius-5 coupon-code" data-type="applied" type="button" hidden>Apply Coupon</button>
                                @else
                                    <button class="checkout__discount--code__btn primary__btn border-radius-5 remove-code" data-type="remove" type="button" hidden>Remove Coupon</button>
                                    <button class="checkout__discount--code__btn primary__btn border-radius-5 coupon-code" data-type="applied" type="button">Apply Coupon</button>
                                @endif
                                </form>
                            </div>
                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Subtotal </td>
                                            <td class="checkout__total--amount text-right totalAmount">
                                                @isset(session('cart')['formatted_sub_total'])
                                                    {{ session('cart')['formatted_sub_total'] }}
                                                @endisset
                                            </td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Shipping</td>
                                            <td class="checkout__total--calculated__text text-right">Calculated at next
                                                step
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="checkout__total--footer">
                                        <tr class="checkout__total--footer__items">
                                            <td
                                                class="checkout__total--footer__title checkout__total--footer__list text-left">
                                                Total </td>
                                            <td
                                                class="checkout__total--footer__amount checkout__total--footer__list text-right grandTotal">
                                                @isset(session('cart')['formatted_grand_total'])
                                                    {{ session('cart')['formatted_grand_total'] }}
                                                @endisset
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment__history mb-30">
                                <h3 class="payment__history--title mb-20">Payment</h3>
                                <ul class="payment__history--inner d-flex">
                                    <!-- <li class="payment__history--list"><button class="payment__history--link primary__btn"
                                            type="submit">Credit Card</button></li>
                                    <li class="payment__history--list"><button class="payment__history--link primary__btn"
                                            type="submit">Bank Transfer</button></li>
                                    <li class="payment__history--list"><button class="payment__history--link primary__btn"
                                            type="submit">Paypal</button></li> -->
                                </ul>
                            </div>
                            <button class="checkout__now--btn primary__btn" type="button" id="submit_checkout">Checkout Now</button>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End checkout page area -->

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
                        <img src="{{ asset('assets/images/other/shipping2.webp') }}" alt="icon-img">
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
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Select A Payment</h2>
            <div id="paypal-button-container"></div>

        </div>
    </div>

    <div id="loader" style="display: none;">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="L" class="letters-loading">
                        L
                    </span>
    
                    <span data-text-preloader="O" class="letters-loading">
                        O
                    </span>
    
                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>
    
                    <span data-text-preloader="D" class="letters-loading">
                        D
                    </span>
    
                    <span data-text-preloader="I" class="letters-loading">
                        I
                    </span>
    
                    <span data-text-preloader="N" class="letters-loading">
                        N
                    </span>
    
                    <span data-text-preloader="G" class="letters-loading">
                        G
                    </span>
                </div>
            </div>
    
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
    <!-- End shipping section -->
@endsection
@section('script')
    <script>
        const checkbox = document.querySelector('.checkout__checkbox--input');
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                $('.shippingAddress').prop('open', true);
                $('.checkbox').prop('checked', true);
            } else {
                $('.shippingAddress').prop('open', false);
                $('.checkbox').prop('checked', false);
            }
        });

        $(function() {
            $('[name="checkout"]').validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    email: "required",
                    phone_number: "required",
                    address: "required",
                    apartment: "required",
                    city: "required",
                    postal_code: "required",
                    state: "required",
                    country: "required",
                    shipping_address: {
                        required: function() {
                            return $('.checkout__checkbox--input').is(':checked');
                        }
                    },
                    shipping_apartment: {
                        required: function() {
                            return $('.checkout__checkbox--input').is(':checked');
                        }
                    },
                    shipping_city: {
                        required: function() {
                            return $('.checkout__checkbox--input').is(':checked');
                        }
                    },
                    shipping_country_id: {
                        required: function() {
                            var isChecked = $('.checkout__checkbox--input').is(':checked');
                            console.log('Checkbox checked:', isChecked);
                            return isChecked;
                        }
                    },
                    shipping_state_id: {
                        required: function() {
                            return $('.checkout__checkbox--input').is(':checked');
                        }
                    },
                    shipping_postal_code: {
                        required: function() {
                            return $('.checkout__checkbox--input').is(':checked');
                        }
                    }
                },
                messages: {
                    email: "Please enter your email.",
                    phone_number: "Please enter your phone number.",
                    address: "Please enter address",
                    apartment: "Please enter apartment name etc.",
                    city: "Please enter city",
                    postal_code: "Please enter postal code",
                    state: "Please enter state",
                    country: "Please enter country",
                    shipping_address: "Please ente address",
                    shipping_apartment: "Please enter apartment",
                    shipping_city: "Please enter city",
                    shipping_postal_code: "Please enter postal code",
                    shipping_country_id: "Please enter country",
                    shipping_state_id: "Please enter state"
                },
                errorClass: "text-danger f-12",
                errorElement: "span",
                /* errorPlacement: function(error, element) {
                    error.insertAfter(element.siblings("label"));
                }, */
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    console.log('form', form)
                    form.submit();
                }
            });
        });

        $('#submit_checkout').on('click',function(event) {
            // event.preventDefault(); // Prevent the default form submission
            console.log('abcd');
            // Gather form data
            if ($('[name="checkout"]').valid()) {
                var formData = $('#checkout').serialize();
                // Send data using AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('order') }}', // Replace with your server endpoint
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        console.log('response_id'+response.order_id);
                        generatePaypalAccess(response.order_id);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Form submission failed', status, error);
                    }
                });
            } else {
                console.log('Form validation failed');
            }
            return false; // Prevent the form from submitting normally
        }); 

        function generatePaypalAccess(order_id){
            var order = order_id;
            console.log('Paypal '+order_id);
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return fetch('{{ route('createTransactionCard') }}', {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                         body: JSON.stringify({ order_id: order_id })
                    }).then(function(res) {
                        return res.json();
                    }).then(function(orderData) {
                        console.log(orderData);
                        return orderData.orderID; // Use the same key name for order ID in the response
                    });
                },
                onApprove: function(data, actions) {
                    $('#loader').show();
                    return fetch('{{ route('captureTransaction') }}?token=' + data.orderID + '&order_id=' + order_id, {
                        method: 'get',
                    }).then(function(res) {
                        return res.json();
                    }).then(function(details) {
                        $('#popup').hide();
                        window.location.href = "{{ route('order-confirm')}}?order=" + order;
                        // alert('Transaction completed by ' + details.result.payer.name.given_name);
                        // Optionally, you can redirect the user or display a message
                    }).finally(function() {
                        // Hide loader after PayPal transaction completes (success or failure)
                        $('#loader').hide();
                    });
                }
            }).render('#paypal-button-container');
            $('#popup').show();
        }
        /*Popup Modal Functions Starts Here*/

        $('.close-btn').on('click', function() {
            $('#popup').hide();
            $('#paypal-button-container').html('');
        });

        $(window).on('click', function(event) {
            if ($(event.target).is('#popup')) {
                $('#popup').hide();
                $('#paypal-button-container').html('');
            }
        });

        /* Popup Modal Functions Ends Here*/
        $('#country').on('change', function() {
            var country_id = $(this).val();
            $.ajax({
                url: "{{ route('addresses.getStates') }}/" + country_id,
                type: 'GET',
                success: function(resp) {
                    $('#state').html(resp);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $('#shipping_country').on('change', function() {
            var country_id = $(this).val();
            $.ajax({
                url: "{{ route('addresses.getStates') }}/" + country_id,
                type: 'GET',
                success: function(resp) {
                    $('#shipping_state').html(resp);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $('.coupon-code').click(function() {
            var couponCode = $('#coupon-code').val();
            var type = $(this).attr("data-type");
            if (!couponCode) {
                $('.error-message').html('Please enter a coupon code.');
                return false;
            } else {
                $('.error-message').html('');
                $.ajax({
                    url: '{{ route('coupon-code') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        coupon_code: couponCode,
                        type: type
                    },
                    success: function(response) {
                        if (response.success == true) {
                            let grandTotal = response.cart.formatted_grand_total;
                            let discountAmount = response.cart.discount_amount;
                            $('.discountAmount').html(discountAmount);
                            $('.grandTotal').html(grandTotal);
                            $('.coupon-code').attr('hidden', 'hidden');
                            $('.remove-code').removeAttr('hidden');
                        } else {
                            $('.error-message').html(response.message);
                        }
                    },
                });
            }
        });

        $('.remove-code').click(function() {
            var couponCode = $('#coupon-code').val();
            var type = $(this).attr("data-type");

            $.ajax({
                url: '{{ route('coupon-code') }}',
                type: 'POST',
                data: { 
                    _token: '{{ csrf_token() }}',
                    coupon_code: couponCode,
                    type: type
                },
                success: function(response) {
                    if(response.success == true) {
                        let grandTotal = response.cart.formatted_grand_total;
                        let discountAmount = response.cart.discount_amount;
                        $('.discountAmount').html(discountAmount);
                        $('.grandTotal').html(grandTotal);
                        $('#coupon-code').val('');
                        $('.coupon-code').removeAttr('hidden');
                        $('.remove-code').attr('hidden', 'hidden');
                    } else {
                        $('.error-message').html(response.message);
                    }
                },
            });
        //checkout submission form check 
        }); 
    </script>
@endsection
