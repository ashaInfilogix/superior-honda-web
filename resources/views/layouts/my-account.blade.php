@extends('layouts.app')

@section('content')
<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="/">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->
    
    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <div class="my__account--section__inner border-radius-10 d-flex">
                <div class="account__left--sidebar">
                    <ul class="account__menu">
                        <li @class(["account__menu--list", "active" => Request::is('dashboard')])><a href="{{ route('dashboard.index')}}">Dashboard</a></li>
                        <li @class(["account__menu--list", "active" => Request::is('profile')])><a href="{{ route('profile.index')}}">My Profile</a></li>
                        <li @class(["account__menu--list", "active" => Request::is('addresses')]) }}"><a href="{{ route('addresses.index')}}">Addresses</a></li>
                        <li @class(["account__menu--list", "active" => Request::is('vehicles')])><a href="{{ route('vehicles.index')}}">Vehicles</a></li>
                        <li class="account__menu--list"><a href="{{ route('wishlists.index')}}">Wishlist</a></li>
                        <li class="account__menu--list"><a href="{{ route('logout') }}">Log Out</a></li>
                    </ul>
                </div>
                <div class="account__wrapper">
                    <div class="account__content">
                       @yield('my-account')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->

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
    <!-- End shipping section -->

</main>
@endsection
