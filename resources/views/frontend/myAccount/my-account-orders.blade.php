@extends('frontend.layouts.app')
@section('content')
    
    @include('frontend.myAccount.sidebar-account')
                
                <div class="col-md-9">
                    <h1 class="heading3">Your Orders</h1>
                        <div class="table-responsive mt-3">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $orderData)
                                    <tr>
                                        <td>{{ $orderData->reference_code??'' }}</td>
                                        <td>{{ $orderData->date??'' }}</td>
                                        <td>{{ $orderData->status??'' }}</td>
                                        <td>{{ $orderData->grand_total??'' }}</td>
                                        <td><a href="{{ route('myaccount-order-details', $orderData->id )}}" class="btn-small d-block">View</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
        
@endsection