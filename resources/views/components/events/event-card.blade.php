@props(['event', 'variant' => 'list', 'index' => 0])

@php
    $style = match (strtolower($event['quota_info'])) {
        'kuota penuh'        => 'subtle-danger',
        'kuota hampir penuh' => 'subtle-warning',
        default              => 'subtle-success',
    };
@endphp

<article
    class="{{ $variant === 'list'
                ? 'bg-white/95 border border-slate-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition group'
                : 'bg-white/95 border border-slate-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition group' }}"
    data-category="{{ $event['category'] }}"
    data-mode="{{ $event['mode'] }}"
    data-date="{{ $event['date']->format('Y-m-d') }}"
    data-index="{{ $index }}"
    data-title="{{ strtolower($event['title']) }}"
    data-registered="{{ $event['registered'] }}"
>

    {{-- VARIANT LIST --}}
    @if ($variant === 'list')
        <div class="flex gap-4">
            <!-- Date -->
            <div class="flex flex-col items-center justify-center px-3 py-2 bg-slate-900 text-white rounded-xl min-w-[68px]">
                <span class="text-[11px] uppercase text-slate-300">
                    {{ $event['date']->translatedFormat('D') }}
                </span>
                <span class="text-xl font-bold">
                    {{ $event['date']->format('d') }}
                </span>
                <span class="text-[11px] text-slate-300">
                    {{ $event['date']->translatedFormat('M') }}
                </span>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start mb-1">
                    <h2 class="text-sm md:text-base font-semibold text-slate-900 group-hover:text-sky-700 line-clamp-2">
                        {{ $event['title'] }}
                    </h2>

                    <x-badge variant="subtle-info" size="xs">
                        {{ $event['category_icon'] }} {{ ucfirst($event['category']) }}
                    </x-badge>
                </div>

                <p class="text-[11px] text-slate-500">
                    {{ $event['organizer'] }} • {{ $event['location'] }}
                </p>

                <p class="mt-1 text-[11px] text-slate-500">
                    {{ $event['time'] }} WIB • {{ $event['benefit'] }}
                </p>

                <!-- Badges -->
                <div class="mt-2 flex gap-2 flex-wrap">
                    <x-badge variant="outline-dark" size="xxs">
                        👥 {{ $event['registered'] }} terdaftar
                    </x-badge>

                    <x-badge size="xxs" variant="{{ $style }}">
                        {{ $event['quota_info'] }}
                </x-badge>
                </div>
            </div>

            <!-- CTA Desktop -->
            <div class="hidden md:flex flex-col items-end justify-between">
                <x-button variant="primary-sm">
                    Daftar
                </x-button>
            </div>
        </div>

        <!-- CTA Mobile -->
        <div class="mt-3 flex md:hidden justify-between pt-3 border-t border-slate-100">
            <x-button variant="primary-sm">
                Lihat detail
            </x-button>
        </div>
    @else
    {{-- VARIANT GRID --}}
        <div class="relative h-32">
            <img src="{{ $event['image'] }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition" />

            <div class="absolute top-2 left-2 px-2 py-1.5 bg-slate-900/90 text-white rounded-2xl text-center">
                <span class="text-[10px] uppercase text-slate-200 block">
                    {{ $event['date']->translatedFormat('D') }}
                </span>
                <span class="text-base font-bold block">
                    {{ $event['date']->format('d') }}
                </span>
                <span class="text-[10px] text-slate-300 block mt-0.5">
                    {{ $event['date']->translatedFormat('M') }}
                </span>
            </div>

            <x-badge variant="subtle-info" size="xs" class="absolute bottom-2 right-2">
                {{ $event['category_icon'] }} {{ ucfirst($event['category']) }}
            </x-badge>
        </div>

        <div class="p-3.5 space-y-1.5">
            <h2 class="text-sm font-semibold text-slate-900 group-hover:text-sky-700 line-clamp-2">
                {{ $event['title'] }}
            </h2>

            <p class="text-[11px] text-slate-500">
                {{ $event['organizer'] }} • {{ $event['location'] }}
            </p>

            <p class="text-[11px] text-slate-500">
                {{ $event['time'] }} WIB • {{ $event['benefit'] }}
            </p>

            <div class="flex justify-between items-center mt-2">
                <x-badge variant="outline-dark" size="xxs">
                    👥 {{ $event['registered'] }} peserta
                </x-badge>

                <x-button variant="primary-sm">
                    Daftar
                </x-button>
            </div>
        </div>
    @endif
</article>
