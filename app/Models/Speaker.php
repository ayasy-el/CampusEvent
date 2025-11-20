<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'photo',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_speaker')
            ->withPivot('is_moderator');
    }
}
