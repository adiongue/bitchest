<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' =>  $this->faker->firstName,
            'lastname' =>  $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'is_admin' => $this->faker->boolean,
            'address' =>  $this->faker->address,
            'country' =>  $this->faker->country,
        ];
    }
}
