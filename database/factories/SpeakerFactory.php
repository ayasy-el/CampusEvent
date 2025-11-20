<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'title' => fake()->jobTitle(),
            'bio' => fake()->paragraphs(2, true),
            'photo' => fake()->imageUrl(width: 600, height: 600, category: 'people', randomize: true) . '?id=' . Str::random(6),
        ];
    }
}
