@props([
'variant' => 'default', // default, sky, plain
'size' => 'md', // sm, md
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

        // variants (with dark mode support)
        "bg-white/70 dark:bg-slate-700/70 border border-slate-100 dark:border-slate-600 text-slate-700 dark:text-slate-200" => $variant === 'default',
        "bg-white/70 dark:bg-slate-700/70 border border-sky-100 dark:border-sky-800 shadow-sm text-sky-700 dark:text-sky-300" => $variant === 'sky',
        "bg-white/70 dark:bg-slate-700/70 border border-slate-100 dark:border-slate-600" => $variant === 'plain',
        "bg-white dark:bg-slate-700 rounded-full shadow-2xs border border-slate-100 dark:border-slate-600 text-slate-700 dark:text-slate-200" => $variant === 'minimalist',
        "bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-full text-slate-600 dark:text-slate-300" => $variant === 'outline-dark',

        "rounded-full bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300"=> $variant === "subtle-danger",
        "rounded-full bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-300"=> $variant === "subtle-warning",
        "rounded-full bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300"=> $variant === "subtle-success",
        "rounded-full bg-sky-50 dark:bg-sky-900/30 border border-sky-100 dark:border-sky-800 text-sky-700 dark:text-sky-300" => $variant === "subtle-info",
        "rounded-full bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300" => $variant === "subtle-gray",
    ])}}>
    {{ $slot }}
</span>