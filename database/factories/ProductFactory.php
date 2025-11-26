<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'category_id' => Category::inRandomOrder()->value('id'),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10000, 2000000),
            'stock' => $this->faker->numberBetween(10, 100),
            'sell' => 0,
            'image' => 'default.png', // bisa diganti sesuai kebutuhan
        ];
    }
}
