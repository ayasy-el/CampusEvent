<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectAuthenticatedUser();
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = (bool) $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email atau password tidak sesuai.',
                ]);
        }

        $request->session()->regenerate();

        return $this->redirectAuthenticatedUser();
    }

    public function showRegisterForm(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectAuthenticatedUser();
        }

        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'nrp' => ['required', 'string', 'max:255', 'unique:users,nrp'],
            'program_studi' => ['required', 'string', 'max:255'],
            'angkatan' => ['required', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:255'],
            'kota' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nrp' => $data['nrp'] ?? null,
            'program_studi' => $data['program_studi'] ?? null,
            'angkatan' => $data['angkatan'] ?? null,
            'no_telepon' => $data['no_telepon'] ?? null,
            'kota' => $data['kota'] ?? null,
            'bio' => $data['bio'] ?? null,
            'role' => 'mahasiswa',
            'password' => $data['password'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectAuthenticatedUser();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    protected function redirectAuthenticatedUser()
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return redirect()->intended(route('filament.admin.pages.dashboard'));
        }

        return redirect()->intended(route('events'));
    }
}
