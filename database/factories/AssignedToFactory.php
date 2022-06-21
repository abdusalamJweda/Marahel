<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Phase;
use App\Models\Teams;

class AssignedToFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'phase_id' => Phase::pluck('id')[$this->faker->numberBetween(1, Phase::count()-1)],
            'team_id' => Teams::pluck('id')[$this->faker->numberBetween(1, Phase::count()-1)],
        ];
    }
}
