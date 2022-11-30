<?php

namespace Database\Factories;

use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $packType = $this->faker->randomElement(Pack::PACK_TYPE);
        return [
            'pack_name' => $this->faker->name(),
            'pack_description' => $this->faker->text(),
            'pack_type' => $packType,
            'total_credit' => $packType == Pack::PACK_TYPE_UNLIMITED ? 0 :  $this->faker->numberBetween(1, 100),
            'tag_name' => $this->faker->randomElement(Pack::TAG_NAME),
            'validity_month' => $this->faker->numberBetween(0, 50),
            'pack_price' => $this->faker->randomFloat(2, 0, 1000),
            'newbie_first_attend' => $this->faker->boolean(),
            'newbie_addition_credit' => $this->faker->numberBetween(0, 1),
            'newbie_note' => $this->faker->text(),
            'pack_alias' => $this->faker->unique()->word,
        ];
    }
}
