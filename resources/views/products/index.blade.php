@extends('layouts.app')

@section('content')

<div class="offcanvas__filter--sidebar widget__area">
    <button type="button" class="offcanvas__filter--close" data-offcanvas>
        <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path></svg> <span class="offcanvas__filter--close__text">Close</span>
    </button>
    <div class="offcanvas__filter--sidebar__inner">
        <div class="single__widget widget__bg">
            <h2 class="widget__title h3">Categories</h2>
            <ul class="widget__categories--menu">
                @foreach ($productCategories as $key => $productCategory)
                <li class="widget__categories--menu__list">
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img" src="{{ env('BASE_IMAGE_PATH')}}{{$productCategory->category_image }}" alt="categories-img">
                        <span class="widget__categories--menu__text">{{ ucwords($productCategory->name) }}</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu">
                        @foreach ($productCategory->products as $product)
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{ route('products.show', $product->id)}}">
                                <img class="widget__categories--sub__menu--img" src="{{ env('BASE_IMAGE_PATH') }}{{ optional($productCategory->productImages)->images }}" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">{{ $product->product_name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="single__widget price__filter widget__bg">
            <h2 class="widget__title h3">Filter By Price</h2>
            <!-- <form class="price__filter--form" action="#">  -->
                <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-GTE">From</label>
                        <div class="price__filter--input">
                            <span class="price__filter--currency">$</span>
                            <input class="price__filter--input__field border-0" name="min_price" id="minPrice" type="number" placeholder="" min="0">
                        </div>
                    </div>
                    <div class="price__divider">
                        <span>-</span>
                    </div>
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-LTE">To</label>
                        <div class="price__filter--input">
                            <span class="price__filter--currency">$</span>
                            <input class="price__filter--input__field border-0" name="max_price" id="maxPrice" type="number" min="0" placeholder=""> 
                        </div>	
                    </div>
                </div>
                <button class="primary__btn price__filter--btn priceButton">Filter</button>
            <!-- </form>  -->
        </div>
        <div class="single__widget widget__bg">
            <h2 class="widget__title h3">Top Rated Product</h2>
            <div class="shop__sidebar--product">
            @if($topRatedProducts->isNotEmpty())
                @foreach($topRatedProducts as $topProduct)
                <div class="small__product--card d-flex">
                    <div class="small__product--thumbnail">
                        <a class="display-block" href="{{ route('products.show', $topProduct->id) }}">
                            @if ($topProduct->productImages->isNotEmpty())
                                <img src="{{ env('BASE_IMAGE_PATH') }}{{ $topProduct->productImages->first()->images }}" alt="product-img">
                            @else 
                                <img src="{{ asset('assets/images/product/small-product/product6.webp') }}" alt="product-img">
                            @endif
                        </a>
                    </div>
                    <div class="small__product--content">
                        <h3 class="small__product--card__title"><a href="{{ route('products.show', $topProduct->id) }}">{{ $topProduct->product_name }} </a></h3>
                        <div class="small__product--card__price">
                            <span class="current__price">$ {{ number_format($topProduct->cost_price, 2) }}</span>
                        </div>
                        @php
                            $rating = $topProduct->averageRating;
                            $reviewCount = $topProduct->reviewCount;
                            $maxRating = 5; // Maximum rating value (e.g., 4.5 stars)
                            $filledStars = floor($rating); // Whole number of filled stars
                            $halfStar = $rating - $filledStars; // Check if there's a half star
                            $emptyStars = $maxRating - $filledStars - ($halfStar > 0 ? 1 : 0); // Calculate empty stars

                            $filledStars = max(0, min($maxRating, $filledStars));
                            $emptyStars = max(0, min($maxRating, $emptyStars));
                        @endphp
                        <ul class="rating small__product--rating d-flex">
                            @for ($i = 0; $i < $filledStars; $i++)
                                @if($i >= 4)
                                    
                                    <li class="rating__list">
                                        <span class="rating__icon">
                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </li>
                                @else 
                                <li class="rating__list">
                                        <span class="rating__icon">
                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </li>
                                @endif
                            @endfor

                            @if ($halfStar > 0)
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="half-star-mask">
                                                <rect x="0" y="0" width="7" height="13" fill="white" />
                                            </mask>
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                fill="currentColor" />
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                fill="red" mask="url(#half-star-mask)" />
                                        </svg> 
                                    </span>
                                </li>
                            @endif

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
                @endforeach
            @else 
                <h3 class="font-bold text-center mt-5">{{__('Top Product is empty')}}</h3>
            @endif
            </div>
        </div>
        {{-- ----Brand Name ------}}
        <div class="single__widget widget__bg">
            <h2 class="widget__title h3">Brands</h2>
            <ul class="widget__tagcloud">
                @foreach ($brands as $brand)
                <li class="widget__tagcloud--list"><button class="widget__tagcloud--link brandProducts"  data-id="{{$brand->id}}"> {{ $brand->brand_name }}</button></li>
                <!-- <li class="widget__tagcloud--list"><a class="widget__tagcloud--link brandProducts" href="{{ route('products.index') }}?brandId={{ $brand->id }}" data-id="{{$brand->id}}"> {{ $brand->brand_name }}</a></li> -->
                @endforeach
            </ul>
        </div>
        {{-- ----End Brand Name ------}}
    </div>
