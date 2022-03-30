@component('mail::message')
# Welcome Mail

Hi User, welcome on board.

@component('mail::button', ['url' => ''])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
