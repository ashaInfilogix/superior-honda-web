<?php 
$logo_url= DB::table('settings')->where('key','logo')->first();
$categoryData = DB::table('product_categories')->whereNull('deleted_at')->get();
// dd($categoryData);
if($logo_url)
{
    $logo_url = $logo_url->value;}
else{
    $logo_url = '';
}
?>

<div id="preloader">
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
<!-- End preloader -->

<!-- Start header area -->
<header class="header__section">
    <div class="main__header header__sticky">
        <div class="container">
        <?php
            $wishlist = 0;
            $sessionProduct = session('wishlist');
            if($sessionProduct) {
                $product_ids = array_column($sessionProduct['wishlist-products'], 'product_id');
                $wishlist = count($product_ids);
            }    
            ?>
            <div class="main__header--inner position__relative d-flex justify-content-between align-items-center">
                <div class="offcanvas__header--menu__open ">
                    <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352" />
                        </svg>
                        <span class="visually-hidden">Offcanvas Menu Open</span>
                    </a>
                </div>
                <div class="main__logo">
                    <h1 class="main__logo--title"><a class="main__logo--link" href="{{env('APP_URL')}}"><img style="width: 200px;border-radius:10px;height: 51px;" src="@if($logo_url){{env('BASE_IMAGE_PATH')}}{{$logo_url}}@else{{ asset('assets/images/logo/nav-log.webp') }}@endif"
                                alt="logo-img"></a></h1>
                </div>
                <div class="header__search--widget d-none d-lg-block header__sticky--none">
                    <form class="d-flex header__search--form border-radius-5" action="{{ route('products.index') }}">
                        <!-- <div class="header__select--categories select">
                            <select class="header__select--inner">
                                <option selected value="0"> All categories</option>
                                @foreach($categoryData as $key =>  $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="header__search--box">
                            <label>
                                <input name="search" class="header__search--input product_name" placeholder="Search For Products..." type="text">
                            </label>
                            <button class="header__search--button bg__primary text-white" aria-label="search button"
                                type="submit">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="header__menu d-none d-lg-block header__sticky--block">
                    <nav class="header__menu--navigation">
                        <ul class="header__menu--wrapper d-flex">
                            <li class="header__menu--items">
                                <a @class(['header__menu--link', 'active' => Route::is('index')]) href="{{ route('index') }}">Home</a>
                            </li>
                            <li class="header__menu--items">
                                <a @class(['header__menu--link', 'active' => Route::is('products')]) href="{{ route('products.index') }}">Products</a>
                            </li>
                            <li class="header__menu--items">
                                <a @class(['header__menu--link', 'active' => Route::is('accesories')]) href="{{ route('accesories') }}">Accesories </a>
                            </li>
                            <li class="header__menu--items">
                                <a class="header__menu--link" href="{{ route('inquiries.create') }}">Inquiry </a>
                            </li>
                            <li class="header__menu--items">
                                <a class="header__menu--link" href="{{ route('services.index') }}">Services </a>
                            </li>
                            @if (!Auth::user())
                                <li class="header__menu--items">
                                    <a class="header__menu--link" href="{{ route('login') }}">Login/Register </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="header__account header__sticky--none">
                    <ul class="header__account--wrapper d-flex align-items-center">
                        <li class="header__account--items d-none d-lg-block">
                            @if (Auth::user())
                                <a class="header__account--btn" href="{{ route('dashboard.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class=" -user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="visually-hidden">My account</span>
                                </a>
                            @else
                                <a class="header__account--btn" href="{{ route('login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class=" -user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="visually-hidden">My account</span>
                                </a>
                            @endif
                        </li>
                        <li
                            class="header__account--items  header__account--search__items mobile__d--block d-sm-2-none">
                            <a class="header__account--btn search__open--btn" href="javascript:void(0)"
                                data-offcanvas>
                                <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg"
                                    width="22.51" height="20.443" viewBox="0 0 512 512">
                                    <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                        fill="none" stroke="currentColor" stroke-miterlimit="10"
                                        stroke-width="32" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                                </svg>
                                <span class="visually-hidden">Search</span>
                            </a>
                        </li>
                        <li class="header__account--items d-none d-lg-block">
                            <a class="header__account--btn" href="{{ route('wishlists.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class=" -heart">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                    </path>
                                </svg>
                                <span class="items__count wishlist">{{ $wishlist }}</span>
                            </a>
                        </li>
                        <li class="header__account--items header__minicart--items">
                            <a class="header__account--btn minicart__open--btn" href="javascript:void(0)"
                                data-offcanvas>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.706" height="22.534"
                                    viewBox="0 0 14.706 13.534">
                                    <g transform="translate(0 0)">
                                        <g>
                                            <path data-name="Path 16787"
                                                d="M4.738,472.271h7.814a.434.434,0,0,0,.414-.328l1.723-6.316a.466.466,0,0,0-.071-.4.424.424,0,0,0-.344-.179H3.745L3.437,463.6a.435.435,0,0,0-.421-.353H.431a.451.451,0,0,0,0,.9h2.24c.054.257,1.474,6.946,1.555,7.33a1.36,1.36,0,0,0-.779,1.242,1.326,1.326,0,0,0,1.293,1.354h7.812a.452.452,0,0,0,0-.9H4.74a.451.451,0,0,1,0-.9Zm8.966-6.317-1.477,5.414H5.085l-1.149-5.414Z"
                                                transform="translate(0 -463.248)" fill="currentColor" />
                                            <path data-name="Path 16788"
                                                d="M5.5,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,5.5,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,6.793,478.352Z"
                                                transform="translate(-1.191 -466.622)" fill="currentColor" />
                                            <path data-name="Path 16789"
                                                d="M13.273,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,13.273,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,14.566,478.352Z"
                                                transform="translate(-2.875 -466.622)" fill="currentColor" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="items__count  item-count-cart"> @if(session('cart')) {{ session('cart')['count'] }} @else 0 @endif</span>
                                <span class="minicart__btn--text">My Cart <br> 
                                    @isset(session('cart')['formatted_sub_total'])
                                    <span class="minicart__btn--text__price totalAmount"><b>{{ session('cart')['formatted_sub_total'] }}</b></span>
                                    @endisset
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="header__account header__sticky--block">
                    <ul class="header__account--wrapper d-flex align-items-center">
                        <li class="header__account--items  header__account--search__items d-sm-2-none">
                            <a class="header__account--btn search__open--btn" href="javascript:void(0)"
                                data-offcanvas>
                                <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg"
                                    width="22.51" height="20.443" viewBox="0 0 512 512">
                                    <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                        fill="none" stroke="currentColor" stroke-miterlimit="10"
                                        stroke-width="32" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                                </svg>
                                <span class="visually-hidden">Search</span>
                            </a>
                        </li>
                        <li class="header__account--items d-none d-lg-block">
                            @if (Auth::user())
                                <a class="header__account--btn" href="{{ route('dashboard.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class=" -user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="visually-hidden">My account</span>
                                </a>
                            @else
                                <a class="header__account--btn" href="{{ route('login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class=" -user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="visually-hidden">My account</span>
                                </a>
                            @endif
                        </li>
                        <li class="header__account--items d-none d-lg-block">
                            <a class="header__account--btn" href="{{ route('wishlists.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class=" -heart">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                    </path>
                                </svg>
                                <span class="items__count wishlist">{{ $wishlist }}</span>
                            </a>
                        </li>
                        <li class="header__account--items header__minicart--items">
                            <a class="header__account--btn minicart__open--btn" href="javascript:void(0)"
                                data-offcanvas>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.706" height="22.534"
                                    viewBox="0 0 14.706 13.534">
                                    <g transform="translate(0 0)">
                                        <g>
                                            <path data-name="Path 16787"
                                                d="M4.738,472.271h7.814a.434.434,0,0,0,.414-.328l1.723-6.316a.466.466,0,0,0-.071-.4.424.424,0,0,0-.344-.179H3.745L3.437,463.6a.435.435,0,0,0-.421-.353H.431a.451.451,0,0,0,0,.9h2.24c.054.257,1.474,6.946,1.555,7.33a1.36,1.36,0,0,0-.779,1.242,1.326,1.326,0,0,0,1.293,1.354h7.812a.452.452,0,0,0,0-.9H4.74a.451.451,0,0,1,0-.9Zm8.966-6.317-1.477,5.414H5.085l-1.149-5.414Z"
                                                transform="translate(0 -463.248)" fill="currentColor" />
                                            <path data-name="Path 16788"
                                                d="M5.5,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,5.5,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,6.793,478.352Z"
                                                transform="translate(-1.191 -466.622)" fill="currentColor" />
                                            <path data-name="Path 16789"
                                                d="M13.273,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,13.273,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,14.566,478.352Z"
                                                transform="translate(-2.875 -466.622)" fill="currentColor" />
                                        </g>
                                    </g>
                                </svg>
                                    <span class="items__count item-count-cart">@if(session('cart')) {{ session('cart')['count'] }} @else 0 @endif</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Category Seletct -->
    <div class="header__bottom bg__primary">
        <div class="container">
            <div class="header__bottom--inner position__relative d-flex align-items-center">
                <div class="categories__menu mobile-v-none">
                    <div class="categories__menu--header bg__secondary text-white d-flex align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#categoriesAccordion">
                        <svg class="categories__list--icon" width="18" height="15" viewBox="0 0 18 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="13" height="1.5" fill="currentColor" />
                            <rect y="4.44434" width="18" height="1.5" fill="currentColor" />
                            <rect y="8.88892" width="15" height="1.5" fill="currentColor" />
                            <rect y="13.3333" width="17" height="1.5" fill="currentColor" />
                        </svg>

                        <span class="categories__menu--title">Select catagories</span>
                        <svg class="categories__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355"
                            height="8.394" viewBox="0 0 10.355 6.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                transform="translate(-6 -8.59)" fill="currentColor" />
                        </svg>
                    </div>
                    <div @class([
                        'dropdown__categories--menu border-radius-5 collapse',
                        // 'show active' => Route::is('index'),
                    ]) id="categoriesAccordion">
                        <ul class="d-none d-lg-block">
                            @foreach($categoryData as $category)
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <!-- <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="3" width="20" height="14" rx="2"
                                            ry="2"></rect>
                                        <line x1="8" y1="21" x2="16" y2="21"></line>
                                        <line x1="12" y1="17" x2="12" y2="21"></line>
                                    </svg> -->
                                    {{$category->name}}
                                </a>
                            </li>
                            @endforeach
                            <!-- <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path
                                            d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                        </path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg> Smart Devices

                                    <svg class="categories__menu--right__arrow--icon"
                                        xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144" />
                                    </svg>
                                </a>
                                <ul class="categories__submenu border-radius-10 d-flex justify-content-between">
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Body Parts</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Brake Calipers </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Engine Oil </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Motor Oil </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Oil
                                                    Filters </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Interior Parts</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Air
                                                    Boxes </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Tail Lights </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Mobile Electronics </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Car
                                                    Covers </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Engine & Drivetrain</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Bumpers </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Hoods </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">care kits </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Fog
                                                    Lights </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Fluids & Chemicals</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Cabin Air Filters </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Pistons liners </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Oil
                                                    & lubricants </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">
                                                    Paintworks
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Cargo Accessories</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Body Parts </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Engine Parts </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Tires & Wheels </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Repair Parts </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items">
                                        <a class="categories__submenu--thumbnail" href="#">
                                            <img src="{{ asset('assets/images/product/main-product/product1.webp') }}"
                                                alt="categories-img">
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="15" rx="2"
                                            ry="2"></rect>
                                        <polyline points="17 2 12 7 7 2"></polyline>
                                    </svg> Paintworks
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                        <line x1="6" y1="1" x2="6" y2="4"></line>
                                        <line x1="10" y1="1" x2="10" y2="4"></line>
                                        <line x1="14" y1="1" x2="14" y2="4"></line>
                                    </svg> Replacement Parts
                                    <svg class="categories__menu--right__arrow--icon"
                                        xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144" />
                                    </svg>
                                </a>
                                <ul class="categories__submenu style2 border-radius-10 d-flex justify-content-between">
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Fluids & Chemicals</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Cabin Air Filters </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Pistons liners </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Oil
                                                    & lubricants </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">
                                                    Paintworks
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Interior Parts</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Air
                                                    Boxes </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Tail Lights </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Mobile Electronics </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Car
                                                    Covers </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Engine & Drivetrain</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Bumpers </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Hoods </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Fog
                                                    Lights </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">
                                                    Engine Partses </a></li>
                                        </ul>
                                    </li>
                                    <li class="categories__submenu--items"><a class="categories__submenu--items__text"
                                            href="#"><strong>Body Parts</strong></a>
                                        <ul class="categories__submenu--child">
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Brake Calipers </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Engine Oil </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link"
                                                    href="#">Motor Oil </a></li>
                                            <li class="categories__submenu--child__items"><a
                                                    class="categories__submenu--child__items--link" href="#">Oil
                                                    Filters </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="4" y="4" width="16" height="16" rx="2"
                                            ry="2"></rect>
                                        <rect x="9" y="9" width="6" height="6"></rect>
                                        <line x1="9" y1="1" x2="9" y2="4"></line>
                                        <line x1="15" y1="1" x2="15" y2="4"></line>
                                        <line x1="9" y1="20" x2="9" y2="23"></line>
                                        <line x1="15" y1="20" x2="15" y2="23"></line>
                                        <line x1="20" y1="9" x2="23" y2="9"></line>
                                        <line x1="20" y1="14" x2="23" y2="14"></line>
                                        <line x1="1" y1="9" x2="4" y2="9"></line>
                                        <line x1="1" y1="14" x2="4" y2="14"></line>
                                    </svg> Car Parts
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="22" y1="12" x2="2" y2="12"></line>
                                        <path
                                            d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                        </path>
                                        <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                        <line x1="10" y1="16" x2="10.01" y2="16"></line>
                                    </svg>Gaming Toiys
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg> Oil Fluids
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 11a9 9 0 0 1 9 9"></path>
                                        <path d="M4 4a16 16 0 0 1 16 16"></path>
                                        <circle cx="5" cy="19" r="1"></circle>
                                    </svg> Baby Car Seat
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M322 416c0 35.35-20.65 64-56 64H134c-35.35 0-56-28.65-56-64M336 336c17.67 0 32 17.91 32 40h0c0 22.09-14.33 40-32 40H64c-17.67 0-32-17.91-32-40h0c0-22.09 14.33-40 32-40"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-miterlimit="10" stroke-width="32" />
                                        <path
                                            d="M344 336H179.31a8 8 0 00-5.65 2.34l-26.83 26.83a4 4 0 01-5.66 0l-26.83-26.83a8 8 0 00-5.65-2.34H56a24 24 0 01-24-24h0a24 24 0 0124-24h288a24 24 0 0124 24h0a24 24 0 01-24 24zM64 276v-.22c0-55 45-83.78 100-83.78h72c55 0 100 29 100 84v-.22M241 112l7.44 63.97"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-miterlimit="10" stroke-width="32" />
                                        <path d="M256 480h139.31a32 32 0 0031.91-29.61L463 112" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                            stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" d="M368 112l16-64 47-16" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-miterlimit="10" stroke-width="32" d="M224 112h256" />
                                    </svg> Bread & Bakery
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="14" rx="2"
                                            ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg> Engine Parts
                                </a>
                            </li>
                            <li class="categories__menu--items">
                                <a class="categories__menu--link" href="#">
                                    <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M3 3l7.07 16.97 2.51-7.39 7.39-2.51L3 3z"></path>
                                        <path d="M13 13l6 6"></path>
                                    </svg> Car & Motorbike Care
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="categories__menu mobile-v-block">
                    <div class="categories__menu--header bg__secondary text-white d-flex align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#categoriesAccordion2">
                        <svg class="categories__list--icon" width="18" height="15" viewBox="0 0 18 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="13" height="1.5" fill="currentColor" />
                            <rect y="4.44434" width="18" height="1.5" fill="currentColor" />
                            <rect y="8.88892" width="15" height="1.5" fill="currentColor" />
                            <rect y="13.3333" width="17" height="1.5" fill="currentColor" />
                        </svg>

                        <span class="categories__menu--title">Select catagories</span>
                        <svg class="categories__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355"
                            height="8.394" viewBox="0 0 10.355 6.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                transform="translate(-6 -8.59)" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="dropdown__categories--menu border-radius-5 active collapse" id="categoriesAccordion2">
                        <nav class="category__mobile--menu">
                            <ul class="category__mobile--menu_ul">
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="2" y="3" width="20" height="14" rx="2"
                                                ry="2"></rect>
                                            <line x1="8" y1="21" x2="16" y2="21">
                                            </line>
                                            <line x1="12" y1="17" x2="12" y2="21">
                                            </line>
                                        </svg> Lighting
                                    </a>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path
                                                d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                            </path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg> Smart Devices
                                    </a>
                                    <ul class="category__sub--menu">
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Body Parts</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Brake Calipers </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Oil and Vinegar </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Engine Oil </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Oil Filters </a></li>
                                            </ul>
                                        </li>
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Interior
                                                Parts</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Air Boxes </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Tail Lights </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Mobile Electronic </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Car Covers </a></li>
                                            </ul>
                                        </li>
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Engine &
                                                Drivetrain</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Cabin Air Filters </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Pistons liners </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Bread and Juice </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Paintworks </a></li>
                                            </ul>
                                        </li>
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Cargo
                                                Accessories</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Body Parts </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Engine Parts</a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Tires & Wheels </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Repair Parts </a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="2" y="7" width="20" height="15" rx="2"
                                                ry="2"></rect>
                                            <polyline points="17 2 12 7 7 2"></polyline>
                                        </svg> Paintworks
                                    </a>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                            <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                            <line x1="6" y1="1" x2="6" y2="4">
                                            </line>
                                            <line x1="10" y1="1" x2="10" y2="4">
                                            </line>
                                            <line x1="14" y1="1" x2="14" y2="4">
                                            </line>
                                        </svg> Replacement Parts
                                    </a>
                                    <ul class="category__sub--menu">
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Body Parts</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Brake Calipers </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Oil and Vinegar </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Engine Oil </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Oil Filters </a></li>
                                            </ul>
                                        </li>
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Interior
                                                Parts</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Air Boxes </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Tail Lights </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Mobile Electronic </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Car Covers </a></li>
                                            </ul>
                                        </li>
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Engine &
                                                Drivetrain</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Cabin Air Filters </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Pistons liners </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Bread and Juice </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Paintworks </a></li>
                                            </ul>
                                        </li>
                                        <li class="categories__submenu--items"><a
                                                class="categories__submenu--items__text" href="#">Cargo
                                                Accessories</a>
                                            <ul class="category__sub--menu">
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Body Parts </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Engine Parts</a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Tires & Wheels </a></li>
                                                <li class="categories__submenu--child__items"><a
                                                        class="categories__submenu--child__items--link"
                                                        href="#">Repair Parts </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <circle cx="256" cy="184" r="120" fill="none"
                                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                            <circle cx="344" cy="328" r="120" fill="none"
                                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                            <circle cx="168" cy="328" r="120" fill="none"
                                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                        </svg> Beauty & Care
                                    </a>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="4" y="4" width="16" height="16" rx="2"
                                                ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4">
                                            </line>
                                            <line x1="15" y1="1" x2="15" y2="4">
                                            </line>
                                            <line x1="9" y1="20" x2="9" y2="23">
                                            </line>
                                            <line x1="15" y1="20" x2="15" y2="23">
                                            </line>
                                            <line x1="20" y1="9" x2="23" y2="9">
                                            </line>
                                            <line x1="20" y1="14" x2="23" y2="14">
                                            </line>
                                            <line x1="1" y1="9" x2="4" y2="9">
                                            </line>
                                            <line x1="1" y1="14" x2="4" y2="14">
                                            </line>
                                        </svg> Car Parts
                                    </a>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <line x1="22" y1="12" x2="2" y2="12">
                                            </line>
                                            <path
                                                d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                            </path>
                                            <line x1="6" y1="16" x2="6.01" y2="16">
                                            </line>
                                            <line x1="10" y1="16" x2="10.01" y2="16">
                                            </line>
                                        </svg>Gaming Toiys
                                    </a>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                            <polyline points="2 17 12 22 22 17"></polyline>
                                            <polyline points="2 12 12 17 22 12"></polyline>
                                        </svg> Oil Fluids
                                    </a>
                                </li>
                                <li class="categories__menu--items">
                                    <a class="categories__menu--link" href="#">
                                        <svg class="categories__menu--svgicon" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M4 11a9 9 0 0 1 9 9"></path>
                                            <path d="M4 4a16 16 0 0 1 16 16"></path>
                                            <circle cx="5" cy="19" r="1"></circle>
                                        </svg> Baby Car Seat
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header__right--area d-flex justify-content-between align-items-center">
                    <div class="header__menu">
                        <nav class="header__menu--navigation">
                            <ul class="header__menu--wrapper d-flex">
                                <li class="header__menu--items">
                                    <a class="header__menu--link text-white {{ Request::segment(1) == '' ? 'active' : '' }}"
                                        href="{{ route('index') }}">Home </a>
                                </li>
                                <li class="header__menu--items">
                                    <a class="header__menu--link text-white {{ Request::segment(1) == 'products' ? 'active' : '' }}"
                                        href="{{ route('products.index') }}">Products </a>
                                </li>

                                <li class="header__menu--items">
                                    <a class="header__menu--link text-white {{ Request::segment(1) == 'accesories' ? 'active' : '' }}" href="{{ route('accesories')}}">Accesories </a>
                                </li>
                                <li class="header__menu--items">
                                    <a class="header__menu--link text-white {{ Request::segment(1) == 'inquiries' ? 'active' : '' }}"
                                        href="{{ route('inquiries.create') }}">Inquiry </a>
                                </li>
                                <li class="header__menu--items">
                                    <a class="header__menu--link text-white"
                                        href="{{ route('services.index') }}">Services </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="language__currency d-none d-lg-block">
                        <ul class="d-flex align-items-center">
                            <li class="language__currency--list">
                                @if (Auth::user())
                                    <a class="header__menu--link text-white" href="{{ route('logout') }}">
                                        Logout</a>
                                @else
                                    <a class="header__menu--link text-white"
                                        href="{{ route('login') }}">Login/Register </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----- Start Category Seletct -->
    <!-- Start Offcanvas header menu -->
    <div class="offcanvas__header">
        <div class="offcanvas__inner">
            <div class="offcanvas__logo">
                <a class="offcanvas__logo_link" href="{{ route('index') }}">
                    <img src="{{ asset('assets/images/logo/nav-log.webp') }}" alt="Grocee Logo" width="158"
                        height="36">
                </a>
                <button class="offcanvas__close--btn" data-offcanvas>close</button>
            </div>
            <nav class="offcanvas__menu">
                <ul class="offcanvas__menu_ul">
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('index') }}">Home</a>
                        <ul class="offcanvas__sub_menu">
                            <li class="offcanvas__sub_menu_li"><a href="{{ route('index') }}"
                                    class="offcanvas__sub_menu_item">Home One</a></li>
                            <li class="offcanvas__sub_menu_li"><a href="{{ route('index') }}"
                                    class="offcanvas__sub_menu_item">Home Two</a></li>
                            <li class="offcanvas__sub_menu_li"><a href="{{ route('index') }}"
                                    class="offcanvas__sub_menu_item">Home Three</a></li>
                            <li class="offcanvas__sub_menu_li"><a href="{{ route('index') }}"
                                    class="offcanvas__sub_menu_item">Home Four</a></li>
                            <li class="offcanvas__sub_menu_li"><a href="{{ route('index') }}"
                                    class="offcanvas__sub_menu_item">Home Five</a></li>
                        </ul>
                    </li>

                    <li class="offcanvas__menu_li"><a class="offcanvas__menu_item"
                            href="{{ route('products.index') }}">Products</a></li>
                    <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{ route('accesories')}}">Accesories</a>
                    </li>
                    <li class="offcanvas__menu_li"><a class="offcanvas__menu_item"
                            href="{{ route('inquiries.create') }}">Inquiry</a></li>
                    <li class="offcanvas__menu_li"><a class="offcanvas__menu_item"
                            href="{{ route('services.index') }}">Services </a></li>
                </ul>
                <div class="offcanvas__account--items">
                    <a class="offcanvas__account--items__btn d-flex align-items-center"
                        href="{{ route('login') }}">
                        <span class="offcanvas__account--items__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20.51" height="19.443"
                                viewBox="0 0 512 512">
                                <path
                                    d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="32" />
                                <path
                                    d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                                    fill="none" stroke="currentColor" stroke-miterlimit="10"
                                    stroke-width="32" />
                            </svg>
                        </span>
                        <span class="offcanvas__account--items__label">Login / Register</span>
                    </a>
                </div>
                <div class="offcanvas__account--wrapper d-flex">
                    <div class="offcanvas__account--currency">
                        <a class="offcanvas__account--currency__menu d-flex align-items-center text-black"
                            href="javascript:void(0)">
                            <img src="{{ asset('assets/images/icon/usd-icon.webp') }}" alt="currency">
                            <span>USD</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="9.797" height="6.05"
                                viewBox="0 0 9.797 6.05">
                                <path d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z"
                                    transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7" />
                            </svg>
                        </a>
                        <div class="offcanvas__account--currency__submenu">
                            <ul>
                                <li class="currency__items"><a class="currency__text" href="#">CAD</a></li>
                                <li class="currency__items"><a class="currency__text" href="#">CNY</a></li>
                                <li class="currency__items"><a class="currency__text" href="#">EUR</a></li>
                                <li class="currency__items"><a class="currency__text" href="#">GBP</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="language__currency--list">
                        <a class="offcanvas__language--switcher" href="javascript:void(0)">
                            <span>English</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="9.797" height="6.05"
                                viewBox="0 0 9.797 6.05">
                                <path d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z"
                                    transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7" />
                            </svg>
                        </a>
                        <div class="offcanvas__dropdown--language">
                            <ul>
                                <li class="language__items"><a class="language__text" href="#">France</a>
                                </li>
                                <li class="language__items"><a class="language__text" href="#">Russia</a>
                                </li>
                                <li class="language__items"><a class="language__text" href="#">Spanish</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Offcanvas header menu -->

    <!-- Start Offcanvas stikcy toolbar -->
    <div class="offcanvas__stikcy--toolbar">
        <ul class="d-flex justify-content-between">
            <li class="offcanvas__stikcy--toolbar__list">
                <a class="offcanvas__stikcy--toolbar__btn" href="#">
                    <span class="offcanvas__stikcy--toolbar__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="21.51" height="21.443"
                            viewBox="0 0 22 17">
                            <path fill="currentColor"
                                d="M20.9141 7.93359c.1406.11719.2109.26953.2109.45703 0 .14063-.0469.25782-.1406.35157l-.3516.42187c-.1172.14063-.2578.21094-.4219.21094-.1406 0-.2578-.04688-.3515-.14062l-.9844-.77344V15c0 .3047-.1172.5625-.3516.7734-.2109.2344-.4687.3516-.7734.3516h-4.5c-.3047 0-.5742-.1172-.8086-.3516-.2109-.2109-.3164-.4687-.3164-.7734v-3.6562h-2.25V15c0 .3047-.11719.5625-.35156.7734-.21094.2344-.46875.3516-.77344.3516h-4.5c-.30469 0-.57422-.1172-.80859-.3516-.21094-.2109-.31641-.4687-.31641-.7734V8.46094l-.94922.77344c-.11719.09374-.24609.14062-.38672.14062-.16406 0-.30468-.07031-.42187-.21094l-.35157-.42187C.921875 8.625.875 8.50781.875 8.39062c0-.1875.070312-.33984.21094-.45703L9.73438.832031C10.1094.527344 10.5312.375 11 .375s.8906.152344 1.2656.457031l8.6485 7.101559zm-3.7266 6.50391V7.05469L11 1.99219l-6.1875 5.0625v7.38281h3.375v-3.6563c0-.3046.10547-.5624.31641-.7734.23437-.23436.5039-.35155.80859-.35155h3.375c.3047 0 .5625.11719.7734.35155.2344.211.3516.4688.3516.7734v3.6563h3.375z">
                            </path>
                        </svg>
                    </span>
                    <span class="offcanvas__stikcy--toolbar__label">Home</span>
                </a>
            </li>
            <li class="offcanvas__stikcy--toolbar__list">
                <a class="offcanvas__stikcy--toolbar__btn" href="#">
                    <span class="offcanvas__stikcy--toolbar__icon">
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="18.51"
                            height="17.443" viewBox="0 0 448 512">
                            <path
                                d="M416 32H32A32 32 0 0 0 0 64v384a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32V64a32 32 0 0 0-32-32zm-16 48v152H248V80zm-200 0v152H48V80zM48 432V280h152v152zm200 0V280h152v152z">
                            </path>
                        </svg>
                    </span>
                    <span class="offcanvas__stikcy--toolbar__label">Shop</span>
                </a>
            </li>
            <li class="offcanvas__stikcy--toolbar__list ">
                <a class="offcanvas__stikcy--toolbar__btn search__open--btn" href="javascript:void(0)"
                    data-offcanvas>
                    <span class="offcanvas__stikcy--toolbar__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                            viewBox="0 0 512 512">
                            <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                        </svg>
                    </span>
                    <span class="offcanvas__stikcy--toolbar__label">Search</span>
                </a>
            </li>
            <li class="offcanvas__stikcy--toolbar__list">
                <a class="offcanvas__stikcy--toolbar__btn minicart__open--btn" href="javascript:void(0)"
                    data-offcanvas>
                    <span class="offcanvas__stikcy--toolbar__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.706" height="22.534"
                            viewBox="0 0 14.706 13.534">
                            <g transform="translate(0 0)">
                                <g>
                                    <path data-name="Path 16787"
                                        d="M4.738,472.271h7.814a.434.434,0,0,0,.414-.328l1.723-6.316a.466.466,0,0,0-.071-.4.424.424,0,0,0-.344-.179H3.745L3.437,463.6a.435.435,0,0,0-.421-.353H.431a.451.451,0,0,0,0,.9h2.24c.054.257,1.474,6.946,1.555,7.33a1.36,1.36,0,0,0-.779,1.242,1.326,1.326,0,0,0,1.293,1.354h7.812a.452.452,0,0,0,0-.9H4.74a.451.451,0,0,1,0-.9Zm8.966-6.317-1.477,5.414H5.085l-1.149-5.414Z"
                                        transform="translate(0 -463.248)" fill="currentColor" />
                                    <path data-name="Path 16788"
                                        d="M5.5,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,5.5,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,6.793,478.352Z"
                                        transform="translate(-1.191 -466.622)" fill="currentColor" />
                                    <path data-name="Path 16789"
                                        d="M13.273,478.8a1.294,1.294,0,1,0,1.293-1.353A1.325,1.325,0,0,0,13.273,478.8Zm1.293-.451a.452.452,0,1,1-.431.451A.442.442,0,0,1,14.566,478.352Z"
                                        transform="translate(-2.875 -466.622)" fill="currentColor" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="offcanvas__stikcy--toolbar__label">Cart</span>
                    <span class="items__count"> @if(session('cart')) {{ session('cart')['count'] }} @else 0 @endif</span>
                </a>
            </li>
            <li class="offcanvas__stikcy--toolbar__list">
                <a class="offcanvas__stikcy--toolbar__btn" href="{{ route('wishlists.index') }}">
                    <span class="offcanvas__stikcy--toolbar__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class=" -heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                    </span>
                    <span class="offcanvas__stikcy--toolbar__label">Wishlist</span>
                    <span class="items__count wishlist">{{ $wishlist }}</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- End Offcanvas stikcy toolbar -->

    <div class="offCanvas__minicart cart-data-reflection">
        <div class="minicart__header ">
            <div class="minicart__header--top d-flex justify-content-between align-items-center">
                <h3 class="minicart__title"> Shopping Cart</h3>
                <button class="minicart__close--btn" aria-label="minicart close btn" data-offcanvas>
                    <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368" />
                    </svg>
                </button>
            </div>
            <p class="minicart__header--desc">The organic foods products are limited</p>
        </div>
        <div class="minicart__product">
            @if (session('cart') && isset(session('cart')['products']))
                @foreach (session('cart')['products'] as $key => $product)
                    <div class="minicart__product--items d-flex remove-{{ $product['id'] }}">
                        <div class="minicart__thumb">
                            <a href="#"><img src="{{ env('BASE_IMAGE_PATH')}}{{$product['image'] }}" alt="product-img"></a>
                        </div>
                        <div class="minicart__text">
                            <h4 class="minicart__subtitle"><a href="#">{{ $product['name'] }}</a></h4>
                            {{-- <span class="color__variant"><b>Color:</b> Beige</span> --}}
                            <div class="minicart__price">
                                <span class="minicart__current--price">${{ $product['price'] }}</span> <!-- Assuming $product['price'] contains the price -->
                                {{-- <span class="minicart__old--price">${{ $product['old_price'] }}</span> <!-- Assuming $product['old_price'] contains the old price --> --}}
                            </div>
                            <div class="minicart__text--footer d-flex align-items-center remove-{{ $product['id'] }}">
                                <div class="quantity__box minicart__quantity">
                                    <button type="button" class="quantity__value decrease" data-id = "{{ $product['id'] }}" aria-label="quantity value" value="Decrease Value">-</button>
                                    <label>
                                        <input type="number" class="quantity__number-{{ $product['id'] }} quantity__number" value="{{ $product['quantity'] }}" data-counter />
                                    </label>
                                    <button type="button" class="quantity__value increase" data-id = "{{ $product['id'] }}" aria-label="quantity value" value="Increase Value">+</button>
                                </div>
                                <button class="minicart__product--remove remove-from-cart" type="button" data-id="{{ $product['id'] }}">Remove</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="font-bold text-center mt-5">{{__('Cart is empty')}}</h3>
            @endif
        </div>
        
        @isset(session('cart')['formatted_sub_total'])
        <div class="minicart__amount">
            <div class="minicart__amount_list d-flex justify-content-between">
                <span>Sub Total:</span>
                <span class="totalAmount"><b>{{ session('cart')['formatted_sub_total'] }}</b></span>
            </div>
            <div class="minicart__amount_list d-flex justify-content-between">
                <span>Total:</span>
                <span class="grandTotal"><b>{{ session('cart')['formatted_grand_total'] }}</b></span>
            </div>
        </div>
        <div class="minicart__conditions text-center">
            <input class="minicart__conditions--input" id="accept" type="checkbox">
            <label class="minicart__conditions--label" for="accept">I agree with the <a
                    class="minicart__conditions--link" href="#">Privacy Policy</a></label>
        </div>
        @endisset
        <div class="minicart__button d-flex justify-content-center">
            <a class="primary__btn minicart__button--link" href="{{ route('cart')}}">View cart</a>
            @if (session('cart') && isset(session('cart')['products']))
                <a class="primary__btn minicart__button--link" href="{{ route('checkout') }}">Checkout</a>
            @else
                <a class="primary__btn minicart__button--link" href="{{ route('index') }}">Checkout</a>
            @endif
         </div>
    </div>
    <!-- End offCanvas minicart -->


    <!-- Start serch box area -->
    <div class="predictive__search--box ">
        <div class="predictive__search--box__inner">
            <h2 class="predictive__search--title">Search Products</h2>
            <form class="predictive__search--form" action="{{ route('products.index') }}">
                <label>
                    <input name="search" class="predictive__search--input" placeholder="Search Here" type="text">
                </label>
                <button class="predictive__search--button text-white" aria-label="search button"><svg
                        class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="30.51"
                        height="25.443" viewBox="0 0 512 512">
                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none"
                            stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                            stroke-width="32" d="M338.29 338.29L448 448" />
                    </svg> </button>
            </form>
        </div>
        <button class="predictive__search--close__btn" aria-label="search close" data-offcanvas>
            <svg class="predictive__search--close__icon" xmlns="http://www.w3.org/2000/svg" width="40.51"
                height="30.443" viewBox="0 0 512 512">
                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="32" d="M368 368L144 144M368 144L144 368" />
            </svg>
        </button>
    </div>
    <!-- End serch box area -->
