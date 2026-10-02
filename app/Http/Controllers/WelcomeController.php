<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Response;

class WelcomeController extends Controller
{
    public function index()
    {
        
        $quizzes = Quiz::with('reviewquizzes','user', 'questions', 'responses')->get();
    
        // $userId = auth()->user()->id;
        // dd($userId);

        $quizzes->each(function($quiz) {
            $quiz->total_points = $quiz->questions->sum('point');
            $quiz->questions = $quiz->questions->count();
            $quiz->average = $quiz->reviewquizzes->avg('rating');

            // Check if the user has a response for this quiz
            //     $response = Response::where('quiz_id', $quiz->id)
            //     ->where('user_id', auth()->user()->id)
            //     ->first();

            // $quiz->action = $response ? 'retake' : 'take';
        });

        return view('welcome', compact('quizzes'));
        
    }
}
