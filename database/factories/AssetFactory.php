<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word(),
            'serial' => $this->faker->randomNumber(),
            'purchase' => $this->faker->date(),
            'start_use' => $this->faker->date(),
            'warranty_expiry' => $this->faker->date(),
            'degradation_in_years' => $this->faker->randomDigit(),
            'purchase_price' => 50.5,
            'current_value' => 55.55,
            'location' => $this->faker->word(),
            'description' => $this->faker->text()
        ];
    }
}
