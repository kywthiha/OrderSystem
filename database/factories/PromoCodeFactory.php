<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromoCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'description' => $this->faker->text(),
            'discount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
