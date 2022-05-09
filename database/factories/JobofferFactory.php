<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobofferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idUser' => User::inRandomOrder()->value('id'),
            'status' => $this->faker->boolean(),
            'nameOffer' => $this->faker->jobTitle(),
        ];
    }
}
