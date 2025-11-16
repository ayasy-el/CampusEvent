@props([
    'photoUrl' => "https://images.pexels.com/photos/1181395/pexels-photo-1181395.jpeg?auto=compress&cs=tinysrgb&w=800",
    'fullName' => 'Nama Lengkap Mahasiswa',
    'prodi' => 'Teknik Informatika',
])

<section class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="flex items-center gap-3">
        <div
            class="w-14 h-14 md:w-16 md:h-16 rounded-3xl bg-cover bg-center"
            style="background-image: url('{{ $photoUrl }}')"
        ></div>
        <div class="text-xs md:text-sm text-slate-700">
            <p class="font-semibold text-slate-900">{{ $fullName }}</p>
            <p class="text-[11px] md:text-xs text-slate-500">
                Mahasiswa • {{ $prodi }}
            </p>
        </div>
    </div>
</section>
