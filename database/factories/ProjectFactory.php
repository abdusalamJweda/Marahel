<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->name(), //$this->faker->unique()->safeEmail(),
            'due_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'total_phases' => $this->faker->randomDigit(), 
            'total_tasks' => $this->faker->randomDigit(), 
            'removed' => $this->faker->numberBetween($min = 0, $max = 1),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'user_id'=> User::pluck('id')[$this->faker->numberBetween(1, User::count()-1)],
        ];
    }
}
