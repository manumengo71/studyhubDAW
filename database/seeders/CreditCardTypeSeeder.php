<?php

namespace Database\Seeders;

use App\Models\CreditCardType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreditCardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CreditCardType::factory(4)->create();

        $creditCardTypes = CreditCardType::all();

        foreach ($creditCardTypes as $creditCardType) {
            $creditCardType->name = match ($creditCardType->id) {
                1 => 'Visa',
                2 => 'MasterCard',
                3 => 'American Express',
                4 => 'Otro',
            };
            $creditCardType->save();
        }

        foreach ($creditCardTypes as $creditCardType) {
            $creditCardType->type = match ($creditCardType->id) {
                1 => '4',
                2 => '5',
                3 => '3',
                4 => '0',
            };
            $creditCardType->save();
        }
    }
}
