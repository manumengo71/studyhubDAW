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

        LessonType::factory(4)->create();

        $lessonTypes = LessonType::all();

        foreach($lessonTypes as $lessonType) {
            $lessonType->name = match($lessonType->id) {
                1 => 'PDF',
                2 => 'Texto',
                3 => 'Video',
                4 => 'Imagen',
            };
            $lessonType->description = match($lessonType->id) {
                1 => 'Archivo PDF',
                2 => 'Archivo de texto',
                3 => 'Archivo de video',
                4 => 'Archivo de imagen',
            };
            $lessonType->save();
        }
    }
}