</div>
<!-- End offcanvas filter sidebar -->
        
        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title">Product</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="/">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Product</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- Start shop section -->
        <div class="shop__section section--padding">
            <div class="container">
                <div class="shop__product--wrapper">
                    <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                        <div class="product__view--mode d-flex align-items-center">
                            <button class="widget__filter--btn d-flex align-items-center" data-offcanvas>
                                <svg  class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"/><circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/><circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/><circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/></svg> 
                                <span class="widget__filter--btn__text">Filter</span>
                            </button>
                            <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                <label class="product__view--label">Prev Page :</label>
                                <div class="select shop__header--select">
                                    <select class="product__view--select" id="itemsPerPage"> 
                                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                        <option value="40" {{ $perPage == 40 ? 'selected' : '' }}>40</option>
                                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                <label class="product__view--label">Sort By :</label>
                                <div class="select shop__header--select">
                                    <select class="product__view--select" name="sort_by" id="sortBy">
                                        <option selected value="sort_by_latest">Sort by latest</option>
                                        <option value="sort_by_rating">Sort by rating </option>
                                    </select>
                                </div>
                            </div>
                            <div class="product__view--mode__list">
                                <div class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
                                    <button class="product__grid--column__buttons--icons active" aria-label="grid btn" data-toggle="tab" data-target="#product_grid">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 9 9">
                                            <g  transform="translate(-1360 -479)">
                                              <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4" height="4" transform="translate(1360 479)" fill="currentColor"/>
                                              <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4" height="4" transform="translate(1360 484)" fill="currentColor"/>
                                              <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4" height="4" transform="translate(1365 479)" fill="currentColor"/>
                                              <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4" height="4" transform="translate(1365 484)" fill="currentColor"/>
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="product__grid--column__buttons--icons" aria-label="list btn" data-toggle="tab" data-target="#product_list">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 13 8">
                                            <g id="Group_14700" data-name="Group 14700" transform="translate(-1376 -478)">
                                              <g  transform="translate(12 -2)">
                                                <g id="Group_1326" data-name="Group 1326">
                                                  <rect id="Rectangle_5729" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor"/>
                                                  <rect id="Rectangle_5730" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor"/>
                                                </g>
                                                <g id="Group_1328" data-name="Group 1328" transform="translate(0 -3)">
                                                  <rect id="Rectangle_5729-2" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor"/>
                                                  <rect id="Rectangle_5730-2" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor"/>
                                                </g>
                                                <g id="Group_1327" data-name="Group 1327" transform="translate(0 -1)">
                                                  <rect id="Rectangle_5731" data-name="Rectangle 5731" width="3" height="2" transform="translate(1364 487)" fill="currentColor"/>
                                                  <rect id="Rectangle_5732" data-name="Rectangle 5732" width="9" height="2" transform="translate(1368 487)" fill="currentColor"/>
                                                </g>
                                              </g>
                                            </g>
                                          </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="product__showing--count">Showing 1–9 of 21 results</p> --}}
                    </div>
                    <div class="all-products">
                        <div class="tab_content">
                            {{--===================== Product Grid ===============--}}
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner">
                                    <div class="row mb--n30">
                                        @foreach($products as $key => $product)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30 brand-{{ $product->brand_id }}">
                                            <form action="{{ route('add-to-cart') }}" class="cart-submit" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <article class="product__card">
                                                    <div class="product__card--thumbnail">
                                                        <a class="product__card--thumbnail__link display-block"
                                                            href="{{ route('products.show', $product->id) }}">
                                                            @foreach ($product->productImages as $key => $productImage)
                                                                @if ($key == 0)
                                                                    <img class="product__card--thumbnail__img product__primary--img"
                                                                        src="{{ env('BASE_IMAGE_PATH')}}{{$productImage->images }}"
                                                                        alt="product-img">
                                                                @else
                                                                    <img class="product__card--thumbnail__img product__secondary--img"
                                                                        src="{{ env('BASE_IMAGE_PATH')}}{{$productImage->images }}"
                                                                        alt="product-img">
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                        {{-- <span class="product__badge">-14%</span> --}}
                                                        <ul
                                                            class="product__card--action d-flex align-items-center justify-content-center">
                                                            <li class="product__card--action__list">
                                                                <a class="product__card--action__btn"
                                                                    title="Quick View" data-bs-toggle="modal"
                                                                    data-bs-target="#examplemodal"
                                                                    href="javascript:void(0)">
                                                                    <svg class="product__card--action__btn--svg"
                                                                        width="16" height="16"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                                                            fill="currentColor"></path>
                                                                    </svg>
                                                                    <span class="visually-hidden">Quick View</span>
                                                                </a>
                                                            </li>
                                                            <li class="product__card--action__list">
                                                                <a class="wishlist-btn toggle-Wishlist product__card--action__btn" title="Wishlist" data-id="{{ $product->id }}" id="wishlist-btn{{$product->id}}"
                                                                data-href="{{ route('wishlists.add-and-remove') }}">
                                                                    <svg class="product__card--action__btn--svg"
                                                                        width="18" height="18"
                                                                        viewBox="0 0 16 13" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                    <span class="visually-hidden">Wishlist</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @php
                                                        $rating = $product->averageRating;
                                                        $reviewCount = $product->reviewCount;
                                                        $maxRating = 5; // Maximum rating value (e.g., 4.5 stars)
                                                        $filledStars = floor($rating); // Whole number of filled stars
                                                        $halfStar = $rating - $filledStars; // Check if there's a half star
                                                        $emptyStars = $maxRating - $filledStars - ($halfStar > 0 ? 1 : 0); // Calculate empty stars

                                                        $filledStars = max(0, min($maxRating, $filledStars));
                                                        $emptyStars = max(0, min($maxRating, $emptyStars));
                                                    @endphp
                                                    <div class="product__card--content">
                                                        <ul class="rating product__card--rating d-flex">
                                                        @for ($i = 0; $i < $filledStars; $i++)
                                                            @if($i >= 4)
                                                                
                                                                <li class="rating__list">
                                                                    <span class="rating__icon">
                                                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                            @else 
                                                            <li class="rating__list">
                                                                    <span class="rating__icon">
                                                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </li>
                                                            @endif
                                                        @endfor

                                                        @if ($halfStar > 0)
                                                            <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <mask id="half-star-mask">
                                                                            <rect x="0" y="0" width="7" height="13" fill="white" />
                                                                        </mask>
                                                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                                            fill="currentColor" />
                                                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                                            fill="red" mask="url(#half-star-mask)" />
                                                                    </svg> 
                                                                </span>
                                                            </li>
                                                        @endif

                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </li>
                                                        @endfor
                                                            <li>
                                                                <span class="rating__review--text">({{ $product->reviewCount }}) Review</span>
                                                            </li>
                                                        </ul>
                                                        <h3 class="product__card--title"><a
                                                                href="#">{{ ucwords($product->product_name) }}
                                                            </a></h3>
                                                        <div class="product__card--price">
                                                            <span
                                                                class="current__price">${{ number_format($product->cost_price, 2) }}</span>
                                                            <span
                                                                class="old__price">${{ number_format($product->cost_price, 2) }}</span>
                                                        </div>
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <div class="product__card--footer">
                                                            <button type="submit" class="product__card--btn primary__btn">
                                                                <svg width="14" height="11"
                                                                    viewBox="0 0 14 11" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                                Add to cart
                                                            </button>
                                                        </div>
                                                    </div>
                                                </article>
                                            </form>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--===================== End Product Grid ===============--}}

                            {{--===================== Product List ===================--}}
                            <div id="product_list" class="tab_pane">
                                <div class="product__section--inner product__section--style3__inner">
                                    <div class="row row-cols-1 mb--n30">
                                        @foreach ($products as $key => $product)
                                            <div class="col mb-30">
                                                <form action="{{ route('add-to-cart') }}" class="cart-submit" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="product__card product__list d-flex align-items-center">
                                                        <div class="product__card--thumbnail product__list--thumbnail">
                                                            <a class="product__card--thumbnail__link display-block"
                                                                href="{{ route('products.show', $product->id) }}">
                                                                @foreach ($product->productImages as $key => $productImage)
                                                                    @if ($key == 0)
                                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                                            src="{{ env('BASE_IMAGE_PATH')}}{{$productImage->images }}"
                                                                            alt="product-img">
                                                                    @else
                                                                        <img class="product__card--thumbnail__img product__secondary--img"
                                                                            src="{{ env('BASE_IMAGE_PATH')}}{{$productImage->images }}"
                                                                            alt="product-img">
                                                                    @endif
                                                                @endforeach
                                                            </a>
                                                            <ul
                                                                class="product__card--action d-flex align-items-center justify-content-center">
                                                                <li class="product__card--action__list">
                                                                    <a class="product__card--action__btn"
                                                                        title="Quick View" data-bs-toggle="modal"
                                                                        data-bs-target="#examplemodal"
                                                                        href="javascript:void(0)">
                                                                        <svg class="product__card--action__btn--svg"
                                                                            width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                        <span class="visually-hidden">Quick View</span>
                                                                    </a>
                                                                </li>
                                                                <li class="product__card--action__list">

                                                                    <a @class(["wishlist-btn toggle-Wishlist product__card--action__btn", 'added'=> optional($product->wishlist)->product_id]) title="Wishlist" data-id="{{ $product->id }}" id="wishlist-btn{{$product->id}}"
                                                                    data-href="{{ route('wishlists.add-and-remove') }}">
                                                                        <svg class="product__card--action__btn--svg"
                                                                            width="18" height="18"
                                                                            viewBox="0 0 16 13" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                        <span class="visually-hidden">Wishlist</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        @php
                                                            $rating = $product->averageRating;
                                                            $reviewCount = $product->reviewCount;
                                                            $maxRating = 5; // Maximum rating value (e.g., 4.5 stars)
                                                            $filledStars = floor($rating); // Whole number of filled stars
                                                            $halfStar = $rating - $filledStars; // Check if there's a half star
                                                            $emptyStars = $maxRating - $filledStars - ($halfStar > 0 ? 1 : 0); // Calculate empty stars

                                                            $filledStars = max(0, min($maxRating, $filledStars));
                                                            $emptyStars = max(0, min($maxRating, $emptyStars));
                                                        @endphp
                                                        <div class="product__card--content product__list--content">
                                                            <h3 class="product__card--title"><a href="#">{{ $product->product_name }} </a></h3>
                                                            <ul class="rating product__card--rating d-flex">
                                                                @for ($i = 0; $i < $filledStars; $i++)
                                                                    @if($i >= 4)
                                                                        <li class="rating__list">
                                                                            <span class="rating__icon">
                                                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                                                </svg>
                                                                            </span>
                                                                        </li>
                                                                    @else 
                                                                    <li class="rating__list">
                                                                            <span class="rating__icon">
                                                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                                                                </svg>
                                                                            </span>
                                                                        </li>
                                                                    @endif
                                                                @endfor

                                                                @if ($halfStar > 0)
                                                                    <li class="rating__list">
                                                                        <span class="rating__icon">
                                                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <mask id="half-star-mask">
                                                                                    <rect x="0" y="0" width="7" height="13" fill="white" />
                                                                                </mask>
                                                                                <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                                                    fill="currentColor" />
                                                                                <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                                                    fill="red" mask="url(#half-star-mask)" />
                                                                            </svg> 
                                                                        </span>
                                                                    </li>
                                                                @endif

                                                                @for ($i = 0; $i < $emptyStars; $i++)
                                                                    <li class="rating__list">
                                                                        <span class="rating__icon">
                                                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                                            </svg>
                                                                        </span>
                                                                    </li>
                                                                @endfor
                                                                <li>
                                                                    <span class="rating__review--text">({{ $product->reviewCount }}) Review</span>
                                                                </li>
                                                            </ul>
                                                            <div class="product__list--price">
                                                                <span
                                                                    class="current__price">${{ number_format($product->cost_price, 2) }}</span>
                                                                <span
                                                                    class="old__price">${{ number_format($product->cost_price, 2) }}</span>
                                                            </div>
                                                            <p class="product__card--content__desc mb-20">
                                                                {!! $product->description !!}</p>
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button  type="submit" class="product__card--btn primary__btn">+
                                                                Add to cart</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--===================== End Product List ===============--}}
                        </div>
                        {{--===================== Pagination ===============--}}
                        <div class="pagination__area">
                            <nav class="pagination justify-content-center">
                                <!-- Previous Page Link -->
                                @if ($products->total() > $products->perPage())    
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled pagination__list" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                            <span class="page-link pagination__item--arrow link" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                                                </svg>
                                                <span class="visually-hidden">page left arrow</span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item pagination__list">
                                            <a class="page-link pagination__item--arrow link"
                                                href="{{ $products->appends(request()->except(['page', 'perPage']))->previousPageUrl() }}" rel="prev"
                                                aria-label="@lang('pagination.previous')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                                                </svg>
                                                <span class="visually-hidden">page left arrow</span>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Numbered Page Links -->
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }} pagination__list">
                                            <a class="page-link pagination__item link"
                                                href="{{ $products->appends(array_merge(request()->except('page'), ['perPage' => request('perPage')]))->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Page Link -->
                                    @if ($products->hasMorePages())
                                        <li class="page-item pagination__list">
                                            <a class="page-link pagination__item--arrow link"
                                                href="{{ $products->appends(request()->except(['page', 'perPage']))->nextPageUrl() }}" rel="next"
                                                aria-label="@lang('pagination.next')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100" />
                                                </svg>
                                                <span class="visually-hidden">page right arrow</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled pagination__list" aria-disabled="true" aria-label="@lang('pagination.next')">
                                            <span class="page-link pagination__item--arrow link" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100" />
                                                </svg>
                                                <span class="visually-hidden">page right arrow</span>
                                            </span>
                                        </li>
                                    @endif
                                @endif    
                            </nav>
                        </div>
                        {{--===================== End Pagination ===============--}}    
                    </div>
                </div>
            </div>
        </div>
        <!-- End shop section -->

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

