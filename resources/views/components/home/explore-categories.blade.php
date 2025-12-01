@props(['categories' => collect()])

@php
    $wrappers = [
        // Cool & Professional
        'bg-gradient-to-br from-sky-500 via-indigo-500 to-violet-500',
        'bg-gradient-to-br from-cyan-500 via-sky-500 to-indigo-500',
        'bg-gradient-to-br from-blue-600 via-indigo-500 to-purple-600',

        // Bold & Creative
        'bg-gradient-to-br from-pink-500 via-violet-500 to-fuchsia-500',
        'bg-gradient-to-br from-fuchsia-500 via-purple-500 to-indigo-600',

        // Fresh & Energetic
        'bg-gradient-to-br from-lime-400 via-emerald-500 to-teal-600',
        'bg-gradient-to-br from-amber-400 via-orange-500 to-rose-500',

        // Clean Tech Look
        'bg-gradient-to-br from-sky-400 via-cyan-500 to-teal-600',
        'bg-gradient-to-br from-emerald-500 via-blue-500 to-sky-500',
        'bg-gradient-to-br from-amber-500 via-pink-500 to-rose-600',
    ];
@endphp

<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900">
            Explore Categories
        </h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4">
        @forelse ($categories as $i => $category)
            <a
                href="{{ route('events', ['categories' => $category['slug']]) }}"
                class="group relative overflow-hidden rounded-3xl
                       {{ $wrappers[$i % count($wrappers)] }}
                       p-4 md:p-5 min-h-[88px] md:min-h-[96px]
                       flex items-center justify-center text-center
                       shadow-[0_18px_45px_rgba(15,23,42,0.18)]
                       hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(15,23,42,0.30)]
                       transition duration-200">
                <span
                    class="pointer-events-none absolute inset-0
                             bg-white/20 mix-blend-overlay
                             opacity-0 group-hover:opacity-100
                             transition-opacity duration-200"></span>

                <h3 class="relative text-sm md:text-base font-semibold text-white tracking-wide drop-shadow">
                    {{ $category['title'] }}
                </h3>
            </a>
        @empty
            <p class="text-sm text-slate-600">Belum ada kategori yang terdaftar.</p>
        @endforelse
    </div>
</section>
