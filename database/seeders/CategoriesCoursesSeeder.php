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
        $urls = [
            'https://i.postimg.cc/sXxNm99k/desarrollo.jpg',
            'https://i.postimg.cc/GpxbcGXf/lohp-category-business-v2.jpg',
            'https://i.postimg.cc/90r2tSc3/lohp-category-design-v2.jpg',
            'https://i.postimg.cc/SsQkjR5x/lohp-category-it-and-software-v2.jpg',
            'https://i.postimg.cc/pr4H0Zdm/lohp-category-marketing-v2.jpg',
            'https://i.postimg.cc/P5ZtRBYT/lohp-category-music-v2.jpg',
            'https://i.postimg.cc/ydfBRB4X/lohp-category-personal-development-v2.jpg',
            'https://i.postimg.cc/6QX9JYfR/lohp-category-photography-v2.jpg',
        ];

        foreach ($categories as $category) {
            CourseCategory::factory()->categoryName($category)->create();
            $category = CourseCategory::where('name', $category)->first();
            $category->addMediaFromUrl($urls[array_rand($urls)])->toMediaCollection('images_categories');
        }
    }
}
