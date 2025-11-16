@php
    $organizations = [
        [
            'type' => 'Organisasi',
            'title' => 'BEM Universitas',
            'desc' => 'Event skala kampus & kolaborasi lintas jurusan',
            'image' => "https://images.pexels.com/photos/207691/pexels-photo-207691.jpeg?auto=compress&cs=tinysrgb&w=800"
        ],
        [
            'type' => 'Organisasi',
            'title' => 'HIMA Informatika',
            'desc' => 'Seminar teknologi, coding bootcamp, dan kompetisi IT',
            'image' => "https://images.pexels.com/photos/1181395/pexels-photo-1181395.jpeg?auto=compress&cs=tinysrgb&w=800"
        ],
        [
            'type' => 'UKM',
            'title' => 'UKM Kewirausahaan',
            'desc' => 'Inkubasi bisnis, mentoring, dan business talk',
            'image' => "https://images.pexels.com/photos/3184328/pexels-photo-3184328.jpeg?auto=compress&cs=tinysrgb&w=800"
        ],
    ];
@endphp


<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900">
            Organizations
        </h2>
        <x-button variant="link-sm" href="#">
            Lihat semua
        </x-button>
    </div>

    <div class="space-y-3 md:space-y-0 md:grid md:grid-cols-3 md:gap-4">

        @foreach ($organizations as $org)
            <article
                class="rounded-3xl overflow-hidden bg-slate-900 relative hover:shadow-xl hover:-translate-y-0.5 transition">
                <div
                    class="h-24 md:h-32 bg-[url('{{ $org['image'] }}')] bg-cover bg-center opacity-70">
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>

                <div class="absolute bottom-3 left-4 right-4">
                    <p class="text-xs uppercase tracking-wide text-slate-200 opacity-80">
                        {{ $org['type'] }}
                    </p>

                    <h3 class="text-sm md:text-base font-semibold text-white">
                        {{ $org['title'] }}
                    </h3>

                    <p class="text-[11px] md:text-xs text-slate-200/80 mt-0.5">
                        {{ $org['desc'] }}
                    </p>
                </div>
            </article>
        @endforeach

    </div>
</section>
