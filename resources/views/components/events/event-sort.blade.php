<div class="flex items-center gap-2 md:gap-3">
    <label for="sort" class="text-[11px] md:text-xs text-slate-500 whitespace-nowrap">
        Urutkan:
    </label>
    <div class="relative">
        <select id="sort"
            class="appearance-none text-xs md:text-sm pl-3 pr-8 py-2 rounded-2xl bg-white/70 border border-slate-100 text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400/60 cursor-pointer">
            <option value="upcoming">Paling dekat (Upcoming)</option>
            <option value="newest">Terbaru ditambahkan</option>
            <option value="popular">Paling populer</option>
            <option value="az">Judul A-Z</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-slate-400 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18 9c.852 0 1.297.986.783 1.623l-.076.084l-6 6a1 1 0 0 1-1.32.083l-.094-.083l-6-6l-.083-.094l-.054-.077l-.054-.096l-.017-.036l-.027-.067l-.032-.108l-.01-.053l-.01-.06l-.004-.057v-.118l.005-.058l.009-.06l.01-.052l.032-.108l.027-.067l.07-.132l.065-.09l.073-.081l.094-.083l.077-.054l.096-.054l.036-.017l.067-.027l.108-.032l.053-.01l.06-.01l.057-.004z" />
            </svg>
        </span>
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sortSelect = document.getElementById('sort');
                const listContainer = document.querySelector('.view-list');
                const gridContainer = document.querySelector('.view-grid');

                if (!sortSelect || !listContainer || !gridContainer) return;

                // jaga-jaga kalau index belum di-set dari backend
                function ensureIndex(container) {
                    Array.from(container.querySelectorAll('article')).forEach((el, i) => {
                        if (!el.dataset.index) {
                            el.dataset.index = i;
                        }
                    });
                }

                ensureIndex(listContainer);
                ensureIndex(gridContainer);

                function sortArticles(container, compareFn) {
                    const items = Array.from(container.querySelectorAll('article'));
                    items.sort(compareFn);
                    items.forEach(el => container.appendChild(el));
                }

                function getComparator(type) {
                    switch (type) {
                        case 'upcoming':
                            // tanggal terdekat dulu (ascending)
                            return (a, b) => {
                                const da = a.dataset.date || '';
                                const db = b.dataset.date || '';
                                if (da < db) return -1;
                                if (da > db) return 1;
                                return 0;
                            };
                        case 'newest':
                            // yang index terbesar (paling akhir ditambahkan) di atas
                            return (a, b) => {
                                const ia = parseInt(a.dataset.index || '0', 10);
                                const ib = parseInt(b.dataset.index || '0', 10);
                                return ib - ia;
                            };
                        case 'popular':
                            // paling banyak peserta dulu
                            return (a, b) => {
                                const ra = parseInt(a.dataset.registered || '0', 10);
                                const rb = parseInt(b.dataset.registered || '0', 10);
                                return rb - ra;
                            };
                        case 'az':
                            // judul A-Z
                            return (a, b) => {
                                const ta = (a.dataset.title || '').toLocaleLowerCase();
                                const tb = (b.dataset.title || '').toLocaleLowerCase();
                                return ta.localeCompare(tb);
                            };
                        default:
                            return () => 0;
                    }
                }

                function applySort() {
                    const type = sortSelect.value;
                    const comparator = getComparator(type);
                    sortArticles(listContainer, comparator);
                    sortArticles(gridContainer, comparator);
                }

                sortSelect.addEventListener('change', applySort);

                // optional: apply default sort on load (misal upcoming)
                applySort();
            });
        </script>
    @endpush
@endonce
