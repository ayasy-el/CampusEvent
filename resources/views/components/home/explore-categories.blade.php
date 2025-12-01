@props(['categories' => collect()])

<section class="mb-10 md:mb-14">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg md:text-2xl font-semibold text-slate-900 dark:text-white">
            Explore Categories
        </h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4">
        @forelse ($categories as $i => $category)
        <a
            href="{{ route('events', ['categories' => $category['slug']]) }}"
            class="group rounded-xl
                       bg-slate-100 dark:bg-slate-800
                       hover:bg-slate-200 dark:hover:bg-slate-700
                       p-4 md:p-5 min-h-16
                       flex items-center justify-center text-center
                       border border-slate-200 dark:border-slate-700
                       transition duration-200">

            <h3 class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white">
                {{ $category['title'] }}
            </h3>
        </a>
        @empty
        <p class="text-sm text-slate-600 dark:text-slate-400">Belum ada kategori yang terdaftar.</p>
        @endforelse
    </div>
</section>