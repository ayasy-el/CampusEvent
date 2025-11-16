@extends('layouts.app')

@section('title', 'Semua Event Terdaftar')

@section('content')

    <section class="mb-5 md:mb-7 space-y-3">
        <x-page-header title="Event Saya"
            description="Lihat semua event yang sudah kamu daftarkan – dipisah antara yang akan datang dan yang sudah selesai." />

        <x-events.filter-registered/>
        <x-events.summary-registered/>
    </section>

    <x-events.registered-list/>

@endsection

