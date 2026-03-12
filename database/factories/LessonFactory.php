<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\LessonType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $coursesId = Course::pluck('id')->toArray();
        $lessonsTypesIds = LessonType::pluck('id')->toArray();

        return [
            'courses_id' => $this->faker->randomElement($coursesId),
            'lessons_types_id' => $this->faker->randomElement($lessonsTypesIds),
            'title' => implode(' ', $this->faker->words(2)),
            'subtitle' => $this->faker->sentence,
        ];
    }
}
