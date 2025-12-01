@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="max-w-xl mx-auto mt-6 md:mt-8">
        <div class="bg-white/90 dark:bg-slate-800/90 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-6 md:p-7 space-y-5">
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400 dark:text-slate-500">Selamat datang kembali</p>
                <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Login</h1>
                <p class="text-sm text-slate-600 dark:text-slate-400">Masuk untuk melanjutkan ke dashboard atau halaman event.</p>
            </div>

            @if (session('error'))
                <div class="rounded-2xl border border-red-100 dark:border-red-800 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-2xl border border-red-100 dark:border-red-800 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm px-4 py-3 space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-700 dark:text-slate-300">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-2xl border border-slate-200 dark:border-slate-600 px-3.5 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80 dark:bg-slate-700/80" />
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-700 dark:text-slate-300">
                        <label for="password">Password</label>
                    </div>
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
                </div>

                <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-400">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 dark:border-slate-600 text-sky-600 focus:ring-sky-400 dark:bg-slate-700" />
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-500/30 transition">
                    Masuk
                </button>
            </form>

            <p class="text-xs text-center text-slate-600 dark:text-slate-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-sky-600 dark:text-sky-400">Daftar sekarang</a>
            </p>
        </div>
    </section>

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
    </script>
@endsection
