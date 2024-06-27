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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="details">
                            <div class="d-flex align-items-center">
                                <div class="ratings">
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5 class="review-count">12 Reviews</h5>
                            </div>
                            <h1 class="mt-4">{{ $product->name }}</h1>
                            <ul class="tags">
                                <li><strong>{{ $product->product_unit_quantity }} g</strong></li>
                                <!-- <li>4-5 pcs</li>
                                <li>Serves 3</li> -->
                            </ul>
                            <p class="des">
                                {!! $product->product_description !!}
                            </p>
                            <div class="priceWrapper mt-5">
                                <div class="cost">
                                    Price : <span class="rupee ms-1"> ₹</span>{{ $product->product_price }}
                                </div>
                                <p>(Price will be very as per type & quantity picked)</p>
                            </div>
                            <div class="actionButtons mt-4">
                                <a href="javascript:void(0)" class="btn1 mainBtn buyNow" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">
                                    <span>Buy Now</span>
                                </a>
                                <div class="addToCart">
                                    <button class="mainBtn" style="display:block" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">
                                        <div>
                                            <span>Add to Cart</span>
                                        </div>
                                    </button>
                                    <div class="counterWrapper" style="display: none;">
                                        <div class="number">
                                            <span class="minus border-end-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">-</span>
                                            <input type="text" value="1"/>
                                            <span class="plus border-start-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pickup">
                                <div class="icon"><img src="{{ asset('assets/images/icons/check.svg') }}" alt=""></div>
                                <p><span class="text-primary-500">Delivery Available by {{ $supplier->name }}</span> Usually Delivered in 24 hours</p>
                            </div>
                            <!-- <a href="" class="textLink">View store information</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="padding-top-main margin-bottom-max">
            {{--<div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="heading2 text-center border-top padding-top-main border-secondary">You may also like</h1>
                    </div>
                </div>
                <div class="row row-gap-5 margin-top-main">
                    <div class="col-md-3">
                        <div class="productBox">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/products/pro1.jpg') }}" alt="">
                            </div>
                            <div class="details">
                                <h2>MACKERAL Whole</h2>
                                <div class="des">
                                    Fresh whole fish for curries & fry-up
                                </div>
                                <ul class="tags">
                                    <li><strong>1000 g</strong></li>
                                    <li>4-5 pcs</li>
                                    <li>Serves 3</li>
                                </ul>
                            </div>
                            <div class="cartDetails">
                                <div class="price">
                                    <span class="rupee">₹</span>
                                    575
                                </div>
                                <div class="addToCart">
                                    <button class="mainBtn" style="display:block">
                                        <div>
                                            <span>Add</span> <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="">
                                        </div>
                                    </button>
                                    <div class="counterWrapper" style="display: none;">
                                        <div class="number">
                                            <span class="minus border-end-0">-</span>
                                            <input type="text" value="1"/>
                                            <span class="plus border-start-0">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>--}}
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