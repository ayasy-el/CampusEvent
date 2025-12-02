@props([
    'total' => 0,
    'upcomingCount' => 0,
    'pastCount' => 0,
])

<div class="grid gap-2 md:grid-cols-3 text-[11px] md:text-xs">
    <div class="flex items-center gap-2 bg-white/80 dark:bg-slate-800/95 border border-slate-100 dark:border-slate-700 rounded-2xl px-3 py-2">
        <div class="w-7 h-7 rounded-xl bg-sky-100 flex items-center justify-center text-xs">🎫</div>
        <div>
            <p class="font-semibold text-slate-800 dark:text-white">Total Event Terdaftar</p>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $total }} event</p>
        </div>
    </div>
    <div class="flex items-center gap-2 bg-white/80 dark:bg-slate-800/95 border border-slate-100 dark:border-slate-700 rounded-2xl px-3 py-2">
        <div class="w-7 h-7 rounded-xl bg-emerald-100 flex items-center justify-center text-xs">⏰</div>
        <div>
            <p class="font-semibold text-slate-800 dark:text-white">Event Mendatang</p>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $upcomingCount }} event</p>
        </div>
    </div>
    <div class="flex items-center gap-2 bg-white/80 dark:bg-slate-800/95 border border-slate-100 dark:border-slate-700 rounded-2xl px-3 py-2">
        <div class="w-7 h-7 rounded-xl bg-slate-100 flex items-center justify-center text-xs">📚</div>
        <div>
            <p class="font-semibold text-slate-800 dark:text-white">Riwayat Event</p>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ $pastCount }} event</p>
        </div>
    </div>
</div>
