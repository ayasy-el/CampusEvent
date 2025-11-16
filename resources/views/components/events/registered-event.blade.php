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
            'location' => 'Main Hall',
            'time' => '09.00 – 12.00',
            'benefit' => '',
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
            'organizer' => 'HIMA IT',
            'location' => 'Lab Multimedia FTI',
            'time' => '08.30 – 12.30',
            'benefit' => '',
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
            'organizer' => 'Inkubator Bisnis',
            'location' => 'PENS Sky',
            'time' => '1 hari penuh',
            'benefit' => '',
            'registered' => '30 tim',
            'quota_info' => 'Kuota penuh',
            'date' => Carbon::parse('2025-11-30'),
        ],
    ];

    $eventsCount = count($events);
@endphp




<section id="my-events-section" class="mt-8 md:mt-10">
    <div class="flex items-end justify-between mb-3 md:mb-4">
        <div>
            <h2 class="text-lg md:text-xl font-bold text-slate-900">
                Event yang Kamu Daftarkan
            </h2>
            <p class="text-[11px] md:text-xs text-slate-500">
                Daftar event yang sudah kamu pilih. Datang tepat waktu ya ✨
            </p>
        </div>
        <x-button href="#" variant="link-sm">Show All</x-button>
    </div>


    <!-- CONTOH KETIKA BELUM ADA EVENT:
        <div class="bg-white/90 border border-dashed border-slate-200 rounded-3xl p-4 text-center text-xs text-slate-500">
          Kamu belum mendaftar event apapun. Yuk eksplor <span class="font-semibold text-sky-600">Semua Event</span> di atas!
        </div>
        -->

    <!-- CONTOH KETIKA SUDAH ADA EVENT TERDAFTAR -->
    <div class="grid gap-3 lg:grid-cols-3">
        @foreach ($events as $i => $event)
            <x-events.event-card :event="$event" :index="$i" variant="list" status="registered"
                show_detail="true" />
        @endforeach
    </div>
</section>
