<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berat>
 */
class BeratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $weight = $this->faker->randomNumber(2, true);
        return [
            'min_weight' => $weight,
            'max_weight' => $weight + $this->faker->randomDigit(),
            'date' => $this->faker->date(),
        ];
    }
}
