<section class="mt-4 mb-10 md:mb-14">
    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-10 lg:gap-14">
        <!-- Text -->
        <div class="order-2 md:order-1 mt-6 md:mt-0">
            <x-badge variant="sky" size="md">
                ✨ Portal Baru • Event Kampus
            </x-badge>

            <h1 class="mt-4 text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                Portal Event Kampus
            </h1>
            <p class="mt-3 text-sm sm:text-base md:text-lg text-slate-600 leading-relaxed max-w-xl">
                Temukan seminar, workshop, dan kegiatan kampus yang cocok dengan minatmu.
                Bangun relasi dan pengalaman baru bersama teman-teman 🎓📚
            </p>

            <div class="mt-5 flex flex-wrap items-center gap-3">
                <x-button href="{{ route('events') }}">Jelajahi Event</x-button>
            </div>

            <div class="mt-5 flex flex-wrap gap-3 text-[11px] md:text-xs text-slate-500">
                <x-badge variant="default" size="sm">
                    <x-dot /> +50 event minggu ini
                </x-badge>
                <x-badge variant="default" size="sm">
                    📄 Sertifikat &amp; e-ticket
                </x-badge>
            </div>
        </div>

        <!-- Hero Illustration (rounded collage style) -->
        <div class="order-1 md:order-2 relative">
            <div
                class="rounded-3xl bg-white/70 border border-slate-100 shadow-lg shadow-slate-200/60 p-4 md:p-5 lg:p-6">
                <div class="grid grid-cols-3 gap-2 md:gap-3">
                    <div class="col-span-2 space-y-2 md:space-y-3">
                        <div
                            class="h-24 md:h-32 rounded-2xl md:rounded-3xl bg-gradient-to-tr from-sky-400 to-indigo-500 flex items-end p-3 md:p-4 text-xs md:text-sm font-semibold text-white">
                            Seminar Teknologi Kampus
                        </div>
                        <div class="grid grid-cols-2 gap-2 md:gap-3">
                            <div
                                class="h-16 md:h-20 rounded-2xl bg-gradient-to-tr from-pink-400 to-orange-400 flex items-center justify-center text-[10px] md:text-xs text-white font-semibold text-center px-1 md:px-2">
                                Workshop UI/UX • Lab Multimedia
                            </div>
                            <div
                                class="h-16 md:h-20 rounded-2xl bg-gradient-to-tr from-emerald-400 to-teal-500 flex items-center justify-center text-[10px] md:text-xs text-white font-semibold text-center px-1 md:px-2">
                                Kompetisi IoT &amp; Smart Campus
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 md:gap-3">
                        <div
                            class="h-16 md:h-20 rounded-full bg-pastelPeach flex items-center justify-center text-[10px] md:text-xs font-semibold text-slate-800 text-center px-2 md:px-3">
                            Sharing Alumni &amp; Career Talk
                        </div>
                        <div
                            class="h-24 md:h-32 rounded-3xl bg-pastelLilac flex flex-col items-center justify-center text-[10px] md:text-xs text-slate-700 px-2">
                            <span class="font-semibold mb-1 md:mb-2 text-sm md:text-base">+50 Event</span>
                            <span class="text-[10px]">minggu ini</span>
                            <span class="mt-1 text-[10px] text-slate-500">on-site &amp; online</span>
                        </div>
                    </div>
                </div>
            </div>
            <x-badge variant="minimalist" size="sm"
                class="absolute -top-3 right-0 md:-top-4 md:-right-3">
                🔔 Reminder event hari ini
        </x-badge>
        </div>
    </div>
</section>
