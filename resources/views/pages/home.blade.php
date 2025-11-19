@extends('layouts.app')

@section('title', 'Portal Event Kampus')

@section('content')
<main>
    <x-home.hero />
    <x-home.upcoming-events />
    <x-home.featured-event />
    <x-home.explore-categories/>
    {{-- <x-home.organizations/> --}}
    <x-home.how-it-works/>
    <x-home.benefits/>
    <x-home.final-cta/>
</main>

@endsection
