@php
    // Data filter (bisa juga kamu kirim dari Controller)
    $categoryFilters = [
        ['value' => 'all', 'label' => 'Semua'],
        ['value' => 'seminar', 'label' => 'Seminar'],
        ['value' => 'workshop', 'label' => 'Workshop'],
        ['value' => 'kompetisi', 'label' => 'Kompetisi'],
        ['value' => 'pelatihan', 'label' => 'Pelatihan'],
        ['value' => 'komunitas', 'label' => 'Komunitas'],
    ];

    $dateFilters = [
        ['value' => 'upcoming', 'label' => 'Semua'],
        ['value' => 'today', 'label' => 'Hari ini'],
        ['value' => 'week', 'label' => 'Minggu ini'],
        ['value' => 'month', 'label' => 'Bulan ini'],
    ];

    $modeFilters = [
        ['value' => 'all', 'label' => 'Semua'],
        ['value' => 'onsite', 'label' => 'On-site'],
        ['value' => 'online', 'label' => 'Online'],
        ['value' => 'hybrid', 'label' => 'Hybrid'],
    ];

    $priceFilters = [
        ['value' => 'open', 'label' => 'Gratis'],
        ['value' => 'internal', 'label' => 'Berbayar'],
    ];

    $registrationStatus = [
        ['value' => 'upcoming', 'label' => 'Masih Dibuka'],
        ['value' => 'closed', 'label' => 'Ditutup'],
    ];
@endphp

<aside id="filters"
    class="space-y-3 md:sticky md:top-6 md:self-start md:max-h-[calc(100vh-120px)] md:overflow-y-auto md:pr-2 hidden md:block">

    <div class="bg-white/50 border border-slate-100 rounded-2xl p-4 shadow-sm space-y-4">
        <!-- Header with Reset All -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <p class="text-sm font-bold text-slate-800">Filter Event</p>
            <button class="text-xs text-sky-600 hover:text-sky-700 font-medium transition">
                Reset Semua
            </button>
        </div>

        {{-- ==================== KATEGORI ==================== --}}
        <div class="space-y-2.5">
            <p class="text-xs font-semibold text-slate-800">Kategori</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach ($categoryFilters as $item)
                    <button
                        class="px-3 py-1.5 rounded-full text-xs border font-medium transition
                        {{ $loop->first
                            ? 'bg-sky-100 text-sky-700 border-sky-200 hover:bg-sky-200'
                            : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}"
                        data-filter-category="{{ $item['value'] }}">
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="border-t border-slate-100"></div>

        {{-- ==================== TANGGAL ==================== --}}
        <div class="space-y-2.5">
            <p class="text-xs font-semibold text-slate-800">Tanggal</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach ($dateFilters as $item)
                    <button
                        class="px-3 py-1.5 rounded-full text-xs border font-medium transition
                        {{ $loop->first
                            ? 'bg-sky-100 text-sky-700 border-sky-200 hover:bg-sky-200'
                            : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}"
                        data-filter-date="{{ $item['value'] }}">
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="space-y-1.5 pt-1">
                <p class="text-[11px] text-slate-500 font-medium">Rentang tanggal:</p>
                <div class="grid grid-cols-2 gap-2">
                    <input type="date"
                        class="w-full rounded-lg border border-slate-200 px-2 py-1.5 text-[11px] text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:border-transparent" />
                    <input type="date"
                        class="w-full rounded-lg border border-slate-200 px-2 py-1.5 text-[11px] text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:border-transparent" />
                </div>
            </div>
        </div>

        <div class="border-t border-slate-100"></div>

        {{-- ==================== MODE EVENT & LOKASI ==================== --}}
        <div class="space-y-2.5">
            <p class="text-xs font-semibold text-slate-800">Mode Event</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach ($modeFilters as $item)
                    <button
                        class="px-3 py-1.5 rounded-full text-xs border font-medium transition
                        {{ $loop->first
                            ? 'bg-sky-100 text-sky-700 border-sky-200 hover:bg-sky-200'
                            : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}"
                        data-filter-mode="{{ $item['value'] }}">
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </div>

            <div class="space-y-1.5 pt-1">
                <p class="text-[11px] text-slate-500 font-medium">Lokasi:</p>
                <input type="text" placeholder="Contoh: Aula Utama, FTI..."
                    class="w-full rounded-lg border border-slate-200 px-2.5 py-1.5 text-xs text-slate-700 bg-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:border-transparent" />
            </div>
        </div>

        <div class="border-t border-slate-100"></div>

        {{-- ==================== FILTER LANJUTAN ==================== --}}
        <div class="space-y-2.5">
            <p class="text-xs font-semibold text-slate-800">Lainnya</p>

            {{-- Harga --}}
            <div class="space-y-1.5">
                <p class="text-[11px] text-slate-500 font-medium">Harga</p>
                <div class="flex flex-wrap gap-1.5">
                @foreach ($priceFilters as $item)
                    <button
                        class="px-3 py-1.5 rounded-full text-xs border font-medium transition
                        {{ $loop->first
                            ? 'bg-sky-100 text-sky-700 border-sky-200 hover:bg-sky-200'
                            : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}"
                        data-filter-mode="{{ $item['value'] }}">
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </div>
            </div>

            {{-- Status Pendaftaran --}}
            <div class="space-y-2.5">
                <p class="text-[11px] text-slate-500 font-medium">Status Pendaftaran</p>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($registrationStatus as $item)
                        <button
                            class="px-3 py-1.5 rounded-full text-xs border font-medium transition
                            {{ $loop->first
                                ? 'bg-sky-100 text-sky-700 border-sky-200 hover:bg-sky-200'
                                : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}"
                            data-filter-mode="{{ $item['value'] }}">
                            {{ $item['label'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</aside>
