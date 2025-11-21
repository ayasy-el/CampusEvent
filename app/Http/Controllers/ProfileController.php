<?php

namespace App\Http\Controllers;

use App\Services\FilamentAuthService;
use App\Services\ProfileService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct(
        private FilamentAuthService $filamentAuthService,
        private ProfileService $profileService
    ) {}

    public function show(): View
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();

        return view('pages.profile.show', compact('user'));
    }

    public function edit(): View
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();

        return view('pages.profile.edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $this->filamentAuthService->getAuthenticatedUser();

        abort_unless($user, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'program_studi' => ['nullable', 'string', 'max:255'],
            'angkatan' => ['nullable', 'string', 'max:50'],
            'no_telepon' => ['nullable', 'string', 'max:50'],
            'kota' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $this->profileService->update($user, $validated, $request->file('avatar'));

        return redirect()->route('profile')->with('status', 'Profile updated');
    }
}
