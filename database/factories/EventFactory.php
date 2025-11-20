<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        $title = ucfirst(fake()->unique()->words(4, true));
        $start = Carbon::instance(fake()->dateTimeBetween(startDate: '+5 days', endDate: '+2 months'));
        $end = (clone $start)->addMinutes(fake()->numberBetween(60, 180));

        $locationType = fake()->randomElement(['offline', 'online', 'hybrid']);
        $locationAddress = $locationType === 'online'
            ? null
            : fake()->address();

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(4),
            'excerpt' => fake()->sentence(10),

            'organizer' => fake()->company(),
            'description' => fake()->paragraphs(3, true),
            'image' => fake()->imageUrl(width: 1200, height: 720, category: 'business', randomize: true),
            'benefits' => implode(', ', fake()->shuffle([
                'E-certificate',
                'Doorprize',
                'Networking',
                'Snack & coffee break',
                'Souvenir',
            ])),

            'agenda' => [
                ['time' => $start->copy()->subMinutes(30)->format('H:i'), 'title' => 'Registrasi peserta'],
                ['time' => $start->format('H:i'), 'title' => 'Opening dan sambutan'],
                ['time' => $start->copy()->addHour()->format('H:i'), 'title' => 'Sesi materi'],
                ['time' => $end->copy()->subMinutes(30)->format('H:i'), 'title' => 'Tanya jawab'],
            ],
            'date' => $start->toDateString(),
            'start_time' => $start->format('H:i'),
            'end_time' => $end->format('H:i'),

            'quota' => fake()->numberBetween(30, 200),
            'location_type' => $locationType,
            'location_address' => $locationAddress,
            'price' => fake()->boolean(30) ? 0 : fake()->numberBetween(50000, 250000),

            'contact_email' => fake()->boolean(70) ? fake()->companyEmail() : null,
            'contact_phone' => fake()->boolean(70) ? fake()->phoneNumber() : null,

            'status' => Arr::random(['draft', 'published', 'closed']),
        ];
    }
}
