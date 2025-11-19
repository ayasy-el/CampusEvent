<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900">
            Upcoming Campus Events
        </h2>
        <x-button variant="link-sm" href="{{ route('events') }}">
            Lihat semua
        </x-button>
    </div>

    <div class="-mx-4 px-4 md:mx-0 md:px-0">
        <div class="flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 overflow-x-auto md:overflow-visible pb-2 md:pb-0">
            @php
                $events = [
                    [
                        'title' => 'Tech Talk: AI di Kampus',
                        'datetime' => 'Jumat, 22 Nov • 15.00',
                        'organizer' => 'BEM FTE • Zoom & Aula',
                        'bg' => 'from-sky-400 to-indigo-500',
                    ],
                    [
                        'title' => 'Workshop UI/UX Dasar',
                        'datetime' => 'Sabtu, 23 Nov • 09.00',
                        'organizer' => 'HIMA Informatika',
                        'bg' => 'from-pink-400 to-orange-400',
                    ],
                    [
                        'title' => 'Lomba Startup Digital',
                        'datetime' => 'Minggu, 24 Nov • 13.00',
                        'organizer' => 'Inkubator Bisnis Kampus',
                        'bg' => 'from-emerald-400 to-teal-500',
                    ],
                ];
            @endphp

            @foreach ($events as $event)
                <x-card :title="$event['title']" :datetime="$event['datetime']" :organizer="$event['organizer']" :bg="$event['bg']" />
            @endforeach

            <article
                class="hidden lg:block bg-white rounded-2xl shadow-md shadow-slate-200/60 border border-dashed border-slate-200">
                <div class="h-full flex flex-col items-center justify-center px-4 py-5 text-center">
                    <p class="text-xs text-slate-500 mb-2">
                        Punya event kampus?
                    </p>
                    <x-button href="#" variant="dark-sm">
                        Daftarkan Eventmu
                    </x-button>
                </div>
            </article>
        </div>
    </div>
</section>
