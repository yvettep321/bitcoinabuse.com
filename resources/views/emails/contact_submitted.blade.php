@component('mail::message')
# BitcoinAbuse Contact Submitted

### Name

{{ $data['name'] }}

### Email

{{ $data['email'] }}

### Message

{{ $data['message'] }}

### User Info

IP: {{ Request::ip() }}

Location: {{ geoip(Request::ip())->city }}, {{ geoip(Request::ip())->state_name }}, {{ geoip(Request::ip())->country }}

Thanks,<br>
BitcoinAbuse Mailer
@endcomponent
