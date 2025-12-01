@props(['user'])

<section class="mb-5 md:mb-8">
    <div
        class="bg-white/90 rounded-3xl border border-slate-100 shadow-sm p-4 md:p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div
                    class="w-16 h-16 md:w-20 md:h-20 rounded-3xl bg-[url('{{ $user?->avatar_url ?? 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png?20170328184010' }}')] bg-cover bg-center">
                </div>
                <span
                    class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center text-white">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </span>
            </div>
            <div>
                <p class="text-xs md:text-sm font-semibold text-slate-900">
                    {{ $user?->name ?? '-' }}
                </p>
                <p class="text-[11px] md:text-xs text-slate-500">
                    @php
                    $detail = collect([$user?->program_studi, $user?->angkatan])
                    ->filter()
                    ->implode(' • ');
                    @endphp
                    {{ $detail !== '' ? $detail : '-' }}
                </p>
                <p class="mt-1 text-[11px] md:text-xs text-slate-500">
                    {{ $user?->kota ?? '-' }}
                </p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2 md:gap-3 items-center">
            <a href="{{ route('edit_profile') }}"
                class="inline-flex items-center px-3.5 py-1.5 rounded-full bg-slate-900 text-white text-[11px] md:text-xs font-semibold hover:bg-slate-800">
                Edit Profil
            </a>
        </div>
    </div>
</section>