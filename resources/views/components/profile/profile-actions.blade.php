@props([
    'cancelUrl' => null,
    'note' => 'Pastikan data sudah benar sebelum menyimpan. Perubahan email bisa memengaruhi pengiriman tiket & sertifikat.',
])

<section
    class="pt-2 border-t border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3"
>
    <div class="text-[11px] md:text-xs text-slate-500">
        {{ $note }}
    </div>

    <div class="flex gap-2">
        @if ($cancelUrl)
            <a
                href="{{ $cancelUrl }}"
                class="px-4 py-2 rounded-full border border-slate-200 bg-white text-xs md:text-sm text-slate-700 hover:bg-slate-50"
            >
                Batal
            </a>
        @endif

        <button
            type="submit"
            class="px-5 py-2 rounded-full bg-sky-500 text-white text-xs md:text-sm font-semibold shadow-lg shadow-sky-500/30 hover:bg-sky-600"
        >
            Simpan Perubahan
        </button>
    </div>
</section>
