<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Project;


class PhaseFactory extends Factory
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
           
            'deleted_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'project_id'=> Project::pluck('id')[$this->faker->numberBetween(1, Project::count()-1)],
        ];
    }
}
