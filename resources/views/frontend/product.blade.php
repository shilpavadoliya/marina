@extends('frontend.layouts.app')

@section('content')

        <section class="singleProduct | padding-top-main">

            <div class="container">

                <div class="row row-gap-5 gx-5">

                    <div class="col-md-6">


                        <div class="swiper productPageSwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ $product->getMainImageUrlAttribute() }}" alt="">
                                </div>
                                @foreach($product->image_url['imageUrls'] as $images)
                                <div class="swiper-slide">
                                    <img src="{{ $images }}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="position-relative">
                            <div class="swiper productPageThumbSwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ $product->getMainImageUrlAttribute() }}" alt="">
                                    </div>
                                    @foreach($product->image_url['imageUrls'] as $images)
                                    <div class="swiper-slide">
                                        <img src="{{ $images }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="wyp-prev swiper-button-prev"><img src="{{ asset('assets/images/icons/left-arrow.svg') }}" alt=""></div>
                            <div class="wym-next swiper-button-next"><img src="{{ asset('assets/images/icons/right-arrow.svg') }}" alt=""></div>
                        </div>
                    </div>


                    <div class="col-md-6">

                        <div class="details">
                            <!--
                            <div class="d-flex align-items-center">

                                <div class="ratings">

                                    <i class="fa fa-star rating-color"></i>

                                    <i class="fa fa-star rating-color"></i>

                                    <i class="fa fa-star rating-color"></i>

                                    <i class="fa fa-star rating-color"></i>

                                    <i class="fa fa-star"></i>

                                </div>

                                <h5 class="review-count">12 Reviews</h5>

                            </div> -->

                            <h1 class="mt-4">{{ $product->name }}</h1>

                            <ul class="tags">

                                <li><strong>{{ $product->product_unit_quantity }} g </strong></li>

                                <!-- <li>4-5 pcs</li>

                                <li>Serves 3</li> -->

                            </ul>

                            <p class="des">

                                {!! $product->product_description !!}

                            </p>

                            <div class="priceWrapper mt-5">

                                <div class="cost">

                                    Rs. Per Pack : <s class="pe-2 text-dark" style="font-size:16px">₹{{ dicountPrice($product->product_price) }} </s>

                                    <span class="rupee ms-1"> ₹</span>{{ $product->product_price }}

                                    <small class="px-1" style="font-size:14px">{{env('DISCOUNT_PERCENTAGE')."% Off"}}</small>

                                </div>

                                <!-- <p>(Price will be very as per type & quantity picked)</p> -->

                            </div>


                            <div class="actionButtons mt-4">
                                <!--
                                <a href="javascript:void(0)" class="btn1 mainBtn buyNow" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">

                                    <span>Buy Now</span>

                                </a>
                                -->

                                <div class="addToCart">

                                    <button class="mainBtn" style="display:block" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">

                                        <div>

                                            <span>Add to Cart</span>

                                        </div>

                                    </button>

                                    <div class="counterWrapper" style="display: none;">

                                        <div class="number">

                                            <span class="minus border-end-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">-</span>

                                            <input type="text" value="1"/>

                                            <span class="plus border-start-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">+</span>

                                        </div>

                                    </div>

                                    @if(Auth::check())
                                        @if(getWishlist($product->id))
                                            <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Remove from Wishlist</button>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.add', $product) }}" method="POST">
                                                @csrf
                                                <button type="submit">Add to Wishlist</button>
                                            </form>
                                        @endif
                                    @endif

                                </div>

                            </div>

                            <div class="pickup">

                                <div class="icon"><img src="{{ asset('assets/images/icons/check.svg') }}" alt=""></div>

                                <p>
                                    <!--<span class="text-primary-500">Delivery Available by {{ $supplier->name }}</span> -->Usually Delivered in 24-48 hours</p>

                            </div>

                            <!-- <a href="" class="textLink">View store information</a> -->

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="padding-top-main margin-bottom-max">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h1 class="heading2 text-center border-top padding-top-main border-secondary">You may also like</h1>

                    </div>

                </div>

                <div class="row row-gap-5 margin-top-main">
                    @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="productBox">
                            <a href="{{ route('productDetails', $product->id ) }}"class="thumb">
                                <div class="thumb">
                                    <img src="{{ $product->getMainImageUrlAttribute() }}" alt="">
                                </div>
                            </a>

                            <div class="details">
                                <h2>{{ $product->name }}</h2>
                                <ul class="tags">
                                    <li><strong>{{ $product->product_unit_quantity }} g /- Rs. Per Pack</strong></li>
                                </ul>
                            </div>

                            <div class="cartDetails">
                                <div class="price">
                                    <s class="pe-2 text-dark" style="font-size:14px">₹{{ dicountPrice($product->product_price) }} </s>
                                    <span class="rupee">₹</span>
                                    {{ $product->product_price }} 
                                    <small class="px-1" style="font-size:14px">{{env('DISCOUNT_PERCENTAGE')."% Off"}}</small>
                                </div>
                                
                                @if($product->stock == null)

                                <div class="addToCart">

                                    <button class="w-100">

                                        <div>

                                            <span style="font-size:14px">Out of Stock</span>

                                        </div>

                                    </button>

                                </div>

                                @else

                                <div class="addToCart">

                                    <button class="mainBtn" @if(countProductInCart($product->name) != 0)style="display: none;" @endif data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">

                                        <div>

                                            <span>Add</span> <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="">

                                        </div>

                                    </button>

                                    <div class="counterWrapper" @if(countProductInCart($product->name) == 0)style="display: none;" @endif>

                                        <div class="number">

                                            <span class="minus border-end-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">-</span>

                                            <input type="text" value="{{ countProductInCart($product->name) }}"/>

                                            <span class="plus border-start-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit_quantity }}">+</span>

                                        </div>

                                    </div>

                                </div>

                                @endif

                                @if(Auth::check())
                                    @if(getWishlist($product->id))
                                        <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Remove from Wishlist</button>
                                        </form>
                                    @else
                                        <form action="{{ route('wishlist.add', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit">Add to Wishlist</button>
                                        </form>
                                    @endif
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    @endforeach()

                    

                </div>

            </div>

        </section>



@endsection



@push('scripts')

    <script>

        function triggerButtonClick() {

            window.location.href = "{{ route('shopping-cart') }}";

          }



          $(".buyNow").on('click', function () {

            setTimeout(triggerButtonClick, 100);

          })

    </script>

@endpush