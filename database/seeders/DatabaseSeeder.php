<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $quizzes = Quiz::factory(10)->create();

        $quizzes->each(function (Quiz $quiz) {
            Question::factory(rand(5, 27))->create([
                'quiz_id' => $quiz->id,
            ]);
        });
    }
}
