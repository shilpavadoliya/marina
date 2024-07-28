@component('mail::message')

# Order Cancel Notification



Your order is Canceled. Check out the details below:



**Order Number:** {{ $order->reference_code }}



**Date of Order:** {{ $order->created_at }}



**Customer Name:** {{ $user->first_name }}



**Customer Email:** {{ $user->email }}


**Customer Address:** {{ $user->Userbillingdetail->address }}


**Customer State:** {{ $user->Userbillingdetail->city }}


**Customer City:** {{ $user->Userbillingdetail->state }}


**Customer pincode:** {{ $user->Userbillingdetail->pin_code }}


**Customer Phone:** {{ $user->Userbillingdetail->phone }}



**Items Ordered:**

@foreach($orderItem as $item)

**Product Name:** {{ $item->product->name }}

**Product Price:** {{ $item->product_cost }}

**Product Quantity:** {{ $item->quantity }}

**Product Sub Total:** {{ $item->sub_total }}

@endforeach



**Total Amount:** {{ $order->grand_total }}


Best Regards,



{{ env('APP_NAME') }}

@endcomponent

