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
        $categories = Category::pluck('id')->toArray();
        return [
            'name' => $this->faker->sentence(rand(1, 3)),
            'image' => $this->faker->imageUrl(),
            'price' => rand(1,100),
            'description' => $this->faker->paragraph(rand(1, 6)),
            // 'category_id' => array_rand($categories),
            'category_id' => 1,
        ];
    }
}
