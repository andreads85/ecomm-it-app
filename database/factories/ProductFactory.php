<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->ean8,
            'name' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 0.01, 999),
            'quantity' => $this->faker->numberBetween(1,100),
            'image' => 'https://picsum.photos/500/500?random='. mt_rand(1, 55000)
        ];
    }
}
