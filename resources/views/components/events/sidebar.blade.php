@props(['event', 'user'])

<aside class="space-y-4 md:space-y-5 md:sticky md:top-20 h-max">
    <section class="bg-white rounded-3xl border border-slate-100 shadow-md shadow-slate-200/80 p-4 md:p-5 space-y-3">
        <div class="flex items-center justify-between">
            <p class="text-xs font-semibold text-slate-900">
                {{ $event['date']?->translatedFormat('l, d F Y') }}
            </p>
            <span
                class="px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-[11px] text-emerald-700 font-medium">
                {{ $event['quota_info'] ?? 'Kuota tersedia' }}
            </span>
        </div>
        <p class="text-[11px] md:text-xs text-slate-500">
            {{ $event['time'] ?? '-' }} WIB • {{ $event['location'] ?? '-' }}
        </p>

        <div class="border-t border-slate-100 pt-3 mt-2 space-y-2">
            <div class="flex items-center justify-between text-xs text-slate-700">
                <span>Harga tiket</span>
                <span class="font-semibold text-slate-900">{{ $event['price_display'] ?? 'Gratis' }}</span>
            </div>
            <p class="text-[11px] text-slate-500">
                Kuota peserta: maks.
                {{ $event['quota'] ?? '-' }}
                • Saat ini {{ $event['registered'] ?? 0 }} sudah terdaftar.
            </p>
        </div>

        <a href=@if ($user) "#" {{-- TODO: ganti dengan link pendaftaran actual --}}
                @else "{{ route('filament.admin.auth.login') }}" @endif
            @class([
                'block text-center w-full mt-2 px-4 py-2.5 rounded-full text-sm font-semibold',
                'bg-sky-500 text-white shadow-lg shadow-sky-500/30 hover:bg-sky-600' =>
                    !$user || $user->role === 'mahasiswa',
                'cursor-not-allowed bg-slate-200 text-slate-500 hover:bg-slate-200 shadow-none' =>
                    $user && $user->role === 'admin',
            ]) @if ($user && $user->role === 'admin') inactive @endif>
            Daftar Sekarang
        </a>
    </section>

    <!-- Info tambahan / contact -->
    <section class="bg-white/90 rounded-3xl border border-slate-100 shadow-sm p-3.5 md:p-4 space-y-2">
        <p class="text-xs font-semibold text-slate-900">
            Informasi &amp; Kontak
        </p>
        <p class="text-[11px] text-slate-600">
            Jika ada pertanyaan terkait event, silakan hubungi:
        </p>
        <ul class="text-[11px] text-slate-600 space-y-1">
            @if (!empty($event['contact_email']))
                <li>📧 <span class="font-medium">{{ $event['contact_email'] }}</span></li>
            @endif
            @if (!empty($event['contact_phone']))
                <li>📱 <span class="font-medium">{{ $event['contact_phone'] }}</span></li>
            @endif
            @if (empty($event['contact_email']) && empty($event['contact_phone']))
                <li class="text-slate-400">Kontak panitia belum tersedia.</li>
            @endif
        </ul>
    </section>
</aside>
