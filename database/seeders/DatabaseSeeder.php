<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\Conference;
use App\Models\Order;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Talk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Order::factory()->for($user)->create();
        Room::factory(2)
            ->sequence(
                ['slug' => 'one'],
                ['slug' => 'two'],
            )
            ->create();
        User::factory(2)
            ->sequence(
                ['email' => 'user1@example.com'],
                ['email' => 'user2@example.com'],
            )
            ->create();
        Venue::factory(200)->create();
        Speaker::factory(3)->create();
        Talk::factory(10)->create();

        $conference = Conference::factory()->create();
        Attendee::factory(300)->forConference($conference)->create();

    }
}
