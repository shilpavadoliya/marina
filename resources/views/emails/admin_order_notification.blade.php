@component('mail::message')
# New Order Notification

We're excited to inform you that a new order has been successfully placed on our platform. Here are the details:

**Order Number:** {{ $order->reference_code }}

**Date of Order:** {{ $order->created_at }}

**Customer Name:** {{ $user->first_name }}

**Customer Email:** {{ $user->email }}

**Items Ordered:**
@foreach($orderItem as $item)
**Product Name:** {{ $item->product->name }}
**Product Price:** {{ $item->product_cost }}
**Product Quantity:** {{ $item->quantity }}
**Product Sub Total:** {{ $item->sub_total }}
@endforeach

**Total Amount:** {{ $order->grand_total }}

Please ensure that the order is processed promptly and that the customer receives excellent service. If you have any questions or need further information regarding this order, feel free to contact the customer directly or reach out to our support team.

Thank you for your attention to this matter.

Best Regards,

{{ env('APP_NAME') }}
@endcomponent
