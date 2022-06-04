<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

use App\Models\Project;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Team Leader', 'Team Member']),
            'user_id'=> User::pluck('id')[$this->faker->numberBetween(1, User::count()-1)],
            'project_id'=> Project::pluck('id')[$this->faker->numberBetween(1, Project::count()-1)],
        ];
    }
}
