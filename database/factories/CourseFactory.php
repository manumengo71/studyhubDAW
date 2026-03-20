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
        $userIds = User::pluck('id')->toArray();
        $languages = ['Español', 'Inglés', 'Francés', 'Alemán', 'Italiano', 'Portugués', 'Chino (Mandarín)', 'Hindi', 'Árabe', 'Bengalí', 'Ruso', 'Japonés', 'Malayo', 'Telugu', 'Vietnamita', 'Coreano'];

        return [
            'name' => implode(' ', $this->faker->words(3)),
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'language' => $this->faker->randomElement($languages),
            'owner_id' => $this->faker->randomElement($userIds),
            'price' => $this->faker->randomFloat(2, 0, 200),
            'validated' => $this->faker->boolean(50), // 50% de ser true o false
            'courses_categories_id' => $this->faker->randomElement($categoriesIds),
        ];
    }
}
