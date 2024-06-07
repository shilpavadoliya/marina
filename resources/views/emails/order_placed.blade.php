@component('mail::message')
# Order Successfully Placed

We are delighted to inform you that your order has been successfully placed! Thank you for choosing {{ env('APP_NAME') }} for your purchase. Below are the details of your order:

**Order Number:** {{ $order->order_number }}

**Date of Order:** {{ $order->created_at }}

**Total Amount:** {{ $order->total_amount }}

Your order is now being processed, and you will receive a confirmation email once it has been dispatched. If you have any questions or concerns regarding your order, feel free to reach out to our customer support team at {{ env('MAIL_ADMIN_ADDRESS') }} or by replying to this email.

Thank you for shopping with us!

Best Regards,

{{ env('APP_NAME') }}

@endcomponent
