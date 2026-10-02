<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'What is the capital of France',
            'answer' => json_encode(['London', 'Berlin', 'Paris', 'Madrid']),
            'IsCorrect' => 'Paris', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'Which planet is known as the Red Planet?',
            'answer' => json_encode(['Earth', 'Venus', 'Mars', 'Jupiter']),
            'IsCorrect' => 'Mars', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'What is the largest ocean on Earth?',
            'answer' => json_encode(['Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean']),
            'IsCorrect' => 'Pacific Ocean', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'Which element has the chemical symbol "O"?',
            'answer' => json_encode(['Gold', 'Oxygen', 'Osmium', 'Ozone']),
            'IsCorrect' => 'Oxygen', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'Who wrote "Romeo and Juliet"?',
            'answer' => json_encode(['Charles Dickens', 'William Shakespeare', 'Jane Austen', 'Mark Twain']),
            'IsCorrect' => 'William Shakespeare', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'How many continents are there on Earth?',
            'answer' => json_encode(['5', '6', '7', '8']),
            'IsCorrect' => '7', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'What is the boiling point of water at sea level in Celsius?',
            'answer' => json_encode(['50°C', '75°C', '100°C', '120°C']),
            'IsCorrect' => '100°C', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'Which animal is known for its black and white stripes?',
            'answer' => json_encode(['Lion', 'Elephant', 'Zebra', 'Giraffe']),
            'IsCorrect' => 'Zebra', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'What is the main ingredient in guacamole?',
            'answer' => json_encode(['Tomato', 'Avacado', 'Pepper', 'Onion']),
            'IsCorrect' => 'Avacado', 
        ]);

        Question::create([
            'quiz_id' => 6, 
            'type' => 'Multiple Question',
            'point' => 2,
            'question' => 'Which language is the most widely spoken in the world?',
            'answer' => json_encode(['English', 'Spanish', 'Mandarin', 'Arabic']),
            'IsCorrect' => 'Mandarin', 
        ]);
    }
}
