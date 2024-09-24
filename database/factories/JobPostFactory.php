<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->jobTitle,
            "position_type" => $this->faker->randomElement(['remote', 'hybrid', 'in-person']),
            "salary" => $this->faker->randomFloat(2, 1000, 300000),
            "location" => $this->faker->city . ', ' . $this->faker->stateAbbr . ', ' . $this->faker->country,
            "description" => implode("\n\n", $this->faker->paragraphs(10)),
            "is_published" => $this->faker->boolean(70),
        ];
    }
}
