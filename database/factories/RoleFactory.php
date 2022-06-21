<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

use App\Models\Teams;

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
            'team_id'=> Teams::pluck('id')[$this->faker->numberBetween(1, Teams::count()-1)],
        ];
    }
}
