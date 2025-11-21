@extends('layouts.app')

@section('title', 'Semua Event Terdaftar')

@section('content')

    <section class="mb-5 md:mb-7 space-y-3">
        <x-page-header title="Event Saya"
            description="Lihat semua event yang sudah kamu daftarkan" />

        <x-events.filter-registered/>
        <x-events.summary-registered :total="$totalEvents" :upcoming-count="$upcomingEvents->count()" :past-count="$pastEvents->count()" />
    </section>

    <x-events.registered-list :upcoming-events="$upcomingEvents" :past-events="$pastEvents" />

@endsection
