@props([
    'title',
    'description',
])

<section class="mb-4 md:mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white">
                {{ $title }}
            </h1>
            <p class="mt-1 text-xs md:text-sm text-slate-500 dark:text-slate-400">
                {{ $description }}
            </p>
        </div>
        <div class="flex items-center gap-2 text-[11px] md:text-xs text-slate-500 dark:text-slate-400">
            {{ $badge ?? '' }}
        </div>
    </div>


    {{ $slot }}
</section>
