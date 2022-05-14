<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Project;
use App\Models\Phase;

class TaskFactory extends Factory
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
            'todo' => $this->faker->name(), 
            'due_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'removed' => $this->faker->numberBetween($min = 0, $max = 1),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'project_id'=> Project::pluck('id')[$this->faker->numberBetween(1, Project::count()-1)],

            'user_id'=> User::pluck('id')[$this->faker->numberBetween(1, User::count()-1)],
            'phase_id' => Phase::pluck('id')[$this->faker->numberBetween(1, Phase::count()-1)],
            


        ];
    }
}
