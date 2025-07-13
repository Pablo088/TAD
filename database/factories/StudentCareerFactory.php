<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Career;

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
        $student = Student::max("id");
        $careerMax = Career::max("id");
        $careerMin = Career::min("id");

        return [
            "student_idc" => fake()->numberBetween($min=1,$max=$student),
            "career_idc" => fake()->numberBetween($min=1,$max=$careerMax),
            "current_year"=>fake()->numberBetween($min=$careerMin,$max=$careerMax),
            "division"=>fake()->randomElement(["A","B"])
        ];
    }
}
