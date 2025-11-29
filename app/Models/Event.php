<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',

        'organizer',
        'description',
        'image',
        'benefits',

        'agenda',
        'date',
        'start_time',
        'end_time',

        'quota',
        'location_type',
        'location_address',
        'price',

        'contact_email',
        'contact_phone',

        'status',
    ];

    protected $casts = [
        'agenda'        => 'array',
        'date'          => 'date',
        'start_time'    => 'datetime:H:i',
        'end_time'      => 'datetime:H:i',
        'quota'         => 'integer',
        'price'         => 'integer',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker')
            ->withPivot('is_moderator');
    }

    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'events_user')
            ->withPivot('created_at', 'updated_at')
            ->withTimestamps();
    }
}
