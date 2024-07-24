@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/services.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
@endsection

@section('content')
    <div class="banner-container">
        <img class="banner-image" src="{{ asset('assets/images/banner/banner-service.webp') }}" alt="slider-img">
    </div>

    <section class="product__section section--padding">
        <div class="container">
            <div class="mb-30">
                <h2 class="heading-with-underline">Our Services</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h1 class="mb-35">Explore Our Service</h1>
                </div>
            </div>

            <div class="row services-list">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/cards/card1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-brush"></i>
                            </div>
                            <h2 class="card-title">Maintenance</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#">Read more
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58746 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/cards/card2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-cogs"></i>
                            </div>

                            <h2 class="card-title">Fine Tuning</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#">Read more
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58746 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/cards/card3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-laptop"></i>
                            </div>

                            <h2 class="card-title">Computer Diagnostics</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up
                                the bulk of the card's content.</p>
                            <a href="#">Read more
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58746 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/cards/card4.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-brush"></i>
                            </div>

                            <h2 class="card-title">Modification</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up
                                the bulk of the card's content.</p>
                            <a href="#">Read more <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58746 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/cards/card5.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <h2 class="card-title">Audio & AC</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up
                                the bulk of the card's content.</p>
                            <a href="#">Read more <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58746 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/cards/card6.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <h2 class="card-title">Balancing</h2>
                            <p class="card-text">Some quick example text to build on the card title and make up
                                the bulk of the card's content.</p>
                            <a href="#">Read more <svg width="12" height="8" viewBox="0 0 12 8"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58746 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-section">
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
                            <img src="{{ asset('assets/images/default-user.png') }}" alt=""
                                class="avatar-img mb-4">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris
                                nisi ut aliquip ex ea commodo </p>
                            <p class="user-name">Alannah Humphrey</p>
                        </div>
                    </div>
                </div>
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
    </section>

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
    </section>
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
