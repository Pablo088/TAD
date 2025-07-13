<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "dias_clases"=>10,//es para que el usuario pueda probar rapidamente los filtros en la vista "menu"
            "promedio_promocion"=>80,
            "promedio_regularidad"=>60,
            "edad_minima"=>17//edad minima para entrar a la facultad o universidad
        ];
    }
}
