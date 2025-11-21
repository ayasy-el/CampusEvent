@extends('layouts.app')

@section('title', 'Semua Event Kampus')

@section('content')
    <x-page-header title="Semua Event Kampus" description="Filter berdasarkan kategori, tanggal, lokasi, dan urutkan sesuai kebutuhanmu ✨">
        <x-slot:badge>
            <x-badge variant="default" size="sm">
                <x-dot /> &nbsp; {{ $eventsCount }} event aktif
            </x-badge>
        </x-slot:badge>

        <x-info-banner title="Event yang sudah kamu daftarkan"
            description="Lihat event <strong>mendatang</strong> dan <strong>riwayat</strong> di Event Saya." href="{{ route('my_events') }}">
                Lihat Semua Event Terdaftar
                <span class="inline-flex items-center justify-center ml-1 px-2 py-0.5 rounded-full bg-white/20 text-[11px]">
                    3 event
                </span>
        </x-info-banner>
    </x-events.page-header>

    <x-events.filter-toolbar :selected="$selectedFilters" />

    <main class="grid gap-4 md:grid-cols-[300px_minmax(0,1fr)] lg:grid-cols-[320px_minmax(0,1fr)] md:gap-6">
        <x-events.filter-sidebar :filters="$filters" :selected="$selectedFilters" />
        <x-events.event-lists :events="$events" :events-count="$eventsCount" />
    </main>
    <x-events.registered-event :events="$registeredEvents"/>

@endsection
