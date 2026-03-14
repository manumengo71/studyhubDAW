<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(CreditCardTypeSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategoriesCoursesSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(UsersCoursesStatuses::class);
        $this->call(LessonsTypesSeeder::class);
        $this->call(LessonSeeder::class);
    }
}
