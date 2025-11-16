@props([
    'placeholder'
])

<div class="flex-1">
    <label class="sr-only" for="search">Cari event</label>
    <div class="flex items-center gap-2 bg-white/70 border border-slate-100 rounded-2xl px-4 py-2 shadow-sm">
        <span class="text-slate-400 text-sm">🔎</span>
        <input id="search" type="text" placeholder="{{ $placeholder }}"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs md:text-sm text-slate-700 placeholder:text-slate-400" />
    </div>
</div>
