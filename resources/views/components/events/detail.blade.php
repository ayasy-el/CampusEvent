@props(['event'])
@php use Illuminate\Support\Str; @endphp

<section class="space-y-5 md:space-y-6">
    <!-- Organizer & meta -->
    <div class="bg-white/90 rounded-3xl border border-slate-100 p-3.5 md:p-4 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div
                    class="w-15 h-15 rounded-2xl bg-gradient-to-tr from-sky-500 to-indigo-500 flex items-center justify-center text-white text-lg font-bold">
                    {{ strtoupper(substr($event['organizer'] ?? 'EV', 0, 2)) }}
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-900">
                        Diselenggarakan oleh {{ $event['organizer'] ?? '-' }}
                    </p>
                    @if (!empty($event['category']))
                        <p class="text-[11px] text-slate-500 capitalize">
                            {{ $event['category_icon'] ?? '📅' }} {{ $event['category'] }} • {{ $event['mode'] ?? 'hybrid' }}
                        </p>
                    @endif
                    @if (!empty($event['benefit']))
                    <span class="inline-flex mt-1 text-[11px] text-slate-500 items-center px-2.5 py-1 rounded-full bg-slate-50 border border-slate-200">
                        {{ $event['benefit'] }}
                    </span>
                @endif
                </div>
            </div>
            <div class="flex flex-wrap gap-2 text-[11px] text-slate-500">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-slate-50 border border-slate-200">
                    👥 {{ $event['registered'] ?? 0 }} terdaftar
                </span>
                <span
                    class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700">
                    {{ $event['quota_info'] ?? 'Kuota tersedia' }}
                </span>

            </div>
        </div>
    </div>

    <!-- Deskripsi -->
    <section
        class="bg-white/90 rounded-3xl border border-slate-100 p-3.5 md:p-4 lg:p-5 shadow-sm space-y-3 md:space-y-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-900">
            Deskripsi Event
        </h2>
        <div class="space-y-2 text-xs md:text-sm text-slate-600 leading-relaxed">
            {!! nl2br(e($event['description'] ?? 'Detail event belum tersedia.')) !!}
        </div>

        @php
            $benefits = array_filter(array_map('trim', explode(',', $event['benefit'] ?? '')));
        @endphp
        @if (!empty($benefits))
            <div class="grid gap-3 md:grid-cols-2 text-[11px] md:text-xs text-slate-600">
                <div class="space-y-1.5">
                    <p class="font-semibold text-slate-900 text-xs md:text-sm">Benefit Peserta:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($benefits as $b)
                            <li>{{ $b }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </section>

    <!-- Agenda -->
    <section
        class="bg-white/90 rounded-3xl border border-slate-100 p-3.5 md:p-4 lg:p-5 shadow-sm space-y-3 md:space-y-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-900">
            Agenda &amp; Rundown
        </h2>
        @if (!empty($event['agenda']))
            <div class="space-y-2 text-[11px] md:text-xs text-slate-600">
                @foreach ($event['agenda'] as $item)
                    <div class="flex gap-3">
                        <div class="w-20 md:w-24 font-semibold text-slate-800">
                            {{ $item['time'] ?? '-' }}
                        </div>
                        <p>{{ $item['title'] ?? '-' }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-[11px] md:text-xs text-slate-500">Agenda belum dicantumkan.</p>
        @endif
    </section>

    <!-- Pembicara -->
    <section
        class="bg-white/90 rounded-3xl border border-slate-100 p-3.5 md:p-4 lg:p-5 shadow-sm space-y-3 md:space-y-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-900">
            Pembicara &amp; Moderator
        </h2>
        @php $speakers = collect($event['speakers'] ?? []); @endphp
        @if ($speakers->isNotEmpty())
            <div class="grid gap-3 md:grid-cols-2">
                @foreach ($speakers as $speaker)
                    <div class="flex gap-3">
                        <div
                            class="w-12 h-12 min-w-12 rounded-2xl bg-slate-200 bg-cover bg-center"
                            @if (!empty($speaker['photo'])) style="background-image: url('{{ $speaker['photo'] }}')" @endif>
                        </div>
                        <div class="text-xs md:text-sm text-slate-700">
                            <p class="font-semibold text-slate-900">{{ $speaker['name'] }}</p>
                            @if (!empty($speaker['title']))
                                <p class="text-[11px] text-slate-500">{{ $speaker['title'] }}</p>
                            @endif
                            @if (!empty($speaker['bio']))
                                <p class="text-[11px] text-slate-500 mt-1">
                                    {{ Str::limit($speaker['bio'], 140) }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-[11px] md:text-xs text-slate-500">Pembicara belum ditambahkan.</p>
        @endif
    </section>

    <!-- Lokasi -->
    <section
        class="bg-white/90 rounded-3xl border border-slate-100 p-3.5 md:p-4 lg:p-5 shadow-sm space-y-3 md:space-y-4">
        <h2 class="text-sm md:text-base font-semibold text-slate-900">
            Lokasi &amp; Akses
        </h2>
        <div class="space-y-2 text-xs md:text-sm text-slate-600">
            <p class="font-semibold text-slate-900 capitalize">
                @if (($event['location_type'] ?? 'hybrid') === 'online')
                    Online Event
                @else
                    {{ $event['location'] ?? 'Lokasi belum ditentukan' }}
                @endif
            </p>
            <p class="text-[11px] md:text-xs text-slate-500">
                Mode: {{ ucfirst($event['mode'] ?? '-') }}
            </p>
        </div>
    </section>
</section>
