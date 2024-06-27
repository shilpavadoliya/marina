@extends('frontend.layouts.app')
@section('content')
    
    <section class="whatsyourmind | padding-top-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="heading2 text-center">{{ $getCategory->name?? '' }}</h1>
                    <h2 class="subHeading2 text-center">Freshest meats and much more!</h2>
                </div>
            </div>
            <div class="row margin-top-main">
                <div class="col-12 position-relative">
                    <div class="swiper wymSwiper">
                        <div class="swiper-wrapper">
                            
                            @foreach($getSubCategory as $key=>$subCategory)
                            <div class="swiper-slide">
                                <a href="#" class="item subCategory keyItem-{{ $key }}" data-subcategory-id="{{ $subCategory->id }}" data-subcategory-name="{{ $subCategory->name }}">
                                    <div class="thumb">
                                        <img src="{{ $subCategory->image_url }}" alt="">
                                    </div>
                                    <h3>{{ $subCategory->name }}</h3>
                                </a>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="wyp-prev swiper-button-prev"><img src="assets/images/icons/left-arrow.svg" alt=""></div>
                    <div class="wym-next swiper-button-next"><img src="assets/images/icons/right-arrow.svg" alt=""></div>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1 class="heading2 subcategoryName"></h1>
                    <h2 class="subHeading2"><span class="productCount">4</span> Items</h2>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="btn-group filter">
                        <button class="btn3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/images/icons/filter.svg" alt=""><Span>Filter</Span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active added" id="Delivery-Time-tab" data-bs-toggle="pill" data-bs-target="#Delivery-Time" type="button" role="tab" aria-controls="Delivery-Time" aria-selected="true">Delivery Time</button>
                                    <button class="nav-link" id="Mutton-Type-tab" data-bs-toggle="pill" data-bs-target="#Mutton-Type" type="button" role="tab" aria-controls="Mutton-Type" aria-selected="false">Mutton Type</button>
                                    <button class="nav-link" id="Best-suited-tab" data-bs-toggle="pill" data-bs-target="#Best-suited" type="button" role="tab" aria-controls="Best-suited" aria-selected="false">Best suited for</button>
                                    <button class="nav-link" id="Pack-Size-tab" data-bs-toggle="pill" data-bs-target="#Pack-Size" type="button" role="tab" aria-controls="Pack-Size" aria-selected="false">Pack Size</button>
                                    
                                </div>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="Delivery-Time" role="tabpanel" aria-labelledby="Delivery-Time-tab" tabindex="0">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" name="deliveryTime" type="checkbox" id="express" checked>
                                                <label class="form-check-label" name="deliveryTime" for="express">
                                                Express
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" name="deliveryTime" type="checkbox" id="today" checked>
                                                <label class="form-check-label" name="deliveryTime" for="today">
                                                Today
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" name="deliveryTime" type="checkbox" id="tomorrow">
                                                <label class="form-check-label" name="deliveryTime" for="tomorrow">
                                                Tomorrow
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="Mutton-Type" role="tabpanel" aria-labelledby="Mutton-Type-tab" tabindex="0">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" name="MuttonType" type="checkbox" id="Goat">
                                                <label class="form-check-label" name="MuttonType" for="Goat">
                                                Goat
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" name="MuttonType" type="checkbox" id="Lamb">
                                                <label class="form-check-label" name="MuttonType" for="Lamb">
                                                Lamb
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="Best-suited" role="tabpanel" aria-labelledby="Best-suited-tab" tabindex="0">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" name="Bestsuited" type="checkbox" id="Boneless">
                                                <label class="form-check-label" name="Bestsuited" for="Boneless">
                                                Boneless
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" name="Bestsuited" type="checkbox" id="BoneIn">
                                                <label class="form-check-label" name="Bestsuited" for="BoneIn">
                                                Bone-in
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="Pack-Size" role="tabpanel" aria-labelledby="Pack-Size-tab" tabindex="0">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" name="PackSize" type="checkbox" id="RegularPack">
                                                <label class="form-check-label" name="PackSize" for="RegularPack">
                                                Regular Pack
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" name="PackSize" type="checkbox" id="LargePack">
                                                <label class="form-check-label" name="PackSize" for="LargePack">
                                                Large Pack
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="fiterButtons">
                                <a href="" class="btn3">Clear Filter</a>
                                <a href="" class="btn1">View 4 Items</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-gap-5 margin-top-main">
                
                @foreach($products as $product)
                    <div class="col-md-3 products subcategory-{{ $product->sub_category_id }}">
                        <div class="productBox">
                            <a href="{{ route('productDetails', $product->id ) }}"class="thumb">
                                <div class="swiper-slide">
                                    <img src="{{ $product->getMainImageUrlAttribute() }}" alt="">
                                </div>
                            </a>
                            <div class="details">
                                <h2>{{ $product->name }}</h2>
                                {{--<div class="des">
                                    {!! $product->product_description !!}
                                </div>--}}
                                <ul class="tags">
                                    <li><strong>{{ $product->product_unit_quantity }} g</strong></li>
                                </ul>
                            </div>
                            <div class="cartDetails">
                                <div class="price">
                                    <span class="rupee">₹</span>
                                    {{ $product->product_price }} 
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
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            
            renderingProduct('.keyItem-0');

            $('.subCategory').click(function() {
                renderingProduct($(this));
            });

            function renderingProduct(btnclick){
                var subcategoryId = $(btnclick).data('subcategory-id');
                var subcategoryName = $(btnclick).data('subcategory-name');
                var productCount = $('.subcategory-' + subcategoryId + ' > div').length;
                
                // Show products for the clicked subcategory
                $('.products').hide();
                $('.subcategory-' + subcategoryId).show();

                $('.subcategoryName').html(subcategoryName);
                $('.productCount').html(productCount);
            }
        });

    </script>
@endpush