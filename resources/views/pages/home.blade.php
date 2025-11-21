@extends('layouts.app')

@section('title', 'Portal Event Kampus')

@section('content')
<main>
    <x-home.hero :count="$eventsCount"/>
    <x-home.upcoming-events :events="$upcomingEvents" />
    @if ($featuredEvent)
        <x-home.featured-event :event="$featuredEvent" />
    @endif
    <x-home.explore-categories :categories="$categories" />
    {{-- <x-home.organizations/> --}}
    <x-home.how-it-works/>
    <x-home.benefits/>
    <x-home.final-cta/>
</main>

@endsection
