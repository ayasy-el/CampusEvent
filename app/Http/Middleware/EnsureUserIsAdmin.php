<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Filament::auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role !== 'admin') {

            return redirect()
                ->route('home')
                ->with('error', 'Akses admin hanya untuk akun dengan peran admin.');
        }

        return $next($request);
    }
}
