@props([
    'fullName' => 'Nama Lengkap Mahasiswa',
    'nim' => '220123456',
    'prodi' => 'Teknik Informatika',
    'angkatan' => '2022',
])

<section class="space-y-3">
    <h2 class="text-sm md:text-base font-semibold text-slate-900">
        Data Dasar
    </h2>
    <div class="grid gap-3 md:grid-cols-2 text-xs md:text-sm">
        <div class="space-y-1.5">
            <label for="nama" class="block text-[11px] md:text-xs text-slate-600">Nama lengkap</label>
            <input
                id="nama"
                name="nama"
                type="text"
                value="{{ old('nama', $fullName) }}"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-slate-50 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
        <div class="space-y-1.5">
            <label for="nim" class="block text-[11px] md:text-xs text-slate-600">NIM</label>
            <input
                id="nim"
                type="text"
                value="{{ $nim }}"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-slate-100 text-slate-500 cursor-not-allowed"
                disabled
            />
        </div>
        <div class="space-y-1.5">
            <label for="prodi" class="block text-[11px] md:text-xs text-slate-600">Program studi</label>
            <input
                id="prodi"
                name="prodi"
                type="text"
                value="{{ old('prodi', $prodi) }}"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-slate-50 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
        <div class="space-y-1.5">
            <label for="angkatan" class="block text-[11px] md:text-xs text-slate-600">Angkatan</label>
            <input
                id="angkatan"
                name="angkatan"
                type="text"
                value="{{ old('angkatan', $angkatan) }}"
                class="w-full rounded-2xl border border-slate-200 px-3 py-2 bg-slate-50 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-400/70"
            />
        </div>
    </div>
</section>
