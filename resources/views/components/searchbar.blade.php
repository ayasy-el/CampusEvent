@props([
    'placeholder',
    'name' => 'q',
    'value' => '',
    'action' => null,
    'hidden' => collect(),
])

<form method="GET" action="{{ $action ?? request()->url() }}" class="flex-1">
    <label class="sr-only" for="search">Cari event</label>
    @foreach (collect($hidden) as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach
    <div class="flex items-center gap-2 bg-white/70 dark:bg-slate-800/70 border border-slate-100 dark:border-slate-700 rounded-2xl px-4 py-2 shadow-sm">
        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
        <input id="search" type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs md:text-sm text-slate-700 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-500" />
        @if ($value)
            <button type="submit" name="{{ $name }}" value=""
                class="text-[11px] text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 cursor-pointer">×</button>
        @endif
    </div>
</form>
