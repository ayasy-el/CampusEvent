@props([
    'emailKampus' => 'nama.mahasiswa@kampus.ac.id',
    'emailPribadi' => null,
    'telepon' => null,
    'kota' => null,
])

<section class="space-y-3">
    <h2 class="text-sm md:text-base font-semibold text-slate-900">
        Kontak
    </h2>
    <div class="grid gap-3 md:grid-cols-2 text-xs md:text-sm">
        <div class="space-y-1.5">
            <label for="email" class="block text-[11px] md:text-xs text-slate-600">Email kampus</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $emailKampus) }}"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-slate-50 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
        <div class="space-y-1.5">
            <label for="email-pribadi" class="block text-[11px] md:text-xs text-slate-600">
                Email pribadi (opsional)
            </label>
            <input
                id="email-pribadi"
                name="email_pribadi"
                type="email"
                value="{{ old('email_pribadi', $emailPribadi) }}"
                placeholder="contoh@gmail.com"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
        <div class="space-y-1.5">
            <label for="telepon" class="block text-[11px] md:text-xs text-slate-600">
                No. telepon (opsional)
            </label>
            <input
                id="telepon"
                name="telepon"
                type="tel"
                value="{{ old('telepon', $telepon) }}"
                placeholder="08xxxxxxxxxx"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
        <div class="space-y-1.5">
            <label for="kota" class="block text-[11px] md:text-xs text-slate-600">Kota / domisili</label>
            <input
                id="kota"
                name="kota"
                type="text"
                value="{{ old('kota', $kota) }}"
                placeholder="Kota Pendidikan"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
    </div>
</section>
