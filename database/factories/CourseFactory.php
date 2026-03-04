<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoriesIds = CourseCategory::pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'language' => $this->faker->languageCode,
            'owner_id' => User::factory(),
            'courses_categories_id' => $this->faker->randomElement($categoriesIds),
        ];
    }
}
