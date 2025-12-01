@props([
    'variant' => 'default', // default, sky, plain
    'size' => 'md',         // sm, md
])

<span
    {{ $attributes->class([
        // base
        "inline-flex items-center gap-1 rounded-full",

        // size
        "px-2.5 py-0.5 text-[10px] font-medium" => $size === 'xxs',
        "px-2.5 py-1 text-[11px] font-medium" => $size === 'xs',
        "px-3 py-1.5 text-[10px] md:text-xs font-medium" => $size === 'sm',
        "px-3 md:px-4 py-1 text-xs md:text-sm font-medium" => $size === 'md',

        // variants
        "bg-white/70 border border-slate-100 text-slate-700" => $variant === 'default',
        "bg-white/70 border border-sky-100 shadow-sm text-sky-700" => $variant === 'sky',
        "bg-white/70 border border-slate-100" => $variant === 'plain',
        "bg-white rounded-full shadow-2xs border border-slate-100 text-slate-700" => $variant === 'minimalist',
        "bg-slate-50 border border-slate-200 rounded-full text-slate-600" => $variant === 'outline-dark',

        "rounded-full bg-red-50 border border-red-200 text-red-700"=> $variant === "subtle-danger",
        "rounded-full bg-amber-50 border border-amber-200 text-amber-700"=> $variant === "subtle-warning",
        "rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700"=> $variant === "subtle-success",
        "rounded-full bg-sky-50 border border-sky-100 text-sky-700" => $variant === "subtle-info",
        "rounded-full bg-slate-100 border border-slate-200 text-slate-600" => $variant === "subtle-gray",
    ])}}
>
    {{ $slot }}
</span>

