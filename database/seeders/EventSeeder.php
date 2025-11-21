<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $speakers = Speaker::all();
        $users = User::where('role', '!=', 'admin')->get();

        // Pastikan minimal ada beberapa user untuk menjadi peserta
        if ($users->count() < 10) {
            $users = $users->concat(User::factory(10)->create());
        }

        Event::factory(12)->create()->each(function (Event $event) use ($categories, $speakers, $users) {
            if ($categories->isNotEmpty()) {
                $event->categories()->sync(
                    $categories->random(rand(1, min(3, $categories->count())))->pluck('id')->all()
                );
            }

            if ($speakers->isNotEmpty()) {
                $picked = $speakers->random(rand(1, min(3, $speakers->count())));
                $pivot = [];
                foreach ($picked as $speaker) {
                    $pivot[$speaker->id] = ['is_moderator' => (bool) rand(0, 1)];
                }
                $event->speakers()->sync($pivot);
            }

            $attendees = $users->shuffle()->take(rand(5, min(20, $users->count())));
            $event->attendees()->sync($attendees->pluck('id')->all());
        });
    }
}
