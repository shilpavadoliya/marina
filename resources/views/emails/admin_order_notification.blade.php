@component('mail::message')
# New Order Notification

We're excited to inform you that a new order has been successfully placed on our platform. Here are the details:

**Order Number:** {{ $order->order_number }}

**Date of Order:** {{ $order->created_at }}

**Customer Name:** {{ $order->user->first_name }}

**Customer Email:** {{ $order->user->email }}

**Items Ordered:**
@foreach($order->items as $item)
- {{ $item->product_name }}
@endforeach

**Total Amount:** {{ $order->total_amount }}

Please ensure that the order is processed promptly and that the customer receives excellent service. If you have any questions or need further information regarding this order, feel free to contact the customer directly or reach out to our support team.

Thank you for your attention to this matter.

Best Regards,

{{ env('APP_NAME') }}
@endcomponent