<script>
    $(document).ready(function() {
        $(document).on('click', '.brandProducts', function() {
            let brandId = $(this).data('id');
            $.ajax({
                url: '{{ route('products.index') }}?brandId='+ encodeURIComponent(brandId),
                method: 'GET',
                success: function(response) {
                    if(response.success == true) {
                        // Update products container with the response data
                        $('.all-products').html(response.productsHtml);
                        // $('.tab_content').addClass('active');
                    }
                },
            });
        });
        
        $(document).on('click','.priceButton', function() {
            var minPrice = $('#minPrice').val();
            console.log(minPrice);
            var maxPrice = $('#maxPrice').val();
            console.log(maxPrice);

            $.ajax({
                url: '{{ route('products.index') }}?min_price=' + minPrice + '&max_price=' + maxPrice,
                method: 'GET',
                success: function(response) {
                    if(response.success == true) {
                        $('.all-products').html(response.productsHtml);
                    }
                },
            });
        });

        $('#itemsPerPage').on('change', function() {
            var selectedValue = $(this).val();
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set('perPage', selectedValue);   
            //params.delete('page');
            url.search = params.toString();
            window.history.pushState({}, '', url);

            $.ajax({
                url: '{{ route('products.index') }}?perPage='+ selectedValue,
                method: 'GET',
                success: function(response) {
                    if(response.success == true) {
                        $('.all-products').html(response.productsHtml);
                    }
                },
            });
        });

        $('#sortBy').on('change', function() {
            var selectedValue = $(this).val();
            console.log(selectedValue);
            $.ajax({
                url: '{{ route('products.index') }}?sort_by='+ selectedValue,
                method: 'GET',
                success: function(response) {
                    if(response.success == true) {
                        $('.all-products').html(response.productsHtml);
                    }
                },
            });
        });
    });
