@props(['event'])
<!-- HERO EVENT -->
<section class="mb-5 md:mb-8">
    <div class="relative overflow-hidden rounded-3xl bg-slate-900 shadow-lg">

        <!-- Background image + gradient -->
        <div class="absolute inset-0">
            <div class="w-full h-full bg-[url('{{ $event['image'] }}')] bg-cover bg-center opacity-80"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
        </div>

        <!-- Konten -->
        <div
            class="relative px-4 py-4 md:px-6 md:py-15 lg:px-8 lg:py-20 flex flex-col md:flex-row md:items-end md:justify-between gap-3 md:gap-4">

            <div class="space-y-2 md:space-y-3 max-w-2xl">
                <div class="hidden md:inline-flex flex-wrap items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-sky-100/90 text-[11px] md:text-xs text-sky-800 font-medium">
                        {{ $event['category_icon'] ?? '📅' }} {{ $event['category'] ?? 'Event' }}
                    </span>
                    <span
                        class="px-3 py-1 rounded-full bg-emerald-100/90 text-[11px] md:text-xs text-emerald-800 font-medium capitalize">
                        {{ $event['mode'] ?? 'hybrid' }}
                    </span>
                </div>

                <h1
                    class="text-lg leading-snug font-extrabold text-white
                           sm:text-xl md:text-3xl lg:text-4xl">
                    {{ $event['title'] ?? 'Event Kampus' }}
                </h1>

                <p class="text-[11px] sm:text-xs md:text-sm text-slate-100 max-w-xl line-clamp-3">
                    {{ $event['excerpt'] ?? 'Detail event kampus terbaru.' }}
                </p>
            </div>

            <!-- Date badge -->
            <div class="flex items-end justify-end">
                <div class="flex items-center gap-3">
                    <div class="hidden text-right md:flex flex-col items-end text-[11px] text-slate-200">
                        <p>{{ $event['date']?->translatedFormat('l, d F Y') }}</p>
                        <p>{{ $event['time'] ?? '-' }} WIB • {{ $event['location'] ?? '-' }}</p>
                    </div>
                    <div class="px-3 py-2 rounded-2xl bg-white/95 text-center min-w-[70px]">
                        <span
                            class="text-[10px] uppercase tracking-wide text-slate-500 block">{{ $event['date']?->translatedFormat('D') }}</span>
                        <span
                            class="text-lg md:text-xl font-bold leading-none block text-slate-900">{{ $event['date']?->format('d') }}</span>
                        <span
                            class="text-[10px] text-slate-500 block mt-0.5">{{ $event['date']?->translatedFormat('M') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info singkat di mobile -->
    <div class="mt-3 md:hidden text-[11px] text-slate-600 px-1">
        <p>{{ $event['date']?->translatedFormat('l, d F Y') }} • {{ $event['time'] ?? '-' }} WIB</p>
        <p>{{ $event['location'] ?? '-' }}</p>
    </div>
</section>
