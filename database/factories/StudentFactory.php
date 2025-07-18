<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Career;

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
        $careerMax = Career::max("id");

        return [
            "career_id" => fake()->numberBetween($min=1,$max=$careerMax),
            "dni"=>fake()->randomNumber($nbDigits=8,$strict=true),
            "name"=>fake()->firstName()." ".fake()->lastName(),
            "birthDate"=>fake()->date(),
            "current_year"=>fake()->numberBetween($min=1,$max=$careerMax),
            "division"=>fake()->randomElement(["A","B"])
        ];
    }
}
