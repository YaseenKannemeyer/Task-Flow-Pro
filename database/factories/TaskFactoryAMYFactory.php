<?php

namespace Database\Factories;

use App\Models\CategoryAMY;
use App\Models\TaskAMY;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TaskFactoryAMY extends Factory
{
    protected $model = TaskAMY::class;

    public function definition(): array
    {
        $status   = $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']);
        $priority = $this->faker->randomElement(['low', 'medium', 'high', 'critical']);
        $dueDate  = $this->faker->dateTimeBetween('-1 week', '+4 weeks');

        $users    = User::pluck('id')->toArray();
        $cats     = CategoryAMY::pluck('id')->toArray();

        return [
            'title'       => ucwords($this->faker->words(rand(3, 7), true)),
            'description' => $this->faker->optional(0.8)->paragraphs(2, true),
            'status'      => $status,
            'priority'    => $priority,
            'category_id' => !empty($cats) ? $this->faker->randomElement($cats) : null,
            'created_by'  => $this->faker->randomElement($users),
            'assigned_to' => $this->faker->optional(0.7)->randomElement($users),
            'due_date'    => $dueDate,
            'started_at'  => in_array($status, ['in_progress', 'completed'])
                                ? Carbon::instance($dueDate)->subDays(rand(1, 5))
                                : null,
            'completed_at' => $status === 'completed'
                                ? Carbon::instance($dueDate)->subDay()
                                : null,
            'reminder_sent' => $this->faker->boolean(20),
            'is_archived'   => $this->faker->boolean(10),
        ];
    }

    /** State: create overdue task */
    public function overdue(): static
    {
        return $this->state(['due_date' => now()->subDays(rand(1, 14)), 'status' => 'pending']);
    }

    /** State: create completed task */
    public function completed(): static
    {
        return $this->state([
            'status'       => 'completed',
            'completed_at' => now()->subDays(rand(1, 7)),
        ]);
    }
}
