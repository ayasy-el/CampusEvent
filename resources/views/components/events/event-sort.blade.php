@props(['selected' => 'upcoming', 'hidden' => collect()])

<form method="GET" class="flex items-center gap-2 md:gap-3">
    @foreach (collect($hidden) as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach
    <label for="sort" class="text-[11px] md:text-xs text-slate-500 whitespace-nowrap">
        Urutkan:
    </label>
    <div class="relative">
        <select id="sort" name="sort"
            class="appearance-none text-xs md:text-sm pl-3 pr-8 py-2 rounded-2xl bg-white/70 border border-slate-100 text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400/60 cursor-pointer"
            onchange="this.form.submit()">
            <option value="upcoming" @selected($selected === 'upcoming')>Paling dekat (Upcoming)</option>
            <option value="newest" @selected($selected === 'newest')>Terbaru ditambahkan</option>
            <option value="popular" @selected($selected === 'popular')>Paling populer</option>
            <option value="az" @selected($selected === 'az')>Judul A-Z</option>
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-slate-400 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18 9c.852 0 1.297.986.783 1.623l-.076.084l-6 6a1 1 0 0 1-1.32.083l-.094-.083l-6-6l-.083-.094l-.054-.077l-.054-.096l-.017-.036l-.027-.067l-.032-.108l-.01-.053l-.01-.06l-.004-.057v-.118l.005-.058l.009-.06l.01-.052l.032-.108l.027-.067l.07-.132l.065-.09l.073-.081l.094-.083l.077-.054l.096-.054l.036-.017l.067-.027l.108-.032l.053-.01l.06-.01l.057-.004z" />
            </svg>
        </span>
    </div>
</form>
