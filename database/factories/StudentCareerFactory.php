<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Career;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCareer>
 */
class StudentCareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {     
        return [
            "student_id" => fake()->unique()->numberBetween($min=1,$max=50),
            "career_id" => fake()->numberBetween($min=1,$max=5),
            "current_year"=>fake()->numberBetween($min=1,$max=3),
            "division"=>fake()->randomElement(["A","B"])
        ];
    }
}