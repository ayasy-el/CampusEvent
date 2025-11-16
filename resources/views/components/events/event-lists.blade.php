@php
    use Carbon\Carbon;

    $events = [
        [
            'title' => 'Future of AI in Campus & Industry',
            'category' => 'seminar',
            'category_icon' => '🎓',
            'mode' => 'hybrid',
            'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d',
            'organizer' => 'BEM Teknik',
            'location' => 'Aula Utama Kampus & Zoom',
            'time' => '09.00 – 12.00',
            'benefit' => 'Sertifikat, snack, doorprize',
            'registered' => 120,
            'quota_info' => 'Kuota tersedia',
            'date' => Carbon::parse('2025-11-23'),
        ],
        [
            'title' => 'Workshop UI/UX Dasar untuk Mahasiswa',
            'category' => 'workshop',
            'category_icon' => '🛠️',
            'mode' => 'onsite',
            'image' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984',
            'organizer' => 'HIMA Informatika',
            'location' => 'Lab Multimedia FTI',
            'time' => '08.30 – 12.30',
            'benefit' => 'Hands-on Figma & prototyping',
            'registered' => 60,
            'quota_info' => 'Kuota hampir penuh',
            'date' => Carbon::parse('2025-11-24'),
        ],
        [
            'title' => 'Campus Startup Competition 2025',
            'category' => 'kompetisi',
            'category_icon' => '🏆',
            'mode' => 'onsite',
            'image' => '',
            'organizer' => 'Inkubator Bisnis Kampus',
            'location' => 'Aula & Studio Pitching',
            'time' => '1 hari penuh',
            'benefit' => 'Mentoring, pitching session, networking',
            'registered' => '30 tim',
            'quota_info' => 'Kuota penuh',
            'date' => Carbon::parse('2025-11-30'),
        ],
    ];

    $eventsCount = count($events);
@endphp

<section class="space-y-3 md:space-y-4">
    <!-- Info summary -->
    <div class="flex items-center justify-between text-[11px] md:text-xs text-slate-500">
        <p>
            Menampilkan
            <span class="font-semibold text-slate-700">1–{{ $eventsCount }}</span>
            dari
            <span class="font-semibold text-slate-700">{{ $eventsCount }}</span>
            event
        </p>
    </div>

    <div id="eventsWrapper" class="space-y-3 md:space-y-4">

        <!-- LIST VIEW -->
        <div class="view-list space-y-3 md:space-y-4">
            @foreach ($events as $i => $event)
                <x-events.event-card :event="$event" :index="$i" variant="list" />
            @endforeach
        </div>

        <div class="view-grid grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-4">
            @foreach ($events as $i => $event)
                <x-events.event-card :event="$event" :index="$i" variant="grid" />
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex items-center justify-between text-[11px] md:text-xs text-slate-500">
        <p>Halaman 1 dari 6</p>
        <div class="inline-flex items-center gap-1">
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white hover:bg-slate-50 transition">
                ‹
            </button>
            <button class="px-3 py-1 rounded-full bg-slate-900 text-white font-semibold">
                1
            </button>
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white hover:bg-slate-50 transition">
                2
            </button>
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white hover:bg-slate-50 transition">
                3
            </button>
            <span class="px-1">...</span>
            <button class="px-3 py-1 rounded-full border border-slate-200 bg-white hover:bg-slate-50 transition">
                ›
            </button>
        </div>
    </div>
</section>
