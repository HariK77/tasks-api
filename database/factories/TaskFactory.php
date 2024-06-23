<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = $this->faker->dateTimeBetween('-2 weeks', '+5 weeks');
        $due_date = Carbon::parse($start_date)->addDays(rand(1, 15));

        return [
            'subject' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $start_date->format('Y-m-d'),
            'due_date' => $due_date->format('Y-m-d'),
            'status' => $this->faker->randomElement(TaskStatus::all()),
            'priority' => $this->faker->randomElement(TaskPriority::all()),
        ];
    }
}
