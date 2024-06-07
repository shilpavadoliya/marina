@extends('frontend.layouts.app')
@section('content')
  
        <section class="shoppingFlow | padding-top-main">
            <div class="container">
                <div class="row row-gap-5 gx-5 justify-content-md-center">
                    <ul>
                        <li>
                            <div class="title">Shopping Cart</div>
                            <div class="dot">

                            </div>
                        </li>
                        <li>
                            <div class="title">Details</div>
                            <div class="dot">

                            </div>
                        </li>
                        <li class="active">
                            <div class="title">Complete Order</div>
                            <div class="dot">

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="completeOrder | padding-top-main margin-bottom-max">
            <div class="container">
                <div class="row row-gap-5 gx-5 justify-content-center">
                    <div class="col-md-6">
                        <h1 class="heading2 text-primary-500 text-center">Thank you for Your Order!</h1>
                        <p class="text-center fs-16 fw-semibold mt-3">
                            Thanks for Placing order, your id is #{{ $orderId ?? ''}}<br>
                        will update you shortly.
                        </p>
                        <p class="text-center fs-16 fw-semibold mt-5">
                            Purchase Benifits From Marina
                        </p>
                        <ul class="mt-5">
                            <li>
                                <div class="circle">
                                    <img src="{{ asset('assets/images/icons/quality1.svg') }}" alt="">
                                </div>
                                <h2>Quality 1</h2>
                            </li>
                            <li>
                                <div class="circle">
                                    <img src="{{ asset('assets/images/icons/quality2.svg') }}" alt="">
                                </div>
                                <h2>Quality 2</h2>
                            </li>
                            <li>
                                <div class="circle">
                                    <img src="{{ asset('assets/images/icons/quality1.svg') }}" alt="">
                                </div>
                                <h2>Quality 3</h2>
                            </li>
                            <li>
                                <div class="circle">
                                    <img src="{{ asset('assets/images/icons/quality2.svg') }}" alt="">
                                </div>
                                <h2>Quality 4</h2>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row row-gap-3 gx-3 mt-5 justify-content-center">
                    <div class="col-md-2 col-6">
                        <a href="" class="btn2"><span>View Receipts</span></a>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="" class="btn2"><span>How To Care</span></a>
                    </div>
                </div>

                
            </div>
        </section>
        
    
    @include('frontend.layouts.side-modal')

@endsection

