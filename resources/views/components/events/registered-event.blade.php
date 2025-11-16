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

        <article class="bg-white/95 border border-emerald-100 rounded-3xl p-3.5 shadow-sm flex gap-3">
            <div class="relative w-20 h-20 rounded-2xl overflow-hidden bg-slate-200 flex-shrink-0">
                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd"
                    alt="Campus Startup Competition 2025" class="w-full h-full object-cover" />
                <div
                    class="absolute top-1 left-1 px-1.5 py-1 rounded-2xl bg-slate-900/90 text-white text-center min-w-[44px]">
                    <span class="text-[9px] uppercase tracking-wide text-slate-200 block">Min</span>
                    <span class="text-xs font-bold leading-none block">30</span>
                    <span class="text-[9px] text-slate-300 block mt-0.5">Nov</span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="text-xs md:text-sm font-semibold text-slate-900 line-clamp-2">
                        Campus Startup Competition 2025
                    </h3>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-[10px] text-emerald-700 font-medium whitespace-nowrap">
                        Sudah Terdaftar
                    </span>
                </div>
                <p class="mt-1 text-[11px] text-slate-500">
                    Aula &amp; Studio Pitching • 1 hari penuh
                </p>
                <p class="text-[11px] text-slate-500">
                    30 Nov 2025 • 08.00 – 17.00 WIB
                </p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 text-[10px] text-slate-500">
                        ⏰ Ingatkan aku (via email)
                    </span>
                    <a href="#" class="text-[11px] text-sky-600 font-medium">
                        Lihat detail →
                    </a>
                </div>
            </div>
        </article>

        <article class="bg-white/95 border border-emerald-100 rounded-3xl p-3.5 shadow-sm flex gap-3">
            <div class="relative w-20 h-20 rounded-2xl overflow-hidden bg-slate-200 flex-shrink-0">
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984" alt="Workshop UI/UX Dasar"
                    class="w-full h-full object-cover" />
                <div
                    class="absolute top-1 left-1 px-1.5 py-1 rounded-2xl bg-slate-900/90 text-white text-center min-w-[44px]">
                    <span class="text-[9px] uppercase tracking-wide text-slate-200 block">Min</span>
                    <span class="text-xs font-bold leading-none block">24</span>
                    <span class="text-[9px] text-slate-300 block mt-0.5">Nov</span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="text-xs md:text-sm font-semibold text-slate-900 line-clamp-2">
                        Workshop UI/UX Dasar untuk Mahasiswa
                    </h3>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-[10px] text-emerald-700 font-medium whitespace-nowrap">
                        Sudah Terdaftar
                    </span>
                </div>
                <p class="mt-1 text-[11px] text-slate-500">
                    Lab Multimedia FTI • Hands-on Figma
                </p>
                <p class="text-[11px] text-slate-500">
                    24 Nov 2025 • 08.30 – 12.30 WIB
                </p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 text-[10px] text-slate-500">
                        📍 On-site
                    </span>
                    <a href="#" class="text-[11px] text-sky-600 font-medium">
                        Lihat detail →
                    </a>
                </div>
            </div>
        </article>

        <article class="bg-white/95 border border-emerald-100 rounded-3xl p-3.5 shadow-sm flex gap-3">
            <div class="relative w-20 h-20 rounded-2xl overflow-hidden bg-slate-200 flex-shrink-0">
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984" alt="Workshop UI/UX Dasar"
                    class="w-full h-full object-cover" />
                <div
                    class="absolute top-1 left-1 px-1.5 py-1 rounded-2xl bg-slate-900/90 text-white text-center min-w-[44px]">
                    <span class="text-[9px] uppercase tracking-wide text-slate-200 block">Min</span>
                    <span class="text-xs font-bold leading-none block">24</span>
                    <span class="text-[9px] text-slate-300 block mt-0.5">Nov</span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="text-xs md:text-sm font-semibold text-slate-900 line-clamp-2">
                        Workshop UI/UX Dasar untuk Mahasiswa
                    </h3>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-[10px] text-emerald-700 font-medium whitespace-nowrap">
                        Sudah Terdaftar
                    </span>
                </div>
                <p class="mt-1 text-[11px] text-slate-500">
                    Lab Multimedia FTI • Hands-on Figma
                </p>
                <p class="text-[11px] text-slate-500">
                    24 Nov 2025 • 08.30 – 12.30 WIB
                </p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 text-[10px] text-slate-500">
                        📍 On-site
                    </span>
                    <a href="#" class="text-[11px] text-sky-600 font-medium">
                        Lihat detail →
                    </a>
                </div>
            </div>
        </article>
    </div>
</section>
