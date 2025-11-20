<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Kampus',
            'email' => 'admin@campusevent.id',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::factory(25)->create();
    }
}
