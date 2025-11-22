@extends('layouts.app')

@section('title', $event['title'] ?? 'Detail Event')

@section('content')

    <x-events.breadcrumbs :event="$event" />
    <x-events.hero :event="$event" />

    @if (session('success') || session('error'))
        <div class="mb-4 md:mb-5">
            <div @class([
                'rounded-2xl border p-3.5 md:p-4 text-sm',
                'bg-emerald-50 border-emerald-100 text-emerald-800' => session('success'),
                'bg-red-50 border-red-100 text-red-700' => session('error'),
            ])>
                <p class="font-semibold mb-0.5">
                    {{ session('success') ? 'Pendaftaran Berhasil' : 'Pendaftaran Gagal' }}
                </p>
                <p class="text-[12px] md:text-xs">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>
        </div>
    @endif

    <main
        class="grid gap-5 md:gap-6 md:grid-cols-[minmax(0,2fr)_minmax(260px,1fr)] lg:grid-cols-[minmax(0,2.2fr)_minmax(280px,1fr)]">
        <x-events.detail :event="$event" />
        <x-events.sidebar :user="$user" :event="$event" />
    </main>

    <x-events.related-events :related-events="$relatedEvents" />
@endsection
