<?php
namespace Database\Factories;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {

        $options = ['Paris', 'London', 'Tokyo', 'New York'];

        shuffle($options);

        return [
            'question' => $this->faker->sentence,
            'answer' => json_encode($options),
            'IsCorrect' => $options[0],
            'point' => $this->faker->numberBetween(1, 20),
            'type' => 'multiple choice',
            'quiz_id' => Quiz::factory(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            // 'response_id' will be added later
        ];
    }
}
