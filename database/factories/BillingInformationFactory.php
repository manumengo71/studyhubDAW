<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillingInformation>
 */
class BillingInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_name' => $this->faker->firstName,
            'owner_surname' => $this->faker->lastName,
            'owner_second_surname' => $this->faker->lastName,
            'credit_card_number' => $this->faker->creditCardNumber,
            'expiration_date' => $this->faker->creditCardExpirationDateString,
            'cvv' => $this->faker->randomNumber(3),
            'type_id' => $this->faker->randomElement([1, 2, 3, 4]),
        ];
    }
}
