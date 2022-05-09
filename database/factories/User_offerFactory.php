<?php

namespace Database\Factories;

use App\Models\Joboffer;
use App\Models\User;
use App\Models\User_offer;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_offerFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User_offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => User::inRandomOrder()->value('id'),
            'id_offer' => Joboffer::inRandomOrder()->value('id'),
        ];
    }
}
