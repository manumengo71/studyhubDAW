<?php

namespace Database\Seeders;

use App\Models\BillingInformation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            BillingInformation::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
