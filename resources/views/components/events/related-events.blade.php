@props(['relatedEvents' => collect()])

<section class="mt-8 md:mt-10">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm md:text-base font-semibold text-slate-900 dark:text-white">
            Event lain yang mungkin kamu suka
        </h2>
        <a href="{{ route('events') }}" class="text-[11px] md:text-xs font-semibold text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300">
            Lihat semua event
        </a>
    </div>
    @php $relatedEvents = collect($relatedEvents); @endphp
    @if ($relatedEvents->isEmpty())
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-4 text-[11px] text-slate-500 dark:text-slate-400">
        Belum ada rekomendasi event lain.
    </div>
    @else
    <div class="grid gap-3 md:grid-cols-3">
        @foreach ($relatedEvents as $item)
        <article class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-3 space-y-1.5">
            <p class="text-[11px] text-slate-500 dark:text-slate-400 capitalize">
                {{ $item['category'] ?? 'Event' }} • {{ $item['mode'] ?? '-' }}
            </p>
            <h3 class="text-xs md:text-sm font-semibold text-slate-900 dark:text-white">
                <a href="{{ route('event_detail', ['slug' => $item['slug']]) }}" class="hover:text-sky-700 dark:hover:text-sky-400">
                    {{ $item['title'] }}
                </a>
            </h3>
            <p class="text-[11px] text-slate-500 dark:text-slate-400">
                {{ $item['date']?->translatedFormat('l, d M') }} • {{ $item['location'] ?? '-' }}
            </p>
        </article>
        @endforeach
    </div>
    @endif
</section>