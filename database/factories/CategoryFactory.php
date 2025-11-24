<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Technology',
            'Sports',
            'Fashion',
            'Food',
            'Travel',
            'Education',
            'Health',
            'Gaming',
            'Music',
            'Movies',
            'Business',
            'Finance',
            'Art',
            'Books',
            'Lifestyle',
            'Science',
            'Automotive',
            'Pets',
            'Home',
            'Photography'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
            'user_id' => 2
        ];
    }
}
