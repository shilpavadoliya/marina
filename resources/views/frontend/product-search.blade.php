@extends('frontend.layouts.app')
@section('content')
        
        <section class="padding-top-main pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="heading2 text-center">Result Your Search!</h1>
                        <h2 class="subHeading2 text-center">Most Popular Product Near You!</h2>
                    </div>
                </div>
                <div class="row row-gap-5 margin-top-main">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <div class="col-md-3">
                                <div class="productBox">
                                    <a href="{{ route('productDetails', $product->id ) }}"class="thumb">
                                        @if (array_key_exists('imageUrls', $product->image_url)) 
                                            @foreach($product->image_url['imageUrls'] as $images)
                                            
                                            <div class="swiper-slide">
                                                <img src="{{ $images }}" alt="">
                                            </div>
                                            @endforeach
                                        @endif
                                    </a>
                                    <div class="details">
                                        <h2>{{ $product->name }}</h2>
                                        <div class="des">
                                            {!! substr($product->product_description, 0, 20) !!}
                                        </div>
                                        <ul class="tags">
                                            <li><strong>{{ $product->product_unit }} g</strong></li>
                                            <li>4-5 pcs</li>
                                            <li>Serves 3</li>
                                        </ul>
                                    </div>
                                    <div class="cartDetails">
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            {{ $product->product_price }} 
                                        </div>
                                        <div class="addToCart">
                                            <button class="mainBtn" @if(countProductInCart($product->name) != 0)style="display: none;" @endif data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">
                                    <div>
                                        <span>Add</span> <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="">
                                    </div>
                                </button>
                                <div class="counterWrapper" @if(countProductInCart($product->name) == 0)style="display: none;" @endif>
                                    <div class="number">
                                        <span class="minus border-end-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">-</span>
                                        <input type="text" value="{{ countProductInCart($product->name) }}"/>
                                        <span class="plus border-start-0" data-id="{{ $product->id }}" data-price="{{ $product->product_price }}" data-name="{{ $product->name }}" data-unit="{{ $product->product_unit }}">+</span>
                                    </div>
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">No products found.</p>
                    @endif
                </div>
            </div>
        </section>

@endsection