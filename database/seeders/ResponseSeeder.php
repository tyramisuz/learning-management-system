<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Response;
use App\Models\Question;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed responses
        Question::all()->each(function ($question) {
            $response = Response::factory()->create([
                'question_id' => $question->id,
            ]);

            // Update question with response_id
            $question->update(['response_id' => $response->id]);
        });
    }

}
