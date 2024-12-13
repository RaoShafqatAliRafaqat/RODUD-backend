<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'created_by' => User::inRandomOrder()->first()->id, // Assign to a random user
            'updated_by' => User::inRandomOrder()->first()->id, // Assign to a random user
            'title' => $this->faker->name(),
            'location' => $this->faker->address(),
            'size' => $this->faker->randomElement(['10', '20', '30']),
            'weight' => $this->faker->randomElement(['10', '20', '30']),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'delivered']),
            'pickup_time' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'delivery_time' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
