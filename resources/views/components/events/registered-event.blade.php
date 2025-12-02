@props(['events'])

<section id="my-events-section" class="mt-8 md:mt-10">
    <div class="flex items-end justify-between mb-3 md:mb-4">
        <div>
            <h2 class="text-lg md:text-xl font-bold text-slate-900 dark:text-white">
                Event Terdaftar
            </h2>
            <p class="text-[11px] md:text-xs text-slate-500 dark:text-slate-400">
                Daftar event yang sudah kamu pilih. Datang tepat waktu ya!
            </p>
        </div>
        <x-button href=" {{ route('my_events') }}" variant="link-sm">Show All</x-button>
    </div>


    @if ($events->isEmpty())
    <div class="bg-white/90 dark:bg-slate-800/95 border border-dashed border-slate-200 dark:border-slate-700 rounded-3xl p-4 text-center text-xs text-slate-500 dark:text-slate-400">
        Kamu belum mendaftar event apapun. Yuk eksplor <span class="font-semibold text-sky-600">Semua Event</span> di atas!
    </div>
    @endif

    <div class="grid gap-3 lg:grid-cols-3">
        @foreach ($events as $i => $event)
        <x-events.event-card :event="$event" :index="$i+1" variant="list" status="registered"
            :show_detail="true" :show_badges="false" :show_subtitle="false" />
        @endforeach
    </div>
</section>
