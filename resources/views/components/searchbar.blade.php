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
    <div class="flex items-center gap-2 bg-white/70 border border-slate-100 rounded-2xl px-4 py-2 shadow-sm">
        <span class="text-slate-400 text-sm">🔎</span>
        <input id="search" type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 text-xs md:text-sm text-slate-700 placeholder:text-slate-400" />
        @if ($value)
            <button type="submit" name="{{ $name }}" value=""
                class="text-[11px] text-slate-500 hover:text-slate-700 cursor-pointer">×</button>
        @endif
    </div>
</form>
