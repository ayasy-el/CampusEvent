@extends('layouts.app')

@section('title', 'Show profile')

@section('content')
    <x-profile.header :user="$user" />

    <main class="grid gap-5 md:gap-6">
        <section class="space-y-4 md:space-y-5">
            <x-profile.bio :user="$user" />
            <x-profile.statistik />
        </section>
    </main>
@endsection
