@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="max-w-xl mx-auto mt-6 md:mt-8">
        <div class="bg-white/90 rounded-3xl border border-slate-100 shadow-sm p-6 md:p-7 space-y-5">
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Selamat datang kembali</p>
                <h1 class="text-xl font-semibold text-slate-900">Login</h1>
                <p class="text-sm text-slate-600">Masuk untuk melanjutkan ke dashboard atau halaman event.</p>
            </div>

            @if (session('error'))
                <div class="rounded-2xl border border-red-100 bg-red-50 text-red-700 text-sm px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-2xl border border-red-100 bg-red-50 text-red-700 text-sm px-4 py-3 space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-700">
                        <label for="password">Password</label>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="w-full rounded-2xl border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 bg-white/80" />
                </div>

                <div class="flex items-center justify-between text-xs text-slate-600">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-sky-600 focus:ring-sky-400" />
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.75 rounded-full text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-500/30 transition">
                    Masuk
                </button>
            </form>

            <p class="text-xs text-center text-slate-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-sky-600">Daftar sekarang</a>
            </p>
        </div>
    </section>
@endsection
