<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['sell', 'buy']),
            'date' => $this->faker->dateTime,
            'amount' => $this->faker->numberBetween(1, 20),
            'value' =>$this->faker->randomFloat(2, 100, 500),
            'user_id' => 1,
            'currency_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
