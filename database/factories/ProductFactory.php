<?php

namespace Database\Factories;

use App\Models\Product;
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

    //  protected $model=Product::class;

    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'price'=>$this->faker->numberBetween(100,1000),
            'category_id'=>$this->faker->numberBetween(1,3),
            'stock'=>$this->faker->numberBetween(100,200),
        ];
    }
}
