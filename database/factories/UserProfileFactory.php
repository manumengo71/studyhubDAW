<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\userProfile>
 */
class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $biologicalGenders = ['Masculino', 'Femenino', 'Otro'];

        return [
            'user_id' => User::all()->random()->id,
            'name' => fake()->name,
            'surname' => fake()->lastName,
            'second_surname' => fake()->lastName,
            'birthdate' => fake()->dateTimeBetween('-50 years', '-18 years'),
            'biological_gender' => $this->faker->randomElement($biologicalGenders),
        ];
    }
}
