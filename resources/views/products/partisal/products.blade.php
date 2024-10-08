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