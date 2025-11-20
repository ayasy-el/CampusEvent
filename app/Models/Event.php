<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

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
}
