@props([
    'events' => collect(),
    'eventsCount' => null,
])

@php
    $isPaginator = $events instanceof \Illuminate\Pagination\LengthAwarePaginator;
    $eventsCollection = $isPaginator ? collect($events->items()) : collect($events);
    $eventsCount = $eventsCount ?? ($isPaginator ? $events->total() : $eventsCollection->count());
    $showingFrom = $eventsCollection->isEmpty() ? 0 : ($isPaginator ? $events->firstItem() ?? 0 : 1);
    $showingTo = $isPaginator ? $events->lastItem() ?? 0 : $eventsCollection->count();
@endphp

<section class="space-y-3 md:space-y-4">
    <!-- Info summary -->
    @if ($eventsCollection->isNotEmpty())
        <div class="flex items-center justify-between text-[11px] md:text-xs text-slate-500 dark:text-slate-400">
            <p>
                Menampilkan
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $showingFrom }}–{{ $showingTo }}</span>
                dari
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $eventsCount }}</span>
                event
            </p>
        </div>
    @endif

    <div id="eventsWrapper" class="space-y-3 md:space-y-4">
        @if ($eventsCollection->isEmpty())
            <div
                class="bg-white/60 dark:bg-slate-800/60 border border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-6 text-center text-slate-500 dark:text-slate-400 text-sm">
                Belum ada event yang siap ditampilkan.
            </div>
        @else
            <!-- LIST VIEW -->
            <div class="view-list space-y-3 md:space-y-4">
                @foreach ($eventsCollection as $event)
                    <x-events.event-card :event="$event" :index="$loop->iteration" variant="list" :status="$event['card_status'] ?? 'open'" />
                @endforeach
            </div>

            <div class="view-grid grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-4">
                @foreach ($eventsCollection as $event)
                    <x-events.event-card :event="$event" :index="$loop->iteration" variant="grid" :status="$event['card_status'] ?? 'open'" />
                @endforeach
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if ($isPaginator)
        @php
            $currentPage = $events->currentPage();
            $lastPage = $events->lastPage();
        @endphp
        <div class="mt-4 flex items-center justify-between text-[11px] md:text-xs text-slate-500 dark:text-slate-400">
            <p>Halaman {{ $currentPage }} dari {{ $lastPage }}</p>
            <div class="inline-flex items-center gap-1">
                <a href="{{ $events->previousPageUrl() ?? '#' }}" @class([
                    'px-3 py-1 rounded-full border border-slate-200 dark:border-slate-600 transition',
                    'bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200' => $events->previousPageUrl(),
                    'bg-white/70 dark:bg-slate-700/70 text-slate-400 dark:text-slate-500 cursor-not-allowed' => !$events->previousPageUrl(),
                ])>
                    ‹
                </a>

                @foreach (range(max(1, $currentPage - 1), min($lastPage, $currentPage + 1)) as $page)
                    <a href="{{ $events->url($page) }}" @class([
                        'px-3 py-1 rounded-full',
                        'bg-slate-900 dark:bg-sky-600 text-white font-semibold' => $page === $currentPage,
                        'border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600' =>
                            $page !== $currentPage,
                    ])>
                        {{ $page }}
                    </a>
                @endforeach

                @if ($currentPage + 1 <= $lastPage)
                    <span class="px-1">...</span>
                @endif

                @if ($lastPage > 1 && $currentPage !== $lastPage)
                    <a href="{{ $events->url($lastPage) }}"
                        class="px-3 py-1 rounded-full border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600">
                        {{ $lastPage }}
                    </a>
                @endif

                <a href="{{ $events->nextPageUrl() ?? '#' }}" @class([
                    'px-3 py-1 rounded-full border border-slate-200 dark:border-slate-600 transition',
                    'bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200' => $events->nextPageUrl(),
                    'bg-white/70 dark:bg-slate-700/70 text-slate-400 dark:text-slate-500 cursor-not-allowed' => !$events->nextPageUrl(),
                ])>
                    ›
                </a>
            </div>
        </div>
    @endif
</section>
