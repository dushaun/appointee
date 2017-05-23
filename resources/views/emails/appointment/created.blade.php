@component('mail::message')
# Your Appointment

Your appoint has been created by {{ config('mail.from.name') }}, please see details below:<br><br>

@component('mail::panel')
Name: {{ $appointment->name }}<br>
Date: {{ date('l jS F Y', strtotime($appointment->date)) }} at {{ date('h:i a', strtotime($appointment->date)) }}
@endcomponent

@component('mail::button', ['url' => url('/appointment') . '/' . $appointment->unique_link])
Go to Appointment Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
