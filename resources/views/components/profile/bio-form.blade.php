@props([
    'bio' => 'Mahasiswa yang tertarik dengan teknologi, AI, dan pengembangan komunitas di kampus.',
])

<section class="space-y-3">
    <h2 class="text-sm md:text-base font-semibold text-slate-900">
        Bio Singkat
    </h2>
    <div class="space-y-1.5 text-xs md:text-sm">
        <label for="bio" class="block text-[11px] md:text-xs text-slate-600">
            Ceritakan minat dan ketertarikanmu (max 2–3 kalimat)
        </label>
        <textarea
            id="bio"
            name="bio"
            rows="3"
            class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
        >{{ old('bio', $bio) }}</textarea>
    </div>
</section>
