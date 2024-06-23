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
        User::factory()->create([
            'name' => 'Jhon Flower',
            'email' => 'jhonf@gmail.com',
        ]);

        Task::factory()
            ->count(100)
            ->create();

        // Create notes
        $tasksCount = Task::count();
        Note::factory()
            ->count(200)
            ->create(
                [
                    'task_id' => function () use ($tasksCount) {
                        return rand(1, $tasksCount);
                    },
                ]
            );
    }
}
