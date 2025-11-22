@props([
    'event',
    'variant' => 'list', // 'list', 'grid'
    'index' => 0,
    'show_detail' => false,
    'status' => 'open', // 'open', 'registered', 'finished'
    'show_badges' => true,
    'show_actions' => true,
    'show_subtitle' => true,
    'show_schedule' => true,
])

@php
    $cardStatus = $status ?? 'open';
    $categorySlug = $event['category_slug'] ?? 'umum';
    $detailParam = $event['slug'] ?? ($event['id'] ?? $index);
    $style = match (strtolower($event['quota_info'])) {
        'kuota penuh' => 'subtle-danger',
        'kuota hampir penuh' => 'subtle-warning',
        default => 'subtle-success',
    };
    $categoriesCollection = collect($event['categories_collection'] ?? []);
    $extraCategories = $categoriesCollection->skip(1);
    $extraCount = $extraCategories->count();
    $extraNames = $extraCategories->take(3)->pluck('name');
    $extraLabel = $extraNames->implode(', ');
@endphp

<article @class([
    'bg-white/95 h-full border border-slate-100 shadow-sm hover:shadow-md transition group',

    'rounded-2xl p-4' => $variant === 'list',
    'rounded-3xl overflow-hidden' => $variant !== 'list',

    'opacity-80' => $cardStatus === 'finished',
]) data-category="{{ $categorySlug }}" data-mode="{{ $event['mode'] }}"
    data-date="{{ $event['date']->format('Y-m-d') }}" data-index="{{ $index }}"
    data-title="{{ strtolower($event['title']) }}" data-registered="{{ $event['registered'] ?? 0 }}">

    {{-- VARIANT LIST --}}
    @if ($variant === 'list')
        <div class="flex gap-4">
            <!-- Date -->

            @if ($event['image'])
                <div class="relative hidden md:flex w-25 h-25 rounded-2xl overflow-hidden bg-slate-200 flex-shrink-0">
                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" @class([
                        'w-full h-full object-cover',
                        'grayscale' => $cardStatus === 'finished',
                    ]) />
                    <div
                        class="absolute top-1 left-1 px-1.5 py-1 rounded-2xl bg-slate-900/90 text-white text-center min-w-[44px]">
                        <span
                            class="text-[9px] uppercase tracking-wide text-slate-200 block">{{ $event['date']->translatedFormat('D') }}</span>
                        <span class="text-xs font-bold leading-none block">{{ $event['date']->format('d') }}</span>
                        <span
                            class="text-[9px] text-slate-300 block mt-0.5">{{ $event['date']->translatedFormat('M') }}</span>
                    </div>
                </div>
            @else
                <div
                    class="hidden md:flex flex-col items-center justify-center px-9 py-2 bg-slate-900 text-white rounded-xl min-w-[68px]">
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
            @endif

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start mb-1">
                    <h2 class="text-xs md:text-sm font-semibold text-slate-900 group-hover:text-sky-700 line-clamp-2">
                        <a href="{{ route('event_detail', ['slug' => $detailParam]) }}">{{ $event['title'] }}</a>
                    </h2>
                    @if ($cardStatus === 'open')
                        <div class="flex items-center gap-1 relative group/extra">
                            <x-badge variant="subtle-info" size="xs">
                                {{ $event['category_icon'] }} {{ ucfirst($event['category']) }}
                            </x-badge>
                            @if ($extraCount > 0)
                                <span
                                    class="text-[10px] text-slate-500 leading-none bg-slate-100 px-1.5 py-0.5 rounded-full cursor-default js-extra-cats"
                                    data-extra="{{ $extraLabel }}">
                                    +{{ $extraCount }}
                                </span>
                                <div
                                    class="hidden group-hover/extra:flex absolute top-full left-0 mt-1 bg-white text-slate-800 text-[10px] rounded-xl px-2.5 py-2 shadow-lg shadow-slate-200 border border-slate-100 pointer-events-none js-extra-tooltip">

                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($extraNames as $name)
                                            <span
                                                class="px-1.5 py-0.5 rounded-full bg-slate-100 border border-slate-200 text-[10px]">{{ $name }}</span>
                                        @endforeach
                                        @if ($extraCount > $extraNames->count())
                                            <span
                                                class="px-1.5 py-0.5 rounded-full bg-slate-100 border border-slate-200 text-[10px]">dll.</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                @if ($show_subtitle)
                    <p class="text-[11px] text-slate-500">
                        {{ $event['organizer'] }}
                        @if ($event['location'] && $event['organizer'])
                            •
                        @endif
                        {{ $event['location'] }}
                    </p>
                @endif

                @if ($show_schedule)
                    <p class="mt-1 text-[11px] text-slate-500">
                        {{ $event['time'] }} WIB
                        @if ($event['benefit'] && $event['time'])
                            •
                        @endif
                        {{ $event['benefit'] }}
                    </p>
                @endif

                <!-- Badges -->
                @if ($show_badges)
                    <div class="mt-2 flex gap-2 flex-wrap">
                        <x-badge variant="outline-dark" size="xxs">
                            👥 {{ $event['registered'] ?? 0 }} terdaftar
                        </x-badge>

                        <x-badge size="xxs" variant="{{ $style }}">
                            {{ $event['quota_info'] }}
                        </x-badge>

                        @php $isFree = ($event['price'] ?? 0) == 0; @endphp
                        <x-badge size="xxs" variant="{{ $isFree ? 'subtle-success' : 'subtle-info' }}">
                            {{ $isFree ? 'Gratis' : 'Rp ' . number_format($event['price'], 0, ',', '.') }}
                        </x-badge>
                    </div>
                @endif
            </div>

            <!-- CTA Desktop -->
            @if ($show_actions)
                <div @class([
                    'hidden md:flex' => $cardStatus === 'open',
                    'flex' => $cardStatus === 'registered' || $cardStatus === 'finished',
                    'flex-col items-end justify-between',
                ])>
                    @if ($cardStatus === 'registered')
                        <x-badge size="xxs" variant="subtle-success">Sudah Terdaftar</x-badge>
                    @elseif ($cardStatus === 'finished')
                        <x-badge variant="subtle-gray" size="xxs"> Selesai</x-badge>
                    @elseif ($cardStatus === 'open')
                        <x-button href="{{ route('event_detail', ['slug' => $detailParam]) }}" variant="primary-sm">
                            Daftar
                        </x-button>
                    @endif


                    @if ($show_detail)
                        <a href="{{ route('event_detail', ['slug' => $detailParam]) }}"
                            class="text-[11px] items-end text-sky-600 font-medium">
                            Lihat detail →
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- CTA Mobile -->
        @if ($cardStatus === 'open' && $show_actions)
            <div class="mt-3 flex md:hidden justify-between pt-3 border-t border-slate-100">
                <x-button href="{{ route('event_detail', ['slug' => $detailParam]) }}" variant="primary-sm">
                    Lihat detail
                </x-button>
            </div>
        @endif
    @else
        {{-- VARIANT GRID --}}
        <div class="relative h-32">
            @if ($event['image'])
                <img src="{{ $event['image'] }}"
                    class="w-full h-full object-cover group-hover:scale-[1.03] transition" />

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
            @else
                <div
                    class="flex flex-col items-center justify-center bg-slate-900 text-white rounded-xl min-h-full min-w-full">
                    <span class="text-[20px] uppercase text-slate-300">
                        {{ $event['date']->translatedFormat('D') }}
                    </span>
                    <span class="text-[30px] font-bold">
                        {{ $event['date']->format('d') }}
                    </span>
                    <span class="text-[20px] text-slate-300">
                        {{ $event['date']->translatedFormat('M') }}
                    </span>
                </div>
            @endif
            <div class="absolute inset-x-2 bottom-2 flex justify-end flex-wrap gap-1">
                <div class="flex items-center gap-1 relative group/extra">
                    <x-badge variant="subtle-info" size="xs">
                        {{ $event['category_icon'] }} {{ ucfirst($event['category']) }}
                    </x-badge>
                    @if ($extraCount > 0)
                        <span
                            class="text-[10px] text-slate-200 bg-slate-900/70 rounded-full px-1.5 py-0.5 leading-none cursor-default js-extra-cats"
                            data-extra="{{ $extraLabel }}">
                            +{{ $extraCount }}
                        </span>
                        <div
                            class="hidden group-hover/extra:flex absolute bottom-full right-0 mb-1 bg-white text-slate-800 text-[10px] rounded-xl px-2.5 py-2 shadow-lg shadow-slate-200 border border-slate-100 pointer-events-none js-extra-tooltip">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($extraNames as $name)
                                    <span
                                        class="px-1.5 py-0.5 rounded-full bg-slate-100 border border-slate-200 text-[10px]">{{ $name }}</span>
                                @endforeach
                                @if ($extraCount > $extraNames->count())
                                    <span
                                        class="px-1.5 py-0.5 rounded-full bg-slate-100 border border-slate-200 text-[10px]">dll.</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-3.5 space-y-1.5">
            <h2 class="text-sm font-semibold text-slate-900 group-hover:text-sky-700 line-clamp-2">
                <a href="{{ route('event_detail', ['slug' => $detailParam]) }}">{{ $event['title'] }}</a>
            </h2>

            @if ($show_subtitle)
                <p class="text-[11px] text-slate-500">
                    {{ $event['organizer'] }} • {{ $event['location'] }}
                </p>
            @endif

            @if ($show_schedule)
                <p class="text-[11px] text-slate-500">
                    {{ $event['time'] }} WIB • {{ $event['benefit'] }}
                </p>
            @endif

            <div class="flex justify-between items-center mt-2">
                <div class="flex gap-1 items-center">
                    @if ($show_badges)
                        <x-badge variant="outline-dark" size="xxs">
                            👥 {{ $event['registered'] ?? 0 }} peserta
                        </x-badge>
                        @php $isFree = ($event['price'] ?? 0) == 0; @endphp
                        <x-badge size="xxs" variant="{{ $isFree ? 'subtle-success' : 'subtle-info' }}">
                            {{ $isFree ? 'Gratis' : 'Rp ' . number_format($event['price'], 0, ',', '.') }}
                        </x-badge>
                    @endif
                </div>

                @if ($show_actions)
                    <x-button href="{{ route('event_detail', ['slug' => $detailParam]) }}" variant="primary-sm">
                        Daftar
                    </x-button>
                @endif
            </div>
        </div>
    @endif
</article>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.js-extra-cats').forEach((el) => {
                    const tooltip = el.closest('.group\\/extra')?.querySelector('.js-extra-tooltip');
                    if (!tooltip) return;

                    const show = () => tooltip.classList.remove('hidden');
                    const hide = () => tooltip.classList.add('hidden');

                    el.addEventListener('mouseenter', show);
                    el.addEventListener('mouseleave', hide);
                    el.addEventListener('focus', show);
                    el.addEventListener('blur', hide);
                    el.addEventListener('click', (e) => {
                        e.preventDefault();
                        tooltip.classList.toggle('hidden');
                    });
                });
            });
        </script>
    @endpush
@endonce
