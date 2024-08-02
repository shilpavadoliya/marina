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
                    <li class="active">
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
    <section class="orderPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row row-gap-5 gx-5">
                <div class="col-md-7">
                    <div class="mt-3">
                        <table class="table align-middle">
                            <tbody>
                                @foreach($orderItems as $item)
                                
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="position-relative">
                                                <div class="thumb">
                                                    <img src="{{ $item->product->getMainImageUrlAttribute() }}" alt="">
                                                </div>
                                                <div class="count"><span>{{ $item->quantity ?? 0 }}</span></div>
                                            </div>
                                            <div class="details">
                                                <h1>{{ $item->product->name ?? 0 }}</h1>
                                                <ul class="tags">
                                                    <li><strong>{{ $item->product->product_unit_quantity }} g</strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            {{ $item->sub_total ?? 1 }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <ul class="checkoutSec">
                                <li>
                                    <div class="title">Subtotal :</div>
                                    <div class="price">
                                        <span class="rupee">₹</span>
                                        {{ $order->grand_total }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Shipping Charges :</div>
                                    <div class="price">
                                        Free
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <ul class="checkoutSec pt-2">
                                <li>
                                    <div class="title">Grand Total :</div>
                                    <div class="total">
                                        <span class="rupee">₹</span>
                                        {{ $order->grand_total }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <form method="post" action="{{ route('order-status') }}" id="shiipingForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="paymentID" id="paymentID" value="">
                        <input type="hidden" name="order_number" value="{{ $order->reference_code }}">
                        <input type="hidden" name="company_name" value="{{ $userbillingdetails->company_name??'' }}">
                        <input type="hidden" name="email_address" value="{{ $userbillingdetails->email??'' }}">

                        <div class="row row-gap-3">
                            <div class="col-6">
                                <label for="" class="head">First Name</label>
                                <input type="text" name="first_name" value="{{ $userbillingdetails->first_name?? '' }}" readonly>
                            </div>
                            <div class="col-6">
                                <label for="" class="head">Last Name</label>
                                <input type="text" name="last_name" value="{{ $userbillingdetails->last_name?? '' }}" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="head">Email Address</label>
                                <input type="text" name="email_address" value="{{ $userbillingdetails->email?? '' }}" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="head">Billing Address</label>
                                <input type="text" name="address" value="{{ $userbillingdetails->address?? '' }}">
                            </div>
                            <div class="col-6">
                                <label for="" class="head">City</label>
                                <input type="text" name="city" placeholder="Enter City" value="{{ $userbillingdetails->city?? '' }}">
                            </div>
                            <div class="col-6">
                                <label for="" class="head">State</label>
                                <input type="text" name="state" placeholder="Enter State" value="{{ $userbillingdetails->state?? '' }}">
                            </div>
                            <div class="col-6">
                                <label for="" class="head">Pin Code</label>
                                <input type="text" name="pin_code"  placeholder="Pin Code" value="{{ $userbillingdetails->pin_code?? '' }}">
                            </div>
                            <div class="col-6">
                                <label for="" class="head">Phone</label>
                                <input type="text" name="phone"  placeholder="Phone" value="{{ $userbillingdetails->phone?? '' }}" readonly>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="head">Payment Method </div>
                                <div class="row mt-2 gx-5">
                                    <div class="col-5 d-flex flex-column align-items-center">
                                        <label for="razorpay" class="mb-2">
                                            <!-- <img src="{{ asset('assets/images/icons/Razorpay_logo.svg') }}" style="width: 150px;" alt=""> -->
                                            Cash On Delivery
                                        </label>
                                        <input type="radio" name="paymentMethod" id="cod" value="cod" checked  />
                                    </div>
                                    <div class="col-5 d-flex flex-column align-items-center">
                                        <label for="paytm" class="mb-2">
                                            <img src="{{ asset('assets/images/icons/Paytm_Logo.svg') }}" style="width: 100px;" alt="">
                                        </label>
                                        <input type="radio" name="paymentMethod" id="phonepay" value="phonepay" />
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-12">
                                <label class="d-flex align-items-center mt-3">
                                    <input name="rememberme" type="checkbox" value="forever" > <span class="ms-2 pt-1">Billing address is same as shipping & Save Address</span>
                                </label>
                            </div>
                            <div class="col-12">
                                <button class="btn1 place_order" id="payment_button" type="button"><span>Place Order</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </section>

    <form method="post" action="{{ route('pay-now') }}" id="phonePayForm">
        @csrf

    </form>

@endsection

@push('scripts')
        
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script> 
        $(".place_order").on("click", function(){
            var area_pincode = "{{ session()->get('pincode') }}";
            var customer_pincode = $("input[name='pin_code']").val();
            console.log(customer_pincode);
            
            if(area_pincode != customer_pincode) {
                alert('Opps! Area Pincode & Delivery Pincode Not Matched');
            }
            else {
                var first_name = $("input[name='first_name']").val();
                var address = $("input[name='address']").val();
                var city = $("input[name='city']").val();
                var pin_code = $("input[name='pin_code']").val();
                var email_address = $("input[name='email_address']").val();
                
                if (first_name == "" || address == "" || city == "" || pin_code == "" || email_address == "") {
                    alert("Please fill out required fields");
                }else{
                    let totalAmout = "{{ $order->grand_total * 100 }} "; //Price should be * 100
                    let currency = "INR";
                    let name = first_name;
                    let description = "Food Order";
                    let order_number = $("input[name='order_number']").val();
                    let paymentMethod = $("input[name='paymentMethod']:checked").val();

                    if(paymentMethod == "cod") {
                        $("#paymentID").val('COD');
                        $("#shiipingForm").submit();
                    }else{
                        $("#paymentID").val('PHONEPAY');

                        $("#paymentID").val('COD');
                        $("#phonePayForm").submit();
                    }
                    
                    // var options = {
                    //     key: '{{ env("RAZORPAY_KEY_ID") }}',
                    //     amount: totalAmout, // Example: 50000 paise = INR 500
                    //     currency: currency,
                    //     name: name,
                    //     description: description,
                    //     handler: function(response) {
                    //         $("#paymentID").val(response.razorpay_payment_id);
                    //         $("#shiipingForm").submit();
                    //     },
                    // };

                    // var rzp = new Razorpay(options);

                    // rzp.open();
                    // e.preventDefault();

                    
                    
                }
            }

        });     

    </script>
@endpush