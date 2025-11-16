@extends('layouts.app')

@section('title', 'Show Events')

@section('content')

    <x-events.breadcrumbs />
    <x-events.hero />
    <main
        class="grid gap-5 md:gap-6 md:grid-cols-[minmax(0,2fr)_minmax(260px,1fr)] lg:grid-cols-[minmax(0,2.2fr)_minmax(280px,1fr)]">
        <x-events.detail />
        <x-events.sidebar />
    </main>

@endsection
