@props(['categories' => collect()])

@php
    $wrappers = [
        'bg-pastelGreen/80 border border-green-100',
        'bg-pastelYellow/80 border border-yellow-100',
        'bg-pastelPink/80 border border-pink-100',
        'bg-indigo-50 border border-indigo-100',
        'bg-rose-50 border border-rose-100',
        'bg-pastelBlue/80 border border-sky-100',
        'bg-pastelPeach/80 border border-orange-100',
        'bg-pastelLilac/80 border border-purple-100',
        'bg-emerald-50 border border-emerald-100',
        'bg-sky-50 border border-sky-100',
    ];

    // Heroicons references: education, tools, trophy, book, handshake, theater, sparkles, chart, music, target
    $icons = [
        'academic-cap', 'wrench-screwdriver', 'trophy', 'book-open',
        'users', 'face-smile', 'sparkles', 'chart-bar',
        'musical-note', 'bullseye-arrow'
    ];
@endphp

<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900">Explore Categories</h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4">
        @forelse ($categories as $i => $category)
            <div class="rounded-2xl {{ $wrappers[$i % count($wrappers)] }}
                 p-3 md:p-4 flex flex-col items-start hover:-translate-y-0.5 hover:shadow-md transition">

                <div class="w-9 h-9 md:w-10 md:h-10 rounded-2xl bg-white/80 flex items-center justify-center mb-2 md:mb-3">
                    @php $icon = $icons[$i % count($icons)]; @endphp
                    @svg('heroicon-o-' . $icon, 'w-5 h-5 md:w-6 md:h-6 text-slate-700')
                </div>

                <h3 class="text-xs md:text-sm font-semibold text-slate-800">{{ $category['title'] }}</h3>
            </div>
        @empty
            <p class="text-sm text-slate-600">Belum ada kategori yang terdaftar.</p>
        @endforelse
    </div>
</section>
