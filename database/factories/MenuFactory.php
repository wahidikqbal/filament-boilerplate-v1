<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->numberBetween(5000, 50000); // hanya integer

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'price' => $price,
            'discount_price' => $this->faker->numberBetween(1000, $price - 1000),
            'status' => $this->faker->randomElement(['available', 'out_of_stock']),
        ];
    }
}
