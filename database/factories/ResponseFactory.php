<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Response;
use App\Models\Question;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Group;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Response>
 */
class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Response::class;

    public function definition(): array
    {
          
          $question = Question::inRandomOrder()->first();
          $correctAnswer = $question->IsCorrect; 
          $possibleAnswers = ['Paris', 'London', 'Tokyo', 'New York'];
  
          $stuAns = $this->faker->randomElement($possibleAnswers);
          $score = $stuAns === $correctAnswer ? $question->point : 0;
  
          return [
              'score' => $score,
              'stuAns' => $stuAns,
              'question_id' => $question->id,
              'user_id' => User::inRandomOrder()->first()->id,
              'quiz_id' => Quiz::inRandomOrder()->first()->id,
              'group_id' => Group::inRandomOrder()->first()->id,
              'created_at' => now(),
              'updated_at' => now(),
              'timeTaken' => $this->faker->numberBetween(1, 120), // time in minutes
              'attempt' => $this->faker->numberBetween(1, 5),
              'deleted_at' => null,
          ];
    }
}
