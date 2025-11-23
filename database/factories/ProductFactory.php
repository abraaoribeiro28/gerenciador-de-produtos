<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name) . '-' . fake()->unique()->numerify('###'),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1500),
            'stock' => fake()->numberBetween(0, 250),
            'status' => fake()->boolean(85),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
