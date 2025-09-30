<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "dni"=>fake()->randomNumber($nbDigits=8,$strict=true),
            "name"=>fake()->firstName()." ".fake()->lastName(),
            "birthDate"=>fake()->date(),
            "current_year"=>fake()->numberBetween($min=1,$max=3),
            "division"=>fake()->randomElement(["A","B"])
        ];
    }
}
