<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatosDePruebaProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(UsersProductionSeeder::class);
        /** El primero llama automaticamente a profile */


    }
}
