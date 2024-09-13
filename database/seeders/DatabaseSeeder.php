<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Room;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Order::factory()->for($user)->create();
        Room::factory(2)->create();
        User::factory()->create([
            'email' => 'user1@example.com',
        ]);
        User::factory()->create([
            'email' => 'user2@example.com',
        ]);
    }
}
