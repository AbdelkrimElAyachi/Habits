<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Habit;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users first
        $system = User::factory()->create([
            'name' => 'system',
            'email' => 'system@habit.com',
        ]);

        $user = User::factory()->create([
            'name' => 'someone',
            'email' => 'someone@gmail.com',
        ]);
    }
}
