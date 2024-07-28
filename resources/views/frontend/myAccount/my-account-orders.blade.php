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
                                        <td>{{ $orderData->created_at??'' }}</td>
                                        <td>{{ $orderData->getStatusName()??'' }}</td>
                                        <td>{{ $orderData->grand_total??'' }}</td>

                                        @php
                                            $createdAt = strtotime($orderData->created_at);
                                            $now = time();
                                            $differenceInHours = ($now - $createdAt) / 3600;
                                        @endphp
                                        <td>
                                            <a href="{{ route('myaccount-order-details', $orderData->id )}}" class="btn-small d-block">View</a>
                                            @if($differenceInHours < 6 && $orderData->status == 1)
                                                <form id="cancelOrderForm" method="post" action="{{ route('orderCancel') }}" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $orderData->reference_code }}">
                                                </form>
                                                <a href="javascript:void(0)" class="btn-small d-block cancelOrderBtn">Cancel</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
        
@push('scripts')

<script>
    $(document).ready(function() {
        $('.cancelOrderBtn').on('click', function() {
            $(this).siblings('form').submit();
        });

        $('#cancelOrderForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            if (confirm('Are you sure you want to cancle this order?')) {
                this.submit();
            } else {
                return false;
            }
        });
    });
</script>

@endpush
@endsection

