<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();
        $unverifiedUser = User::factory(5)->unverified()->create();
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234567890'),
            'email_verified_at' => now(),
        ]);

        $userProfileSeeder = new UserProfileSeeder();
        $userProfileSeeder->run($users);
        $userProfileSeeder->run($unverifiedUser);
        $userProfileSeeder->createAdminProfile();
    }
}
