<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2, 100, 500),
            'currency_id' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->dateTimeBetween('-2 years', '+0 days'),
        ];
    }
}
