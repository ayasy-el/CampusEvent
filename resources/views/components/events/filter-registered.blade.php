<div class="inline-flex items-center text-[11px] md:text-xs bg-white/80 border border-slate-100 rounded-full p-1 shadow-sm"
    id="event-filter">
    <button type="button" data-filter="semua"
        class="cursor-pointer px-3 py-1 rounded-full bg-slate-900 text-white font-medium">
        Semua
    </button>
    <button type="button" data-filter="mendatang" class="cursor-pointer px-3 py-1 rounded-full text-slate-500">
        Mendatang
    </button>
    <button type="button" data-filter="riwayat" class="cursor-pointer px-3 py-1 rounded-full text-slate-500">
        Riwayat
    </button>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterContainer = document.getElementById('event-filter');
                if (!filterContainer) return;

                const buttons = filterContainer.querySelectorAll('[data-filter]');
                const sectionMendatang = document.querySelector('[data-section="mendatang"]');
                const sectionRiwayat = document.querySelector('[data-section="riwayat"]');

                function setActiveButton(activeBtn) {
                    buttons.forEach(btn => {
                        btn.classList.remove('bg-slate-900', 'text-white', 'font-medium');
                        btn.classList.add('text-slate-500');

                        if (btn === activeBtn) {
                            btn.classList.add('bg-slate-900', 'text-white', 'font-medium');
                            btn.classList.remove('text-slate-500');
                        }
                    });
                }

                function setView(view) {
                    if (!sectionMendatang || !sectionRiwayat) return;

                    if (view === 'semua') {
                        sectionMendatang.classList.remove('hidden');
                        sectionRiwayat.classList.remove('hidden');
                    } else if (view === 'mendatang') {
                        sectionMendatang.classList.remove('hidden');
                        sectionRiwayat.classList.add('hidden');
                    } else if (view === 'riwayat') {
                        sectionMendatang.classList.add('hidden');
                        sectionRiwayat.classList.remove('hidden');
                    }
                }

                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const view = btn.getAttribute('data-filter');
                        setActiveButton(btn);
                        setView(view);
                    });
                });

                // default: Semua
                setView('semua');
            });
        </script>
    @endpush
@endonce
