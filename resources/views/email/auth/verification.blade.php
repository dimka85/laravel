@component('mail::message')
    # {{ __('Welcome to the site') }} <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>

{{ __('Verify E-Mail clicking the button below') }}

@component('mail::button', ['url' => $url])
{{ __('Verify E-Mail') }}
@endcomponent

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
