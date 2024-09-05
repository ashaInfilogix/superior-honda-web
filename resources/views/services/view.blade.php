@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/services.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
@endsection

@section('content')
    <section class="product__section section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ env('BASE_IMAGE_PATH') }}{{ $service->image }}" class="card-img-top mb-40" alt="...">
                    <h2 class="card-title mb-30">{{ ucwords($service->name) }}</h2>
                    <p class="card-text">{{ $service->short_description }}</p>
                    <p class="card-text">{!! $service->description !!}</p>

                </div>
                <div class="col-md-4 service-item">
                    <div class="service-image" style="background-image: url('{{ asset('assets/img/services-banner.jpg') }}');">
                        <div class="overlay">
                            <h1 class="service-price">${{ number_format($service->price, 2)}}/Service</h1>
                            <p class="short-description">{{ $service->short_description }}</p>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:#" class="email text-color">{{ $settingEmail->value ?? ''}}</a>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="fa fa-phone"></i>
                                <a href="tel#" class="contact text-color">{{ $settingContact->value ?? ''}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="testimonial-section">
        <div class="container">
            <div class="row testimonial-services">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-cogs"></i>
                            <h2 class="card-title">High Quality Gear</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectet adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua exercitation ullamco </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 highlight-service">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-cogs"></i>
                            <h2 class="card-title">Expert Mechanics</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectet adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua exercitation ullamco </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-cogs"></i>
                            <h2 class="card-title">Complete Services</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectet adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua exercitation ullamco </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonials-container">
            <div class="text-center mb-35">
                <h3 class="heading-with-underline text-white">Testimonials</h3>
            </div>
            <h2 class="text-white text-center">What Our Client Says</h2>

            <div class="slider mt-5">
                <div class="testimonial">
                    <div class="row flex justify-content-center">
                        <div class="col-md-8">
                            <img src="{{ asset('assets/images/default-user.png') }}" alt="" class="avatar-img">
                            <p>Testimonial 2 content goes here.</p>
                            <p class="user-name">Alannah Humphrey</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
<!-- 
    <section class="product__section container section--padding">
        <div class="text-center">
            <div class="mb-30">
                <h2 class="heading-with-underline">WORK PROCESS</h2>
            </div>
            <h1 class="large-heading">We Complete Every Step Carefully</h1>
        </div>

        <div class="work-process row mt-5">
            <div class="col-md-4 mt-5">
                <div class="d-flex justify-content-center">
                    <div class="process-icon">
                        <img src="{{ asset('assets/icons/search-document.png') }}" alt="">
                    </div>
                </div>
                <div class="text-center process-detail">
                    <h3>Problem Consultation</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit, sed do eiusmod dolore magna</p>
                </div>
            </div>
            <div class="col-md-4 position-relative">
                <div class="d-flex justify-content-center">
                    <div class="process-icon">
                        <img src="{{ asset('assets/icons/maintenance.png') }}" alt="">
                    </div>
                </div>
                <div class="text-center process-detail">
                    <h3>Repairing Process</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit, sed do eiusmod dolore magna</p>
                </div>

                <img src="{{ asset('assets/images/arrow-to-top.png') }}" alt="" style="top: 32px" class="position-arrow">
            </div>
            <div class="col-md-4 position-relative mt-5">
                <div class="d-flex justify-content-center">
                    <div class="process-icon">
                        <img src="{{ asset('assets/icons/happy-customer.png') }}" alt="">
                    </div>
                </div>
                <div class="text-center process-detail">
                    <h3>Happy Customer</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit, sed do eiusmod dolore magna</p>
                </div>

                <img src="{{ asset('assets/images/arrow-to-bottom.png') }}" alt="" style="top: 0" class="position-arrow">
            </div>
        </div>
    </section> -->

    <!-- <section class="contact-section">
        <div class="row">
            <div class="col-md-8">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.946702185918!2d115.13579731432107!3d-8.701739193675793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2396dc8aee259%3A0xf3a5f74e1e4c9d6a!2sJl.%20Raya%20Semat%20No.20%2C%20Kerobokan%2C%20Kec.%20Kuta%20Utara%2C%20Kabupaten%20Badung%2C%20Bali%2080311%2C%20Indonesia!5e0!3m2!1sen!2s!4v1627135248452!5m2!1sen!2s" 
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-4 contact-section-detail">
                <h2>Get In Touch</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                <div class="contact-details">
                    <div class="d-flex gap-3 align-items-center">
                        <i class="fa fa-map-marker"></i>
                        <p>Jl. Raya Semat No.20 , Bali</p>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:#">sads</a>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <i class="fa fa-phone"></i>
                        <a href="tel#">adasd</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor/slick-slider/slick.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor/slick-slider/slick-theme.min.css') }}" />

    <script src="{{ asset('assets/js/vendor/slick-slider/slick.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                autoplay: true,
                autoplaySpeed: 3000,
                dots: false,
                arrows: false,
                pauseOnHover: true
            });
        });
    </script>
@endsection
