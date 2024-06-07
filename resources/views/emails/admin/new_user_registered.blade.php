@component('mail::message')

Hello Admin,

The New User Register in our Website.
<br>
<b>Full Name :</b> {{ $user['first_name'].' '.$user['last_name'] }}
<br>
<b>E-mail :</b> {{ $user['email'] }}
<br>
<b>Phone No. :</b> {{ $user['phone'] }}
<br>

Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent
