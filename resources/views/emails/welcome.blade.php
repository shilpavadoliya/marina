@component('mail::message')
# Welcome to Our Website

Hello {{ $user['first_name'] }},

Welcome to our website! We're excited to have you as a new member of our community.

Thank you for joining us.

Best regards,<br>
{{ env('APP_NAME') }}
@endcomponent
