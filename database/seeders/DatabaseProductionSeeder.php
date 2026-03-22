<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(CreditCardTypeSeeder::class);
        $this->call(CategoriesCoursesSeeder::class);
        $this->call(UsersCoursesStatuses::class);
        $this->call(LessonsTypesSeeder::class);
    }
}