</script>


<!-- <script>
   $(function() {
        // Wishlist toggle
        $(document).on('click', '.toggle-Wishlist', function() {
            let productId = $(this).data('id');
            console.log(productId);
            let href = $(this).data('href');

            $.ajax({
                url: href,
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: productId,
                },
                success: function(response) {
                    if (response.success) {
                        $('.wishlist').html(response.wishlist.count);
                    }
                }
            });
        });

        // Cart submit
        $(document).on('submit', '.cart-submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this); // Create a FormData object
            $.ajax({
                url: $(this).attr('action'), // Form action URL
                method: $(this).attr('method'), // Form method
                data: formData,
                contentType: false, // Needed for FormData
                processData: false, // Needed for FormData
                success: function(response) {
                    // Handle the success response here
                    if (response.success == true) {
                        $(document).find('.offCanvas__minicart').html(response.data);
                        $(document).find('.item-count-cart').html(response.count);
                        rebindQuantityEvents(); // Rebind events after updating the cart
                    } else {
                        alert('Error');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response here
                    alert('Something went wrong. Please try again.');
                }
            });
            return false;
        });

        // Close cart
        $(document).on('click', '.close-cart', function() {
            if ($('body').hasClass('offCanvas__minicart_active')) {
                $('body').removeClass('offCanvas__minicart_active');
            }
            $('.offCanvas__minicart').removeClass('active');
        });
        var BindingStatus = 1;
        function rebindQuantityEvents() {
            // Unbind any existing handlers to avoid duplicate bindings
            $(document).off('click', '.increase');
            $(document).off('click', '.decrease');

            // Increase quantity
            $(document).on('click', '.increase', function() {
                console.log('Increase button clicked');
                var productId = $(this).attr("data-id");
                console.log('Product ID: ' + productId);
                var quantityInput = $(this).parent().find('.quantity__number');
                var currentValue = parseInt(quantityInput.val());
                var qty = currentValue + 1;
                updateQuantity(productId, qty, quantityInput);
            });

            // Decrease quantity
            $(document).on('click', '.decrease', function() {
                console.log('Decrease button clicked');
                var productId = $(this).attr("data-id");
                console.log('Product ID: ' + productId);
                var quantityInput = $(this).parent().find('.quantity__number');
                var currentValue = parseInt(quantityInput.val());
                var qty = currentValue - 1;
                if (qty > 0) { // Prevent quantity from going below 1
                    updateQuantity(productId, qty, quantityInput);
                }
            });
        }

        // Bind events on page load
        if(BindingStatus == 1){
            BindingStatus = 2;
            rebindQuantityEvents();
        }

        
    $(document).on('click', '.remove-from-cart', function(e) {
    var buttonevent = $(this);
    var id = $(this).attr("data-id");
    var minicartProduct = buttonevent.closest('.minicart__product--items');
    var price = parseFloat(minicartProduct.find('.minicart__current--price').text().replace('$', ''));
    var quantity = parseInt(minicartProduct.find('.quantity__number').val());
    var itemTotal = price * quantity;

    // var totalAmountElem = $(this).closest('.totalAmount');
    // var grandTotalElem = $(this).closest('.grandTotal');

    var totalAmountElem = buttonevent.closest('.offCanvas__minicart').find('.totalAmount b');
    var grandTotalElem = buttonevent.closest('.offCanvas__minicart').find('.grandTotal b');

    var totalAmount = parseFloat(totalAmountElem.text().replace('$', ''));

    var grandTotal = parseFloat(grandTotalElem.text().replace('$', ''));

    console.log('before removal Price: ' + price);
    console.log('Quantity: ' + quantity);
    console.log('Item Total: ' + itemTotal);
    console.log('Total Amount Before: ' + totalAmount);
    console.log('Grand Total Before: ' + grandTotal);

    e.preventDefault();
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
                    buttonevent.closest('.minicart__product--items').remove();
                    
                    // Subtract the itemTotal from totalAmount and grandTotal
                    totalAmount -= itemTotal;
                    grandTotal -= itemTotal;

                    console.log('Total Amount After: ' + totalAmount);
                    console.log('Grand Total After: ' + grandTotal);

                    // Update the total amount and grand total in the DOM
                    totalAmountElem.text('$' + (totalAmount >= 0 ? totalAmount.toFixed(2) : '0.00'));
                    grandTotalElem.text('$' + (grandTotal >= 0 ? grandTotal.toFixed(2) : '0.00'));

                    var cartCount = $('body').find('.item-count-cart').first().text();
                    console.log('Cart Count Before: ' + cartCount);
                    if (!isNaN(cartCount) && cartCount > 0) {
                        cartCount--; // Decrement the cart count by one
                        $(document).find('.item-count-cart').html(cartCount);
                        console.log('Cart Count After: ' + cartCount);
                    }
                }
            }
        });
    }
});


        function updateQuantity(productId, quantity, quantityInput) {
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

                            // Update the quantity input value
                            quantityInput.val(quantity);
                        } else {
                            // window.location.reload();
                        }
                    }
                }
            });
        }
    });

    // Function to show products by category
    function showProducts(id) {
        $('.all-products').hide();
        $('.product-' + id).show();
    }

    function showAllProducts() {
        $('.all-products').show();
    }
</script> -->
@endsection
