<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseCategory>
 */
class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categories = ['Programación', 'Diseño', 'Marketing', 'Finanzas', 'Inglés', 'Cocina', 'Música', 'Fotografía', 'Idiomas', 'Negocios', 'Desarrollo Personal', 'Ofimática', 'Diseño Web', 'Desarrollo Web', 'Desarrollo Móvil', 'Videojuegos', 'Matemáticas', 'Ciencias', 'Humanidades', 'Ciencias Sociales', 'Estilo de Vida', 'Belleza', 'Salud', 'Fitness', 'Deportes', 'Otros'];

        return [
            'name' => $this->faker->randomElement($categories),
            'description' => fake()->sentence,
        ];
    }
}
