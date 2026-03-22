<?php

namespace Database\Seeders;

use Database\Factories\UsersProductionFactory;
use Database\Factories\UsersProfileProductionFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        static $count = 0;
        $users = [
            [
                'username' => 'manuelcand04',
                'email' => 'manuelcand04@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'mariaperez89',
                'email' => 'mariaperez89@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'juanmartinez',
                'email' => 'juanmartinez@example.com',
                'email_verified_at' => null,
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'lucia_garcia',
                'email' => 'lucia_garcia@example.com',
                'email_verified_at' => null,
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'pablo_martin',
                'email' => 'pablo_martin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'anacastillo',
                'email' => 'anacastillo@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'davidjimenez',
                'email' => 'davidjimenez@example.com',
                'email_verified_at' => null,
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'elenaruiz',
                'email' => 'elenaruiz@example.com',
                'email_verified_at' => null,
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'joseantonio_vergara',
                'email' => 'josevergara@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'remember_token' => Str::random(10),
            ],
        ];

        $userProfiles = [
            [
                'name' => 'Manuel',
                'surname' => 'Candelario',
                'second_surname' => 'González',
                'birthdate' => now()->subYears(25),
                'biological_gender' => 'Masculino'
            ],
            [
                'name' => 'María',
                'surname' => 'Pérez',
                'second_surname' => 'García',
                'birthdate' => now()->subYears(30),
                'biological_gender' => 'Femenino'
            ],
            [
                'name' => 'Juan',
                'surname' => 'Martínez',
                'second_surname' => 'López',
                'birthdate' => now()->subYears(28),
                'biological_gender' => 'Masculino'
            ],
            [
                'name' => 'Lucía',
                'surname' => 'García',
                'second_surname' => 'Fernández',
                'birthdate' => now()->subYears(27),
                'biological_gender' => 'Femenino'
            ],
            [
                'name' => 'Pablo',
                'surname' => 'Martín',
                'second_surname' => 'Hernández',
                'birthdate' => now()->subYears(33),
                'biological_gender' => 'Masculino'
            ],
            [
                'name' => 'Ana',
                'surname' => 'Castillo',
                'second_surname' => 'Sánchez',
                'birthdate' => now()->subYears(29),
                'biological_gender' => 'Femenino'
            ],
            [
                'name' => 'David',
                'surname' => 'Jiménez',
                'second_surname' => 'Martínez',
                'birthdate' => now()->subYears(31),
                'biological_gender' => 'Masculino'
            ],
            [
                'name' => 'Elena',
                'surname' => 'Ruiz',
                'second_surname' => 'Díaz',
                'birthdate' => now()->subYears(26),
                'biological_gender' => 'Femenino'
            ],
            [
                'name' => 'Joseantonio',
                'surname' => 'Vergara',
                'second_surname' => 'Vergara',
                'birthdate' => now()->subYears(32),
                'biological_gender' => 'Masculino'
            ],
        ];

        foreach ($users as $index => $user) {
            $createdUser = UsersProductionFactory::factoryForModel('User')->create($user);
            $userProfile = $userProfiles[$index];
            $userProfile['user_id'] = $createdUser->id;
            UsersProfileProductionFactory::factoryForModel('userProfile', 'profile')->create($userProfile);
        }
    }
}
