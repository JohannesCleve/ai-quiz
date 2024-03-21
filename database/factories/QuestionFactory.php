<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'options' => [
                'A' => $this->faker->sentence,
                'B' => $this->faker->sentence,
                'C' => $this->faker->sentence,
                'D' => $this->faker->sentence,
            ],
            'answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