</header>
<!-- End header area -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<!-- <script>
    $(".remove-from-cart").click(function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove-from-cart') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        window.location.reload();
                        // let cart = response.cart.formatted_sub_total;
                        // let amount = '<b>' + cart + '</b>';
                        // $('.totalAmount').html(amount);
                    }
                }
            });
        }
    });

    function updateQuantity(productId, quantity, element) {
        let cartEndpoint = "{{ route('remove-from-cart') }}";
        if (quantity > 0) {
            cartEndpoint = "{{ route('update-cart') }}";
        }

        $.ajax({
            url: cartEndpoint,
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                qty: quantity
            },
            success: function(response) {
                if (response.success) {
                    if (quantity > 0) {
                        let cart = response.cart.formatted_sub_total;
                        let amount = '<b>' + cart + '</b>';
                        $('.totalAmount').html(amount);

                        let grandTotal = response.cart.formatted_grand_total;
                        $('.grandTotal').html(grandTotal);
                    } else {
                        window.location.reload();
                    }
                }
            }
        });
    }

    $(document).on('click','.increase',function() {
        var productId = $(this).attr("data-id");
        var quantityInput = $(this).parent().find('.quantity__number');
        var currentValue = parseInt(quantityInput.val());
        var qty = currentValue + 1;
        updateQuantity(productId, qty);
    });

    $(document).on('click','.decrease',function() {
        var productId = $(this).attr("data-id");
        console.log(productId);
        var quantityInput = $(this).parent().find('.quantity__number');
        var currentValue = parseInt(quantityInput.val());
        var qty = currentValue - 1;
        updateQuantity(productId, qty);
    });
</script> -->
