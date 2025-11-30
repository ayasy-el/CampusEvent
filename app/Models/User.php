<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'nrp',
        'program_studi',
        'angkatan',
        'no_telepon',
        'kota',
        'bio',
        'avatar_url',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarUrlAttribute(?string $value): ?string
    {
        $value = $this->attributes['avatar_url'] ?? null;

        if (! $value) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', '/'])) {
            return $value;
        }

        $disk = config('filament.default_filesystem_disk', config('filesystems.default'));

        return Storage::disk($disk)->url($value);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'events_user')
            ->withTimestamps();
    }
}
