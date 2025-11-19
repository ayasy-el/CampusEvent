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


<main class="space-y-8 md:space-y-10">
    <section data-section="mendatang">
        <div class="flex items-center justify-between mb-3 md:mb-4">
            <div>
                <h2 class="text-lg md:text-xl font-bold text-slate-900">
                    Event Terdaftar – Mendatang
                </h2>
                <p class="text-[11px] md:text-xs text-slate-500">
                    Ini event yang masih akan berlangsung. Pastikan cek jadwal dan lokasi dengan baik ya!
                </p>
            </div>
            <x-badge variant="subtle-success" size="xs">
                ⏰ 3 event mendatang
            </x-badge>
        </div>

        <!-- Kalau belum ada event, bisa tampil empty state seperti ini (nanti dihandle backend):
                          <div class="bg-white/90 border border-dashed border-slate-200 rounded-3xl p-4 text-center text-xs text-slate-500">
                            Kamu belum mendaftar event mendatang. Yuk jelajahi <a href="semua-event.html" class="font-semibold text-sky-600">Semua Event</a>!
                          </div>
                          -->

        <!-- Contoh daftar event mendatang -->

        <div class="space-y-3 md:space-y-4">
            @foreach ($events as $i => $event)
                <x-events.event-card :event="$event" :index="$i+1" variant="list" status="registered"
                    show_detail="true" />
            @endforeach
        </div>
    </section>

    <section data-section="riwayat">
        <div class="flex items-center justify-between mb-3 md:mb-4">
            <div>
                <h2 class="text-lg md:text-xl font-bold text-slate-900">
                    Riwayat Event (History)
                </h2>
                <p class="text-[11px] md:text-xs text-slate-500">
                    Event yang sudah kamu ikuti atau sudah lewat. Cocok untuk cek sertifikat atau materi.
                </p>
            </div>
            <x-badge variant="subtle-gray" size='xs'> 📚 2 event selesai </x-badge>
        </div>

        <div class="space-y-3 md:space-y-4">
            @foreach ($events as $i => $event)
                <x-events.event-card :event="$event" :index="$i+1" variant="list" status="finished"
                    show_detail="true" />
            @endforeach
        </div>
    </section>
</main>
