@extends('layouts.app')
@section('content')
    
    <div id="main">
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
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="thumb">
                                                    <img src="{{ asset('assets/images/products/pro1.jpg') }}" alt="">
                                                </div>
                                                <div class="details">
                                                    <h1>SURMAI Steaks</h1>
                                                    <ul class="tags">
                                                        <li><strong>1000 g</strong></li>
                                                        <li>4-5 pcs</li>
                                                        <li>Serves 3</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price">
                                                <span class="rupee">₹</span>
                                                575
                                            </div>
                                        </td>
                                        <td>
                                            <div class="number">
                                                <span class="minus">-</span>
                                                <input type="text" value="1"/>
                                                <span class="plus">+</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price">
                                                <span class="rupee">₹</span>
                                                575
                                            </div>
                                        </td>
                                        <td>
                                            <a href="" class="delete"><img src="{{ asset('assets/images/icons/delete.svg') }}" alt=""></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="thumb">
                                                    <img src="{{ asset('assets/images/products/pro1.jpg') }}" alt="">
                                                </div>
                                                <div class="details">
                                                    <h1>SURMAI Steaks</h1>
                                                    <ul class="tags">
                                                        <li><strong>1000 g</strong></li>
                                                        <li>4-5 pcs</li>
                                                        <li>Serves 3</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price">
                                                <span class="rupee">₹</span>
                                                575
                                            </div>
                                        </td>
                                        <td>
                                            <div class="number">
                                                <span class="minus">-</span>
                                                <input type="text" value="1"/>
                                                <span class="plus">+</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price">
                                                <span class="rupee">₹</span>
                                                575
                                            </div>
                                        </td>
                                        <td>
                                            <a href="" class="delete"><img src="{{ asset('assets/images/icons/delete.svg') }}" alt=""></a>
                                        </td>
                                    </tr>
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
                                <div class="price">
                                    <span class="rupee">₹</span>
                                    1000
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
                                    1000
                                </div>
                            </li>
                        </ul>
                        <a href="" class="btn1" ><span>Check Out</span></a>
                    </div>
                </div>
                
            </div>
        </section>
    </div>
    
    @include('layouts.side-modal')

@endsection