@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <section class="max-w-xl mx-auto mt-6 md:mt-8">
        <div class="bg-white/90 dark:bg-slate-800/90 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-6 md:p-7 space-y-5">
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400 dark:text-slate-500">Akun baru</p>
                <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Daftar</h1>
                <p class="text-sm text-slate-600 dark:text-slate-400">Lengkapi data akun & profil mahasiswa untuk mendaftar event.</p>
            </div>

            @if ($errors->any())
                <div class="rounded-2xl border border-red-100 dark:border-red-800 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm px-4 py-3 space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="space-y-4" id="registerForm">
                @csrf

                <div class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400">
                    <div class="flex items-center gap-1">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center font-semibold text-white bg-sky-600"
                            data-step-indicator="1">1</div>
                        <span>Data Akun</span>
                    </div>
                    <span class="text-slate-400 dark:text-slate-500">—</span>
                    <div class="flex items-center gap-1">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center font-semibold text-white bg-slate-300 dark:bg-slate-600"
                            data-step-indicator="2">2</div>
                        <span>Profil Mahasiswa</span>
                    </div>
                </div>

                <div class="space-y-4" data-step="1">
                    <div class="space-y-1.5">
                        <label for="name" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                    </div>

                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 pr-10 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                            <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300">
                                <svg class="w-5 h-5 eye-off" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                                <svg class="w-5 h-5 eye-on hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Minimal 8 karakter.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Konfirmasi Password
                            <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 pr-10 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                            <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300">
                                <svg class="w-5 h-5 eye-off" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                                <svg class="w-5 h-5 eye-on hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
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
                        <label for="nrp" class="text-xs font-semibold text-slate-700 dark:text-slate-300">NRP <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nrp" name="nrp" value="{{ old('nrp') }}" required
                            class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label for="program_studi" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Program Studi <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="program_studi" name="program_studi" value="{{ old('program_studi') }}"
                                required
                                class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                        </div>
                        <div class="space-y-1.5">
                            <label for="angkatan" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Angkatan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" required
                                class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label for="no_telepon" class="text-xs font-semibold text-slate-700 dark:text-slate-300">No. Telepon</label>
                            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                        </div>
                        <div class="space-y-1.5">
                            <label for="kota" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Kota Domisili</label>
                            <input type="text" id="kota" name="kota" value="{{ old('kota') }}"
                                class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="bio" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Bio Singkat</label>
                        <textarea id="bio" name="bio" rows="3"
                            class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80">{{ old('bio') }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="button" id="prevStep"
                            class="inline-flex items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                            Kembali
                        </button>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-500/30 transition">
                            Daftar
                        </button>
                    </div>
                </div>
            </form>

            <p class="text-xs text-center text-slate-600 dark:text-slate-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-sky-600 dark:text-sky-400">Masuk</a>
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOff = btn.querySelector('.eye-off');
            const eyeOn = btn.querySelector('.eye-on');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOff.classList.add('hidden');
                eyeOn.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOff.classList.remove('hidden');
                eyeOn.classList.add('hidden');
            }
        }

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
