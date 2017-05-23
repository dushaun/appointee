@component('mail::message')
# Your Appointment Request has been Rejected.

Unfortunately, Admin has opted not to give you an appointment at the current time.
If you wish to appeal, please contact admin directly.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
