@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <section class="max-w-xl mx-auto mt-6 md:mt-8">
        <div class="bg-white/90 rounded-3xl border border-slate-100 shadow-sm p-6 md:p-7 space-y-5">
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Akun baru</p>
                <h1 class="text-xl font-semibold text-slate-900">Daftar</h1>
                <p class="text-sm text-slate-600">Lengkapi data akun & profil mahasiswa untuk mendaftar event.</p>
            </div>

            @if ($errors->any())
                <div class="rounded-2xl border border-red-100 bg-red-50 text-red-700 text-sm px-4 py-3 space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="space-y-4" id="registerForm">
                @csrf

                <div class="flex items-center gap-2 text-xs text-slate-600">
                    <div class="flex items-center gap-1">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center font-semibold text-white bg-sky-600"
                            data-step-indicator="1">1</div>
                        <span>Data Akun</span>
                    </div>
                    <span class="text-slate-400">—</span>
                    <div class="flex items-center gap-1">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center font-semibold text-white bg-slate-300"
                            data-step-indicator="2">2</div>
                        <span>Profil Mahasiswa</span>
                    </div>
                </div>

                <div class="space-y-4" data-step="1">
                    <div class="space-y-1.5">
                        <label for="name" class="text-xs font-semibold text-slate-700">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-semibold text-slate-700">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                    </div>

                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-semibold text-slate-700">Password <span
                                class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" required
                            class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                        <p class="text-[11px] text-slate-500">Minimal 8 karakter.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-xs font-semibold text-slate-700">Konfirmasi Password
                            <span class="text-red-500">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="nextStep"
                            class="inline-flex items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-500/30 transition">
                            Lanjut
                        </button>
                    </div>
                </div>

                <div class="space-y-4 hidden" data-step="2">
                    <div class="space-y-1.5">
                        <label for="nrp" class="text-xs font-semibold text-slate-700">NRP <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nrp" name="nrp" value="{{ old('nrp') }}" required
                            class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label for="program_studi" class="text-xs font-semibold text-slate-700">Program Studi <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="program_studi" name="program_studi" value="{{ old('program_studi') }}"
                                required
                                class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                        </div>
                        <div class="space-y-1.5">
                            <label for="angkatan" class="text-xs font-semibold text-slate-700">Angkatan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" required
                                class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label for="no_telepon" class="text-xs font-semibold text-slate-700">No. Telepon</label>
                            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                        </div>
                        <div class="space-y-1.5">
                            <label for="kota" class="text-xs font-semibold text-slate-700">Kota Domisili</label>
                            <input type="text" id="kota" name="kota" value="{{ old('kota') }}"
                                class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="bio" class="text-xs font-semibold text-slate-700">Bio Singkat</label>
                        <textarea id="bio" name="bio" rows="3"
                            class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80">{{ old('bio') }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="button" id="prevStep"
                            class="inline-flex items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                            Kembali
                        </button>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-500/30 transition">
                            Daftar
                        </button>
                    </div>
                </div>
            </form>

            <p class="text-xs text-center text-slate-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-sky-600">Masuk</a>
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function() {
            const form = document.getElementById('registerForm');
            const steps = Array.from(document.querySelectorAll('[data-step]'));
            const indicators = Array.from(document.querySelectorAll('[data-step-indicator]'));
            if (!form || steps.length === 0) return;

            let current = 1;

            function showStep(step) {
                current = step;
                steps.forEach(section => {
                    const isActive = Number(section.dataset.step) === step;
                    section.classList.toggle('hidden', !isActive);
                    // Toggle required on inputs/textarea in inactive steps
                    section.querySelectorAll('input, textarea, select').forEach(input => {
                        if (!isActive) {
                            input.dataset.prevRequired = input.required ? '1' : '0';
                            input.required = false;
                        } else if (input.dataset.prevRequired === '1' || input.required) {
                            input.required = true;
                        }
                    });
                });

                indicators.forEach(indicator => {
                    const idx = Number(indicator.dataset.stepIndicator);
                    indicator.classList.toggle('bg-sky-600', idx === step);
                    indicator.classList.toggle('bg-slate-300', idx !== step);
                });
            }

            const nextBtn = document.getElementById('nextStep');
            const prevBtn = document.getElementById('prevStep');

            nextBtn?.addEventListener('click', () => {
                const step1 = steps.find(s => Number(s.dataset.step) === 1);
                if (!step1) return;
                if (!step1.querySelector('input:invalid')) {
                    showStep(2);
                } else {
                    step1.querySelector('input:invalid')?.reportValidity();
                }
            });

            prevBtn?.addEventListener('click', () => showStep(1));

            showStep(current);
        })();
    </script>
@endpush
