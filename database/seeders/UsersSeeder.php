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
        $userProfileSeeder = new UserProfileSeeder();
        $billingInformationSeeder = new BillingInformationSeeder();

        User::factory(5)->create();
        User::factory(5)->unverified()->create();

        $userProfileSeeder->run();
        $billingInformationSeeder->run();

        User::factory(1)->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234567890'),
            'email_verified_at' => now(),
        ]);

        $userProfileSeeder->createAdminProfile();

        User::factory(1)->create([
            'username' => 'StudyHub-App',
            'email' => 'StudyHub-App@admin.com',
            'password' => bcrypt('1234567890'),
            'email_verified_at' => now(),
        ]);

        $userProfileSeeder->createAcademyProfile();
    }
}
