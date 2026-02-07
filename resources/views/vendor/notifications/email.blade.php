<x-mail::message>
{{-- Header Kustom Gaya Kita --}}
@if (! empty($greeting))
# {{ strtolower($greeting) }}
@else
@if ($level === 'error')
# @lang('whoops.')
@else
# @lang('hello.')
@endif
@endif

{{-- Garis Hitam Khas Kita --}}
<div style="height: 4px; width: 40px; background: #1a1a1a; margin: 20px 0 30px 0;"></div>

{{-- Intro Lines --}}
@foreach ($introLines as $line)
<div style="font-size: 16px; color: #666666; font-style: italic; line-height: 1.6; margin-bottom: 20px;">
{{ $line }}
</div>
@endforeach

{{-- Action Button - Kita paksa warna hitam di CSS Theme nanti --}}
@isset($actionText)
<x-mail::button :url="$actionUrl" color="primary">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
<div style="font-size: 14px; color: #999999; margin-top: 20px;">
{{ $line }}
</div>
@endforeach

{{-- Salutation --}}
<div style="margin-top: 50px; font-size: 12px; color: #cccccc; text-transform: uppercase; letter-spacing: 0.1em;">
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('regards,')<br>
{{ config('app.name') }}
@endif
</div>

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
<div style="font-size: 11px; color: #dddddd;">
@lang(
    "If the button fails, copy this link:",
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</div>
</x-slot:subcopy>
@endisset
</x-mail::message>