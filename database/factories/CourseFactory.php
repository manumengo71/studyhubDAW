<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\CourseCategory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'short_description' => fake()->sentence,
            'description' => fake()->paragraph,
            'language' => fake()->languageCode,
            'owner_id' => User::factory(),
            'courses_categories_id' => CourseCategory::inRandomOrder()->first()->id,
        ];
    }
}
