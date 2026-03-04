<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Programación', 'Diseño', 'Marketing', 'Finanzas', 'Inglés', 'Cocina',
            'Música', 'Fotografía', 'Idiomas', 'Negocios', 'Desarrollo Personal',
            'Ofimática', 'Diseño Web', 'Desarrollo Web', 'Desarrollo Móvil', 'Videojuegos',
            'Matemáticas', 'Ciencias', 'Humanidades', 'Ciencias Sociales', 'Estilo de Vida',
            'Belleza', 'Salud', 'Fitness', 'Deportes', 'Otros'
        ];

        return [
            'name' => $this->faker->randomElement($categories),
            'description' => $this->faker->sentence, // Cambiado de fake()->sentence a $this->faker->sentence
        ];
    }
}
