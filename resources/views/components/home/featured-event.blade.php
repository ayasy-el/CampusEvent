@props(['event' => null])

@if ($event)
    <section class="mb-10 md:mb-14">
        <div class="flex items-center justify-between gap-2 mb-4">
            <h2 class="text-lg md:text-2xl font-semibold text-slate-900">
                Featured Event This Week
            </h2>
            <x-badge variant="minimalist" size="sm">
                🔔 Jangan lewatkan
            </x-badge>
        </div>

        <article
            class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-sky-600 via-indigo-500 to-purple-500 text-white shadow-xl md:grid md:grid-cols-[2fr,3fr] md:items-stretch">
            <div class="relative p-4 pt-10 md:p-6 lg:p-7 flex flex-col justify-between">
                <div
                    class="absolute top-3 right-3 bg-white/90 text-[10px] md:text-xs font-semibold text-sky-700 px-3 py-1 rounded-full shadow">
                    {{ $event['category_icon'] ?? '🎯' }} {{ ucfirst($event['category'] ?? 'Event') }}
                </div>

                <div class="space-y-3 md:space-y-4">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold leading-snug">
                        {{ $event['title'] }}
                    </h3>

                    <p class="text-xs md:text-sm text-slate-100 max-w-xl">
                        <span class="font-semibold">{{ $event['organizer'] }}</span>
                        @if (!empty($event['location']))
                            • {{ $event['location'] }}
                        @endif
                    </p>

                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex items-center gap-2 text-[11px] text-slate-100/80">
                        <x-dot />
                        <span>{{ $event['quota_info'] ?? 'Kuota tersedia' }}</span>
                    </div>

                    <div class="flex gap-2">
                        <x-button href="{{ route('event_detail', ['slug' => $event['slug']]) }}" variant="white-action">
                            <span>📌 Lihat Detail</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endif
