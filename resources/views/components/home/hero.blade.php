@props(['count' => 0])

<section class="mt-4 mb-10 md:mb-14">
    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-10 lg:gap-14">

        <!-- Text -->
        <div class="order-2 md:order-1 mt-6 md:mt-0">
            <h1 class="mt-4 text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight">
                Portal Event Kampus
            </h1>
            <p class="mt-3 text-sm sm:text-base md:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-xl">
                Temukan seminar, workshop, dan kegiatan kampus yang cocok dengan minatmu.
                Bangun relasi dan pengalaman baru bersama teman-teman.
            </p>

            <div class="mt-5 flex flex-wrap items-center gap-3">
                <x-button href="{{ route('events') }}">Jelajahi Event</x-button>
            </div>

            <div class="mt-5 flex flex-wrap gap-3 text-[11px] md:text-xs text-slate-500 dark:text-slate-400">
                <x-badge variant="default" size="sm">
                    <x-dot /> &nbsp; {{ $count }} event aktif
                </x-badge>
            </div>
        </div>

        <!-- Hero Carousel -->
        <div
            x-data="{
                images: [
                    'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=1170&q=80',
                    'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1170&q=80',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1170&q=80',
                ],
                active: 0,
                start() {
                    setInterval(() => {
                        this.active = (this.active + 1) % this.images.length
                    }, 3500)
                }
            }"
            x-init="start()"
            class="order-1 md:order-2 relative rounded-3xl shadow-lg shadow-slate-200/60 dark:shadow-slate-900/60 aspect-video overflow-hidden">

            <template x-for="(image, i) in images" :key="i">
                <img
                    x-cloak
                    :src="image"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1200ms] ease-out"
                    x-show="active === i"
                    x-transition:enter="opacity-0 scale-105"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    :alt="'Event image ' + (i + 1)" />
            </template>

        </div>

    </div>
</section>