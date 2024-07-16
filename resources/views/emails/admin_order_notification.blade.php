@component('mail::message')

# New Order Notification



Yayy!! Your order is confirmed. Check out the details below:



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



Your order is in excellent hands. We prioritize a seamless experience, ensuring your package arrives promptly. Should any questions or requirements emerge along the way, our dedicated support team is readily available to assist you.



Thank you for your order.



Best Regards,



{{ env('APP_NAME') }}

@endcomponent

