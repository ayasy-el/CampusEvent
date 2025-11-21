@props(['user'])

<article class="bg-white/90 rounded-3xl border border-slate-100 shadow-sm p-4 md:p-5 space-y-3">
    <h2 class="text-sm md:text-base font-semibold text-slate-900">
        Tentang Saya
    </h2>
    <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
        {{ $user?->bio ?? 'Mahasiswa yang tertarik dengan teknologi, AI, dan pengembangan komunitas di kampus.' }}
    </p>
    <div class="grid gap-3 md:grid-cols-2 text-[11px] md:text-xs text-slate-600">
        <div class="space-y-1">
            <p class="font-semibold text-slate-900 text-xs md:text-sm">Data Akademik</p>
            <p>NRP: {{ $user?->nrp ?? '-' }}</p>
            <p>Program Studi: {{ $user?->program_studi ?? '-' }}</p>
            <p>Angkatan: {{ $user?->angkatan ?? '-' }}</p>
        </div>
        <div class="space-y-1">
            <p class="font-semibold text-slate-900 text-xs md:text-sm">Kontak</p>
            <p>Email: {{ $user?->email ?? '-' }}</p>
            <p>Telepon: {{ $user?->no_telepon ?? '-' }}</p>
        </div>
    </div>
</article>
