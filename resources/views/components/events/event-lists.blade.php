@props([
    'events' => collect(),
    'eventsCount' => null,
])

@php
    $events = collect($events);
    $eventsCount = $eventsCount ?? $events->count();
    $showingFrom = $events->isEmpty() ? 0 : 1;
    $showingTo = $events->count();
@endphp

<section class="space-y-3 md:space-y-4">
    <!-- Info summary -->
    @if ($events->isNotEmpty())
        <div class="flex items-center justify-between text-[11px] md:text-xs text-slate-500">
            <p>
                Menampilkan
                <span class="font-semibold text-slate-700">{{ $showingFrom }}–{{ $showingTo }}</span>
                dari
                <span class="font-semibold text-slate-700">{{ $eventsCount }}</span>
                event
            </p>
        </div>
    @endif

    <div id="eventsWrapper" class="space-y-3 md:space-y-4">
        @if ($events->isEmpty())
            <div class="bg-white/60 border border-dashed border-slate-200 rounded-xl p-6 text-center text-slate-500 text-sm">
                Belum ada event yang siap ditampilkan.
            </div>
        @else
            <!-- LIST VIEW -->
            <div class="view-list space-y-3 md:space-y-4">
                @foreach ($events as $event)
                    <x-events.event-card :event="$event" :index="$loop->iteration" variant="list" :status="$event['card_status'] ?? 'open'" />
                @endforeach
            </div>

            <div class="view-grid grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-4">
                @foreach ($events as $event)
                    <x-events.event-card :event="$event" :index="$loop->iteration" variant="grid" :status="$event['card_status'] ?? 'open'" />
                @endforeach
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex items-center justify-between text-[11px] md:text-xs text-slate-500">
        <p>Halaman 1 dari 1</p>
        <div class="inline-flex items-center gap-1">
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white hover:bg-slate-50 transition" disabled>
                ‹
            </button>
            <button class="px-3 py-1 rounded-full bg-slate-900 text-white font-semibold">
                1
            </button>
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white/70 text-slate-400" disabled>
                2
            </button>
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white/70 text-slate-400" disabled>
                3
            </button>
            <span class="px-1">...</span>
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white/70 text-slate-400" disabled>
                ›
            </button>
        </div>
    </div>
</section>
