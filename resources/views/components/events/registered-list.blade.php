@props([
    'upcomingEvents' => collect(),
    'pastEvents' => collect(),
])

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
                ⏰ {{ $upcomingEvents->count() }} event mendatang
            </x-badge>
        </div>

        @if ($upcomingEvents->isEmpty())
            <div class="bg-white/90 border border-dashed border-slate-200 rounded-3xl p-4 text-center text-xs text-slate-500">
                Kamu belum mendaftar event mendatang. Yuk jelajahi
                <a href="{{ route('events') }}" class="font-semibold text-sky-600">Semua Event</a>!
            </div>
        @else
            <div class="space-y-3 md:space-y-4">
                @foreach ($upcomingEvents as $i => $event)
                    <x-events.event-card :event="$event" :index="$i+1" variant="list" status="registered"
                        show_detail="true" />
                @endforeach
            </div>
        @endif
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
            <x-badge variant="subtle-gray" size='xs'> 📚 {{ $pastEvents->count() }} event selesai </x-badge>
        </div>

        @if ($pastEvents->isEmpty())
            <div class="bg-white/90 border border-dashed border-slate-200 rounded-3xl p-4 text-center text-xs text-slate-500">
                Belum ada riwayat event. Mulai daftar event baru di
                <a href="{{ route('events') }}" class="font-semibold text-sky-600">Semua Event</a>.
            </div>
        @else
            <div class="space-y-3 md:space-y-4">
                @foreach ($pastEvents as $i => $event)
                    <x-events.event-card :event="$event" :index="$i+1" variant="list" status="finished"
                        show_detail="true" />
                @endforeach
            </div>
        @endif
    </section>
</main>
