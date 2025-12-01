@once
    @push('styles')
        <style>
            #eventsWrapper[data-view="list"] .view-list {
                display: block;
            }

            #eventsWrapper[data-view="list"] .view-grid {
                display: none;
            }

            #eventsWrapper[data-view="grid"] .view-list {
                display: none;
            }

            #eventsWrapper[data-view="grid"] .view-grid {
                display: grid;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const toggleFiltersBtn = document.getElementById('toggleFilters');
                const filters = document.getElementById('filters');

                if (toggleFiltersBtn && filters) {
                    toggleFiltersBtn.addEventListener('click', () => {
                        filters.classList.toggle('hidden');
                    });
                }

                // --- VIEW MODE ---
                const viewBtn = document.getElementById('viewModeBtn');
                const viewIcon = document.getElementById('viewModeIcon');
                const wrapper = document.getElementById('eventsWrapper');

                let mode = 'list'; // default

                function updateView() {
                    wrapper.setAttribute('data-view', mode);

                    if (mode === 'list') {
                        // ICON LIST:
                        viewIcon.innerHTML = `
                    <g transform="translate(-30,-20) scale(1.25)">
                        <rect x="80" y="40" width="100" height="16" rx="8" fill="currentColor"/>
                        <rect x="65" y="73" width="130" height="16" rx="8" fill="currentColor"/>
                        <rect x="50" y="106" width="160" height="84" rx="20" fill="currentColor"/>
                    </g>
                    `;
                    } else {
                        // ICON GRID:
                        viewIcon.innerHTML = `
                        <rect x="20" y="20" width="90" height="90" rx="16" fill="currentColor"/>
                        <rect x="140" y="20" width="90" height="90" rx="16" fill="currentColor"/>

                        <rect x="20" y="140" width="90" height="90" rx="16" fill="currentColor"/>
                        <rect x="140" y="140" width="90" height="90" rx="16" fill="currentColor"/>

                    `;
                    }
                }

                updateView();

                viewBtn.addEventListener('click', () => {
                    mode = (mode === 'list') ? 'grid' : 'list';
                    updateView();
                });

            });
        </script>
    @endpush

@endonce


<div class="flex items-center gap-2 md:gap-3">
    <button id="viewModeBtn" type="button"
        class="w-9 h-9 flex items-center justify-center rounded-xl shadow-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition"
        aria-label="Toggle view mode">
        <svg id="viewModeIcon" viewBox="0 0 240 240" class="w-5 h-5">
            <rect x="80" y="40" width="100" height="16" rx="8" fill="currentColor" />
            <rect x="65" y="73" width="130" height="16" rx="8" fill="currentColor" />
            <rect x="50" y="106" width="160" height="84" rx="20" fill="currentColor" />
        </svg>
    </button>
</div>

<!-- Mobile: toggle filter -->
<button id="toggleFilters" type="button"
    class="md:hidden inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-[11px] font-medium text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.5"
            d="M4 3h16a1 1 0 0 1 1 1v1.586a1 1 0 0 1-.293.707l-6.414 6.414a1 1 0 0 0-.293.707v6.305a1 1 0 0 1-1.242.97l-2-.5a1 1 0 0 1-.758-.97v-5.805a1 1 0 0 0-.293-.707L3.293 6.293A1 1 0 0 1 3 5.586V4a1 1 0 0 1 1-1" />
    </svg>
</button>
