@extends('frontend.layouts.app')
@section('content')
    
    <section class="shoppingFlow | padding-top-main">
        <div class="container">
            <div class="row row-gap-5 gx-5 justify-content-md-center">
                <ul>
                    <li class="active">
                        <div class="title">My Order</div>
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
                                @php($total = 0 )
                                @foreach ($order as $order)
                                @php($total += $order->product_price * $order->quantity)
                                <tr class="">
                                    <td>
                                        <div class="product">
                                            <div class="thumb">
                                                <img src="assets/images/products/pro1.jpg" alt="">
                                            </div>
                                            <div class="details">
                                                <h1>{{ $order->productName }}</h1>
                                                <ul class="tags">
                                                    <li><strong>{{ $order->productUnit }} g</strong></li>
                                                    <li>4-5 pcs</li>
                                                    <li>Serves 3</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            {{ $order->product_price }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="number">
                                            <input type="text" value="{{ $order->quantity }}"/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price itemTotal">
                                            <span class="rupee">₹</span>
                                            {{ $order->product_price * $order->quantity }}
                                        </div>
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
                            <div class="title">Grand Total :</div>
                            <div class="total">
                                <span class="rupee">₹</span>
                                <span class="jqueryTotal">{{ $total }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </section>

@endsection