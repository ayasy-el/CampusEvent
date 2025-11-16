@props([
    'title',
    'description',
    'href' => '#',
])

<div class="mt-6 bg-sky-50/90 border border-sky-100 rounded-2xl px-3.5 py-3 md:px-4 md:py-3.5 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div class="flex items-start gap-2">
        <div class="mt-0.5 w-7 h-7 rounded-xl bg-sky-100 flex items-center justify-center text-sm">
            📌
        </div>

        <div>
            <p class="text-xs md:text-sm font-semibold text-slate-900">
                {{ $title }}
            </p>

            <p class="text-[11px] md:text-xs text-slate-600">
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
