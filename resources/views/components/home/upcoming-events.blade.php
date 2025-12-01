@props(['events' => collect()])

<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900 dark:text-white">
            Event Mendatang
        </h2>
        <x-button variant="link-sm" href="{{ route('events') }}">
            Lihat semua
        </x-button>
    </div>

    <div class="-mx-4 px-4 md:mx-0 md:px-0">
        <div
            class="flex items-stretch md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 overflow-x-auto md:overflow-visible pb-2 md:pb-0 snap-x snap-mandatory md:snap-none">
            @forelse ($events as $event)
            <div
                class="min-w-[240px] max-w-[260px] flex-shrink-0 snap-start md:min-w-0 md:max-w-none md:flex-shrink md:snap-none">
                <x-events.event-card :event="$event" variant="grid" :index="$loop->index" :show_badges="false"
                    :show_actions="false" :show_schedule="false" />
            </div>
            @empty
            <article
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-md shadow-slate-200/60 dark:shadow-slate-900/60 border border-dashed border-slate-200 dark:border-slate-700 p-5 min-w-[240px] max-w-[260px] flex-shrink-0 snap-start md:min-w-0 md:max-w-none md:flex-shrink md:snap-none">
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-2">Belum ada event terjadwal.</p>
                <x-button href="{{ route('events') }}" variant="dark-sm">Lihat semua event</x-button>
            </article>
            @endforelse

            {{-- <article
                class="hidden lg:block bg-white rounded-2xl shadow-md shadow-slate-200/60 border border-dashed border-slate-200">
                <div class="h-full flex flex-col items-center justify-center px-4 py-5 text-center">
                    <p class="text-xs text-slate-500 mb-2">
                        Ingin mengadakan event?
                    </p>
                    <x-button href="{{ route('events') }}" variant="dark-sm">
            Daftarkan Eventmu
            </x-button>
        </div>
        </article> --}}
    </div>
    </div>
</section>