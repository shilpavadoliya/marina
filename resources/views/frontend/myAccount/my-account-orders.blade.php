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
                                    @foreach($order as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('F d, Y') }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ countOrderItemWithPrice($order->items)}}</td>
                                        <td><a href="{{ route('myaccount-order-details', $order->id )}}" class="btn-small d-block">View</a></td>
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