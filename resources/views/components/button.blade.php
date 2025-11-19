@props([
    'variant' => 'primary-lg',
    'href' => '#',
])

<a href="{{ $href }}"
    {{ $attributes->class([
        'inline-flex items-center font-semibold transition rounded-full',

        'px-7 md:px-8 py-3.5 bg-sky-500 text-white text-sm md:text-base shadow-lg shadow-sky-500/30 hover:bg-sky-600' => $variant === 'primary-lg',
        'text-xs md:text-sm text-sky-600 hover:text-sky-800 px-0 py-0 rounded-none shadow-none' => $variant === 'link-sm',
        'px-4 py-1.5 rounded-full border border-slate-200 bg-white text-black hover:bg-slate-50' => $variant === 'ghost-white',
        'px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-semibold hover:bg-slate-800' => $variant === 'dark-sm',
        'px-4 py-1.5 bg-sky-500 text-white rounded-full text-xs hover:bg-sky-600' => $variant === "primary-sm",
        'inline-flex items-center justify-center gap-1 px-4 md:px-5 py-1.5 rounded-full bg-white text-sky-700 text-xs md:text-sm font-semibold shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-sky-400 focus-visible:ring-offset-slate-900 transition' => $variant === 'white-action',
        'items-center justify-center gap-1 px-4 py-1.5 rounded-full border border-white/70 text-xs font-semibold text-white hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-sky-300 focus-visible:ring-offset-slate-900 transition' => $variant === 'ghost-white-outline',
    ]) }}>
    {{ $slot }}
</a>
