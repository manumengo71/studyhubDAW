<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Programación', 'Diseño', 'Marketing', 'Finanzas', 'Inglés', 'Cocina',
            'Música', 'Fotografía', 'Idiomas', 'Negocios', 'Desarrollo Personal',
            'Ofimática', 'Diseño Web', 'Desarrollo Web', 'Desarrollo Móvil', 'Videojuegos',
            'Matemáticas', 'Ciencias', 'Humanidades', 'Ciencias Sociales', 'Estilo de Vida',
            'Belleza', 'Salud', 'Fitness', 'Deportes', 'Otros'
        ];

        foreach ($categories as $category) {
            CourseCategory::factory()->categoryName($category)->create();
        }
    }
}
