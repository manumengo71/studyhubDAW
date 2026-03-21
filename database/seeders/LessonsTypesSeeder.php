<?php

namespace Database\Seeders;

use App\Models\LessonType;
use Illuminate\Database\Seeder;

class LessonsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        LessonType::factory(5)->create();

        $lessonTypes = LessonType::all();

        foreach($lessonTypes as $lessonType) {
            $lessonType->name = match($lessonType->id) {
                1 => 'Default',
                2 => 'PDF',
                3 => 'Video',
                4 => 'Imagen',
                5 => 'Personalizado'
            };
            $lessonType->description = match($lessonType->id) {
                1 => 'Sin asignar',
                2 => 'Archivo PDF',
                3 => 'Archivo de video',
                4 => 'Archivo de imagen',
                5 => 'Archivo personalizado'
            };
            $lessonType->save();
        }
    }
}
