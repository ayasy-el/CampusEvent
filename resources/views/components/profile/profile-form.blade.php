@props([
    'action' => '#',
    'method' => 'POST',
])

@php
    $httpMethod = strtoupper($method);
@endphp

<form action="{{ $action }}" method="{{ $httpMethod === 'GET' ? 'GET' : 'POST' }}" enctype="multipart/form-data"
    {{ $attributes->merge([
        'class' => 'bg-white/95 rounded-3xl border border-slate-100 shadow-sm p-4 md:p-6 space-y-5 md:space-y-6',
    ]) }}>
    @if ($httpMethod !== 'GET')
        @csrf
    @endif

    @if (!in_array($httpMethod, ['GET', 'POST']))
        @method($httpMethod)
    @endif

    {{ $slot }}
</form>
