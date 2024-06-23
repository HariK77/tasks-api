<?php

namespace Database\Seeders;

use App\Models\Note;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Hari',
            'email' => 'hari@gmail.com',
        ]);

        Task::factory()
            ->count(10)
            ->has(Note::factory()->count(rand(1, 5)), 'notes')
            ->create();

        // Create tasks without notes
        Task::factory()
            ->count(10)
            ->create();
    }
}
