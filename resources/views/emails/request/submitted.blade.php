@component('mail::message')
# Request Submitted

{{ $request->name }} has submitted an appointment request.

@component('mail::button', ['url' => url('/dashboard')])
See it on your Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
