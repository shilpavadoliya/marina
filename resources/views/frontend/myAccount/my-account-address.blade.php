@extends('frontend.layouts.app')
@section('content')

    @include('frontend.myAccount.sidebar-account')
                
                <div class="col-md-9">
                    <p>The following addresses will be used on the checkout page by default.</p>
                    <div class="row row-gap-4 mt-4">
                        <div class="col-md-6">
                            <h3 class="heading3">BILLING ADDRESS</h3>
                            @if($userbillingdetails)
                            <p class="mt-3">
                                {{ $userbillingdetails->company_name?? '' }}
                                <br>
                                {{ $userbillingdetails->address?? '' }}
                                <br>
                                {{ $userbillingdetails->city?? '' }}, 
                                {{ $userbillingdetails->state?? '' }}
                                {{ $userbillingdetails->pin_code?? '' }}
                            </p>
                            @endif
                            <a href="{{ route('myaccount-billing-address-edit') }}">Edit</a>
                        </div>
                        <div class="col-md-6">
                            <h3 class="heading3">SHIPPING ADDRESS</h3>
                            @if($usershippingdetails)
                            <p class="mt-3">
                                {{ $usershippingdetails->company_name }}
                                <br>
                                {{ $usershippingdetails->address }}
                                <br>
                                {{ $usershippingdetails->city }}, 
                                {{ $usershippingdetails->state }}
                                {{ $usershippingdetails->pin_code }}
                            </p>
                            <a href="{{ route('myaccount-shipping-address-edit') }}">Edit Address</a>
                            @else
                                <a href="{{ route('myaccount-shipping-address-edit') }}">Add Address</a>
                                <p class="mt-3">You have not set up this type of address yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection