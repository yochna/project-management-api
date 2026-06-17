<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id'  => Project::factory(),
            'title'       => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status'      => fake()->randomElement(['pending', 'in-progress', 'completed']),
            'assigned_to' => null,
            'due_date'    => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}