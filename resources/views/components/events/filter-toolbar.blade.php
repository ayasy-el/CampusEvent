@props(['selected' => []])

@php
    $selectedQ = $selected['q'] ?? request('q');
    $selectedSort = $selected['sort'] ?? request('sort', 'upcoming');
    $hiddenExceptQ = collect(request()->except(['q', 'page']));
    $hiddenExceptSort = collect(request()->except(['sort', 'page']));
@endphp

<section class="mb-4 md:mb-6 space-y-3">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <x-searchbar placeholder="Cari judul event, pembicara, atau organisasi..."
            name="q" :value="$selectedQ"
            :hidden="$hiddenExceptQ" action="{{ route('events') }}" />

        <div class="flex flex-wrap md:justify-end gap-2 md:gap-3">
            <x-events.event-sort :selected="$selectedSort" :hidden="$hiddenExceptSort" />
            <x-events.event-viewmode />
        </div>
    </div>
</section>
