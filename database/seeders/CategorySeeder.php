<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Workshop',
            'Seminar',
            'Kompetisi',
            'Webinar',
            'Pelatihan',
            'Karir & Magang',
            'Komunitas',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        // Tambahan variasi acak
        Category::factory(3)->create();
    }
}
