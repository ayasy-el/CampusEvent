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

    $categories = [
        ['title' => 'Seminar', 'icon' => '🎓', 'subtitle' => 'Inspiration & insight'],
        ['title' => 'Workshop', 'icon' => '🛠️', 'subtitle' => 'Hands-on skill'],
        ['title' => 'Kompetisi', 'icon' => '🏆', 'subtitle' => 'Show your talent'],
        ['title' => 'Pelatihan', 'icon' => '📚', 'subtitle' => 'Upgrade skill'],
        ['title' => 'Komunitas', 'icon' => '🤝', 'subtitle' => 'Network & friends'],
    ];
@endphp

<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900">Explore Categories</h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4">
        @foreach ($categories as $i => $category)
            <div class="rounded-2xl {{ $wrappers[$i % count($wrappers)] }}
                 p-3 md:p-4 flex flex-col items-start hover:-translate-y-0.5 hover:shadow-md transition">

                <div class="w-9 h-9 md:w-10 md:h-10 rounded-2xl bg-white/80 flex items-center justify-center mb-2 md:mb-3 text-lg">
                    {{ $category['icon'] }}
                </div>

                <h3 class="text-xs md:text-sm font-semibold text-slate-800">{{ $category['title'] }}</h3>
                <p class="text-[11px] md:text-xs text-slate-500 mt-1">{{ $category['subtitle'] }}</p>
            </div>
        @endforeach
    </div>
</section>
