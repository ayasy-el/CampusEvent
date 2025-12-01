@props([
    'title',
    'description',
    'href' => '#',
])

<div class="mt-6 bg-sky-50/90 dark:bg-sky-900/30 border border-sky-100 dark:border-sky-800 rounded-2xl px-3.5 py-3 md:px-4 md:py-3.5 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div class="flex items-start gap-2">
        <div class="mt-0.5 w-7 h-7 rounded-xl bg-sky-100 dark:bg-sky-800 flex items-center justify-center text-sm">
            <svg class="w-4 h-4 text-sky-600 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
        </div>

        <div>
            <p class="text-xs md:text-sm font-semibold text-slate-900 dark:text-white">
                {{ $title }}
            </p>

            <p class="text-[11px] md:text-xs text-slate-600 dark:text-slate-300">
                {!! $description !!}
            </p>
        </div>
    </div>

    <div class="w-full lg:w-auto flex md:inline-flex justify-stretch md:justify-end">
        <a href="{{ $href }}"
            class="inline-flex justify-center items-center gap-1 px-3.5 py-1.75 rounded-full text-xs md:text-sm font-semibold
                   bg-sky-600 text-white shadow-sm hover:bg-sky-700 transition w-full md:w-auto">
            {{ $slot }}
        </a>
    </div>
</div>
