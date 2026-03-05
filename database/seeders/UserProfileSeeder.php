<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;

class UserProfileSeeder extends Seeder
{
    use HasRoles;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserProfile::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * Crear perfil de administrador
     */
    public function createAdminProfile(): void
    {
        $admin = User::where('username', 'admin')->first();
        if ($admin && !$admin->userProfile) {
            UserProfile::factory()->create([
                'user_id' => $admin->id,
                'name' => 'AdminName',
                'surname' => 'AdminSurname',
                'second_surname' => 'AdminSecondSurname',
                'birthdate' => '2024-01-01',
                'biological_gender' => 'Masculino',
            ]);
        }
        $admin->assignRole('admin');
    }
}
