<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence,
            'note' => $this->faker->paragraph,
            'task_id' => Task::factory(),
            'attachments' => json_encode([
                'https://test.com/test.pdf',
                'https://test.com/test.jpg',
                'https://test.com/test.xlsx',
            ])
        ];
    }
}
