<?php

namespace App\Services;

use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\Authenticatable;

class FilamentAuthService
{
    public function getAuthenticatedUser(): ?Authenticatable
    {
        $user = Filament::auth()->user();

        return $user ? $user->fresh() : null;
    }
}
