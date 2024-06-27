@extends('frontend.layouts.app')
@section('content')
    
    <section class="shoppingFlow | padding-top-main">
        <div class="container">
            <div class="row row-gap-5 gx-5 justify-content-md-center">
                <ul>
                    <li class="active">
                        <div class="title">Shopping Cart</div>
                        <div class="dot">

                        </div>
                    </li>
                    <li>
                        <div class="title">Details</div>
                        <div class="dot">

                        </div>
                    </li>
                    <li>
                        <div class="title">Complete Order</div>
                        <div class="dot">

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="cartPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive mt-3">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th width="550">Product</th>
                                    <th width="200">Price</th>
                                    <th width="200">Quantity</th>
                                    <th width="200">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach (session()->get('cart') as $cart=>$item)

                                @php
                                    $product = App\Models\Product::whereId($cart)->first();
                                @endphp

                                <tr class="removeDiv_{{$cart}}">
                                    <td>
                                        <div class="product">
                                            <div class="thumb">
                                                <img src="{{ $product->getMainImageUrlAttribute() }}" alt="">
                                            </div>
                                            <div class="details">
                                                <h1>{{ $item['productName'] }}</h1>
                                                <ul class="tags">
                                                    <li><strong>{{ $item['productUnit'] }} g</strong></li>
                                                    <li>4-5 pcs</li>
                                                    <li>Serves 3</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            {{ $item['productPrice'] }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="number">
                                            <span class="minus" data-id="{{ $cart }}" data-price="{{ $item['productPrice'] }}" data-name="{{ $item['productName'] }}" data-unit="{{ $item['productUnit'] }}">-</span>
                                            <input type="text" value="{{ $item['quantity'] }}"/>
                                            <span class="plus"  data-id="{{ $cart }}" data-price="{{ $item['productPrice'] }}" data-name="{{ $item['productName'] }}" data-unit="{{ $item['productUnit'] }}">+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price itemTotal">
                                            <span class="rupee">₹</span>
                                            {{ $item['productPrice'] * $item['quantity'] }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="delete removeCartProdcut" data-id="{{ $cart }}"><img src="{{ asset('assets/images/icons/delete.svg') }}" alt=""></a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-md-9">
                    <ul class="checkoutSec">
                        <li>
                            <div class="title">Subtotal :</div>
                            <div class="price ">
                                <span class="rupee">₹</span>
                                <span class="jqueryTotal">{{ calculateTotalPriceCart(session()->get('cart', [])) }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="title">Coupon code :</div>
                            <form action="">
                                <input type="text" placeholder="Add Coupon code">
                            </form>
                        </li>
                        <li>
                            <div class="title">Grand Total :</div>
                            <div class="total">
                                <span class="rupee">₹</span>
                                <span class="jqueryTotal">{{ calculateTotalPriceCart(session()->get('cart', [])) }}</span>
                            </div>
                        </li>
                    </ul>
                    <a href="{{ route('create-order') }}" class="btn1 checkoutButton @if(calculateTotalPriceCart(session()->get('cart', [])) == 0) d-none @endif "><span>Check Out</span></a>
                </div>
            </div>
            
        </div>
    </section>

@endsection