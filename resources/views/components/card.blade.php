@props([
    'title',
    'datetime',
    'organizer',
    'bg' => 'from-sky-400 to-indigo-500', // gradient background
])

<article
    {{ $attributes->class([
        "flex-none md:flex-auto w-60 md:w-auto bg-white rounded-2xl shadow-md shadow-slate-200/60 border border-slate-100 hover:shadow-lg hover:-translate-y-0.5 transition",
    ]) }}
>
    <div class="h-28 md:h-32 rounded-2xl bg-gradient-to-tr {{ $bg }} m-2"></div>

    <div class="px-3 pb-3 space-y-1.5">
        <h3 class="text-sm md:text-base font-semibold text-slate-900 line-clamp-2">
            {{ $title }}
        </h3>
        <p class="text-xs text-slate-500">
            {{ $datetime }}
        </p>
        <p class="text-xs text-slate-500">
            {{ $organizer }}
        </p>
    </div>
</article>
