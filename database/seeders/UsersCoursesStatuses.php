<?php

namespace Database\Seeders;

use App\Models\User_course_status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersCoursesStatuses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => '¡Estréname!', 'description' => 'El usuario no ha comenzado el curso.'],
            ['name' => 'En progreso', 'description' => 'El usuario está actualmente realizando el curso.'],
            ['name' => 'Completado', 'description' => 'El usuario ha completado el curso.'],
        ];

        foreach ($statuses as $status) {
            User_course_status::create($status);
        }
    }
}
