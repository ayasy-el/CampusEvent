@props(['event', 'user'])

<aside class="space-y-4 md:space-y-5 md:sticky md:top-20 h-max">
    @if (!empty($event['image']))
    <div class="overflow-hidden rounded-3xl border border-slate-100 shadow-sm shadow-slate-200/60">
        <img src="{{ $event['image'] }}" alt="{{ $event['title'] ?? 'Poster event' }}" class="w-full object-contain">
    </div>
    @endif

    <section class="bg-white rounded-3xl border border-slate-100 shadow-md shadow-slate-200/80 p-4 md:p-5 space-y-3">
        <div class="flex items-center justify-between">
            <p class="text-xs font-semibold text-slate-900">
                {{ $event['date_display'] ?? $event['date']?->translatedFormat('l, d F Y') }}
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
                {{ $event['quota'] > 0 ? 'Kuota peserta: maks.' . $event['quota'] . ' • ' : '' }}
                Saat ini {{ $event['registered'] ?? 0 }} sudah terdaftar.
            </p>
        </div>

        @php
        $registrationStatus = $event['registration_status'] ?? ($event['card_status'] ?? 'open');
        $isRegistered = $event['is_registered'] ?? false;
        $isAdmin = $user && $user->role === 'admin';
        $isMahasiswa = $user && $user->role === 'mahasiswa';
        $isQuotaFull = ($event['quota'] ?? 0) > 0 && ($event['registered'] ?? 0) >= ($event['quota'] ?? 0);
        $canCancel = $isMahasiswa && $isRegistered;

        $buttonLabel = match (true) {
        $isRegistered => 'Sudah Terdaftar',
        $isQuotaFull || $registrationStatus === 'full' => 'Kuota Penuh',
        in_array($registrationStatus, ['finished', 'closed']) => 'Pendaftaran Ditutup',
        default => 'Daftar Sekarang',
        };

        $disabled =
        $isAdmin || $isRegistered || $isQuotaFull || in_array($registrationStatus, ['finished', 'closed']);
        @endphp

        <div class="mt-2">
            @if (!$user)
            <a href="{{ route('login') }}"
                class="block text-center w-full px-4 py-2.5 rounded-full text-sm font-semibold bg-sky-500 text-white shadow-lg shadow-sky-500/30 hover:bg-sky-600">
                Login untuk daftar
            </a>
            @elseif ($canCancel)
            <form method="POST" action="{{ route('events.cancel', ['slug' => $event['slug']]) }}"
                class="flex flex-col gap-2">
                @csrf
                @method('DELETE')
                <p class="text-[11px] text-emerald-700 text-center">
                    Kamu sudah terdaftar pada event ini.
                </p>
                <button type="submit"
                    class="cursor-pointer w-full px-4 py-2.5 rounded-full text-sm font-semibold border border-red-200 text-red-600 bg-red-50 hover:bg-red-100">
                    Batalkan Pendaftaran
                </button>
            </form>
            @elseif ($disabled)
            <button type="button"
                class="w-full px-4 py-2.5 rounded-full text-sm font-semibold cursor-not-allowed bg-slate-200 text-slate-500 shadow-none">
                {{ $buttonLabel }}
            </button>
            @if ($isAdmin)
            <p class="mt-1 text-[11px] text-slate-500 text-center">Daftar hanya untuk akun mahasiswa.</p>
            @elseif ($isRegistered)
            <p class="mt-1 text-[11px] text-emerald-600 text-center">Kamu sudah terdaftar pada event ini.</p>
            @endif
            @elseif ($isMahasiswa)
            <form method="POST" action="{{ route('events.register', ['slug' => $event['slug']]) }}">
                @csrf
                <button type="submit"
                    class="cursor-pointer w-full px-4 py-2.5 rounded-full text-sm font-semibold bg-sky-500 text-white shadow-lg shadow-sky-500/30 hover:bg-sky-600">
                    {{ $buttonLabel }}
                </button>
            </form>
            @endif
        </div>
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