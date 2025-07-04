<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $student = Student::max("id");
        
        return [
            "student_idd" => fake()->unique()->numberBetween($min= 1,$max= $student),
            "year"=>fake()->numberBetween($min=1,$max=6)
        ];
    }
}
