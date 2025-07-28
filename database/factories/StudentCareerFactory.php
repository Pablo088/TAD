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
        $student = Student::max("id");
        $career = Career::max("id");
     
        return [
            "student_id" => fake()->numberBetween($min=1,$max=$student),
            "career_id" => fake()->numberBetween($min=1,$max=$career),
            "current_year"=>fake()->numberBetween($min=1,$max=3),
            "division"=>fake()->randomElement(["A","B"])
        ];
    }
}