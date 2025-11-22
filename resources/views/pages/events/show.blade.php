@extends('layouts.app')

@section('title', $event['title'] ?? 'Detail Event')

@section('content')

    <x-events.breadcrumbs :event="$event" />
    <x-events.hero :event="$event" />
    <main
        class="grid gap-5 md:gap-6 md:grid-cols-[minmax(0,2fr)_minmax(260px,1fr)] lg:grid-cols-[minmax(0,2.2fr)_minmax(280px,1fr)]">
        <x-events.detail :event="$event" />
        <x-events.sidebar :user="$user" :event="$event" />
    </main>

    <x-events.related-events :related-events="$relatedEvents" />
@endsection
