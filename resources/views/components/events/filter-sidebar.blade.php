@props([
'filters' => [
'categories' => collect(),
'dateFilters' => collect(),
'modeFilters' => collect(),
'priceFilters' => collect(),
'registrationStatus' => collect(),
],
'selected' => [],
])

@php
$parseMulti = function ($raw, $default = []) {
$value = $raw ?? $default;

if (is_array($value)) {
return collect($value);
}

return collect(explode(',', (string) $value));
};

$current = [
'categories' => $parseMulti($selected['categories'] ?? request()->query('categories'))
->filter()
->unique()
->values()
->all(),
'date' => $selected['date'] ?? request('date'),
'mode' => $parseMulti($selected['mode'] ?? request()->query('mode'))
->filter()
->unique()
->values()
->all(),
'price' => $selected['price'] ?? request('price'),
'status' => $parseMulti($selected['status'] ?? request()->query('status', 'open'), ['open'])
->filter()
->unique()
->values()
->all(),
'date_from' => $selected['date_from'] ?? request('date_from'),
'date_to' => $selected['date_to'] ?? request('date_to'),
'location' => $selected['location'] ?? request('location'),
];
@endphp

<aside id="filters" class="space-y-3 md:sticky md:top-30 md:self-start md:pr-2 hidden md:block">

    <div class="bg-white/50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 rounded-2xl p-4 shadow-sm space-y-4">
        <!-- Header with Reset All -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-700">
            <p class="text-sm font-bold text-slate-800 dark:text-white">Filter Event</p>
            <a href="{{ route('events') }}" class="text-xs text-sky-600 hover:text-sky-700 dark:text-sky-400 dark:hover:text-sky-300 font-medium transition">
                Reset Semua
            </a>
        </div>

        {{-- ==================== KATEGORI ==================== --}}
        <div class="space-y-2.5">
            <p class="text-xs font-semibold text-slate-800 dark:text-white">
                Kategori
                @if (!empty($current['categories']))
                <button class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 font-semibold cursor-pointer"
                    data-clear="categories">
                    Clear
                </button>
                @endif
            </p>
            <div class="flex items-center gap-2 flex-wrap">
                @forelse (collect($filters['categories'] ?? []) as $item)
                <button
                    class="px-3 py-1.5 rounded-full text-xs border font-medium transition cursor-pointer flex items-center gap-1
                        {{ in_array($item['value'], $current['categories'] ?? [])
                            ? 'bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-700 hover:bg-sky-200 dark:hover:bg-sky-900'
                            : 'bg-slate-50 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600' }}"
                    data-filter-category="{{ $item['value'] }}">
                    @if (in_array($item['value'], $current['categories'] ?? []))
                    <span class="text-[10px]">×</span>
                    @endif
                    <span>{{ $item['label'] }}</span>
                </button>
                @empty
                <span class="text-[11px] text-slate-400 dark:text-slate-500">Kategori belum tersedia.</span>
                @endforelse
            </div>
        </div>

        <div class="border-t border-slate-100 dark:border-slate-700"></div>

        {{-- ==================== TANGGAL ==================== --}}
        <div class="space-y-2.5">
            <div class="flex items-center gap-2">
                <p class="text-xs font-semibold text-slate-800 dark:text-white">Tanggal</p>
                @if (!empty($current['date']) || $current['date_from'] || $current['date_to'])
                <button class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 font-semibold cursor-pointer"
                    data-clear="date">
                    Clear
                </button>
                @endif
            </div>
            <div class="flex flex-wrap gap-1.5 items-center">
                @foreach (collect($filters['dateFilters'] ?? []) as $item)
                <button
                    class="px-3 py-1.5 rounded-full text-xs border font-medium transition cursor-pointer flex items-center gap-1
                        {{ ($current['date'] ?? null) === $item['value']
                            ? 'bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-700 hover:bg-sky-200 dark:hover:bg-sky-900'
                            : 'bg-slate-50 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600' }}"
                    data-filter-date="{{ $item['value'] }}">
                    @if (($current['date'] ?? null) === $item['value'])
                    <span class="text-[10px]">×</span>
                    @endif
                    <span>{{ $item['label'] }}</span>
                </button>
                @endforeach
            </div>

            <div class="space-y-1.5 pt-1">
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Rentang tanggal:</p>
                <form method="GET" class="grid grid-cols-2 gap-2">
                    @foreach (request()->except(['date_from', 'date_to']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="date" name="date_from" value="{{ $current['date_from'] }}"
                        class="w-full rounded-lg border border-slate-200 dark:border-slate-600 px-2 py-1.5 text-[11px] text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:border-transparent" />
                    <input type="date" name="date_to" value="{{ $current['date_to'] }}"
                        class="w-full rounded-lg border border-slate-200 dark:border-slate-600 px-2 py-1.5 text-[11px] text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:border-transparent" />
                    <button type="submit"
                        class="col-span-2 mt-1 px-3 py-1.5 rounded-full bg-slate-900 dark:bg-sky-600 text-white text-[11px] font-semibold hover:bg-slate-800 dark:hover:bg-sky-700 transition cursor-pointer">
                        Terapkan Rentang
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-slate-100 dark:border-slate-700"></div>

        {{-- ==================== MODE EVENT & LOKASI ==================== --}}
        <div class="space-y-2.5">
            <div class="flex items-center gap-2">
                <p class="text-xs font-semibold text-slate-800 dark:text-white">Mode Event</p>
                @if (!empty($current['mode']))
                <button class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 font-semibold cursor-pointer"
                    data-clear="mode">
                    Clear
                </button>
                @endif
            </div>
            <div class="flex flex-wrap gap-1.5">
                @foreach (collect($filters['modeFilters'] ?? []) as $item)
                <button
                    class="px-3 py-1.5 rounded-full text-xs border font-medium transition cursor-pointer flex items-center gap-1
                        {{ in_array($item['value'], $current['mode'] ?? [])
                            ? 'bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-700 hover:bg-sky-200 dark:hover:bg-sky-900'
                            : 'bg-slate-50 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600' }}"
                    data-filter-mode="{{ $item['value'] }}">
                    @if (in_array($item['value'], $current['mode'] ?? []))
                    <span class="text-[10px]">×</span>
                    @endif
                    <span>{{ $item['label'] }}</span>
                </button>
                @endforeach
            </div>

            <div class="space-y-1.5 pt-1">
                <div class="flex items-center gap-2">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Lokasi:</p>
                    @if (!empty($current['location']))
                    <button class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 font-semibold cursor-pointer"
                        data-clear="location">
                        Clear
                    </button>
                    @endif
                </div>
                <form method="GET" class="flex items-center gap-2">
                    @foreach (request()->except(['location']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="text" name="location" value="{{ $current['location'] }}"
                        placeholder="Contoh: Aula Utama, FTI..."
                        class="w-full rounded-lg border border-slate-200 dark:border-slate-600 px-2.5 py-1.5 text-xs text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-700 placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:border-transparent" />
                    <button type="submit"
                        class="px-3 py-1.5 rounded-full bg-slate-900 dark:bg-sky-600 text-white text-[11px] font-semibold hover:bg-slate-800 dark:hover:bg-sky-700 transition cursor-pointer">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-slate-100 dark:border-slate-700"></div>

        {{-- ==================== FILTER LANJUTAN ==================== --}}
        <div class="space-y-2.5">
            <p class="text-xs font-semibold text-slate-800 dark:text-white">Lainnya</p>

            {{-- Harga --}}
            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Harga</p>
                    @if (!empty($current['price']))
                    <button class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 font-semibold cursor-pointer"
                        data-clear="price">
                        Clear
                    </button>
                    @endif
                </div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach (collect($filters['priceFilters'] ?? []) as $item)
                    <button
                        class="px-3 py-1.5 rounded-full text-xs border font-medium transition cursor-pointer flex items-center gap-1
                        {{ ($current['price'] ?? null) === $item['value']
                            ? 'bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-700 hover:bg-sky-200 dark:hover:bg-sky-900'
                            : 'bg-slate-50 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600' }}"
                        data-filter-price="{{ $item['value'] }}">
                        @if (($current['price'] ?? null) === $item['value'])
                        <span class="text-[10px]">×</span>
                        @endif
                        <span>{{ $item['label'] }}</span>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Status Pendaftaran --}}
            <div class="space-y-2.5">
                <div class="flex items-center gap-2">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Status Pendaftaran</p>
                    @if (!empty($current['status']))
                    <button class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 font-semibold cursor-pointer"
                        data-clear="status">
                        Clear
                    </button>
                    @endif
                </div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach (collect($filters['registrationStatus'] ?? []) as $item)
                    <button
                        class="px-3 py-1.5 rounded-full text-xs border font-medium transition
                            cursor-pointer flex items-center gap-1
                            {{ in_array($item['value'], $current['status'] ?? [])
                                ? 'bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-700 hover:bg-sky-200 dark:hover:bg-sky-900'
                                : 'bg-slate-50 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600' }}"
                        data-filter-status="{{ $item['value'] }}">
                        @if (in_array($item['value'], $current['status'] ?? []) && $item['value'] !== 'open')
                        <span class="text-[10px]">×</span>
                        @endif
                        <span>{{ $item['label'] }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);

            const parseCategories = () => {
                const raw = params.get('categories');
                if (!raw) return [];
                return raw.split(',').filter(Boolean);
            };

            const updateAndGo = () => {
                const query = params.toString();
                const dest = query ? `${location.pathname}?${query}` : location.pathname;
                window.location = dest;
            };

            const toggleSingle = (key, value) => {
                const current = params.get(key);
                if (current === value) {
                    params.delete(key);
                } else {
                    params.set(key, value);
                }
                updateAndGo();
            };

            const toggleMulti = (key, value) => {
                const raw = params.get(key);
                let items = raw ? raw.split(',').filter(Boolean) : [];
                if (items.includes(value)) {
                    items = items.filter((i) => i !== value);
                } else {
                    items.push(value);
                }
                if (items.length) {
                    params.set(key, items.join(','));
                } else {
                    params.delete(key);
                }
                updateAndGo();
            };

            document.querySelectorAll('[data-filter-category]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const slug = btn.getAttribute('data-filter-category');
                    const categories = parseCategories();
                    const idx = categories.indexOf(slug);
                    if (idx >= 0) {
                        categories.splice(idx, 1);
                    } else {
                        categories.push(slug);
                    }

                    if (categories.length) {
                        params.set('categories', categories.join(','));
                    } else {
                        params.delete('categories');
                    }
                    updateAndGo();
                });
            });

            document.querySelectorAll('[data-clear]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const key = btn.getAttribute('data-clear');
                    if (key === 'categories') {
                        params.delete('categories');
                    } else if (key === 'date') {
                        params.delete('date');
                        params.delete('date_from');
                        params.delete('date_to');
                    } else {
                        params.delete(key);
                    }
                    updateAndGo();
                });
            });

            document.querySelectorAll('[data-filter-date]').forEach((btn) => {
                btn.addEventListener('click', () => toggleSingle('date', btn.getAttribute(
                    'data-filter-date')));
            });

            document.querySelectorAll('[data-filter-mode]').forEach((btn) => {
                btn.addEventListener('click', () => toggleMulti('mode', btn.getAttribute(
                    'data-filter-mode')));
            });

            document.querySelectorAll('[data-filter-price]').forEach((btn) => {
                btn.addEventListener('click', () => toggleSingle('price', btn.getAttribute(
                    'data-filter-price')));
            });

            document.querySelectorAll('[data-filter-status]').forEach((btn) => {
                btn.addEventListener('click', () => toggleMulti('status', btn.getAttribute(
                    'data-filter-status')));
            });
        });
    </script>
    @endpush
</aside>