@props(['stretch' => false])

@php
    $baseClass = $stretch ? '' : 'px-4 py-5';
@endphp
<div {{ $attributes->merge(['class' => $baseClass]) }}>
    {{ $slot }}
</div>
