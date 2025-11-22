<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileService
{
    public function update(User $user, array $data, ?UploadedFile $avatar = null): User
    {
        unset($data['avatar']);

        if ($avatar) {
            $path = $avatar->store('avatars', 'public');
            $data['avatar_url'] = $path;
        }

        $user->fill($data);
        $user->save();

        return $user->refresh();
    }
}
