<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Response;
use App\Models\Review;
use App\Models\Reviewquiz;
use App\Models\User;

class ReviewController extends Controller
{
    public function store(Request $request, $userId, $quizId)
    {
        // dd($request->all());
        $request->validate([
            'rating' => 'required|integer',
        ]);

        Reviewquiz::create([
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'rating' => $request->rating,
        ]);

        $attempt = Response::where('user_id', $userId)
        ->where('quiz_Id', $quizId)
        ->pluck('attempt')
        ->first();

        return redirect()->route('report.student', ['quizId' =>$quizId,'userId'=> $userId, 'attempt' => $attempt])->with('success', 'Thank you for your review');

    }

    public function quizreview()
    {
        $quizzes =  Quiz::with('reviewquizzes')
            ->get()
            ->map(function($quiz){
                $quiz->average = $quiz->reviewquizzes()->avg('rating');
                return $quiz;
            }); 
            dd($quizzes);
        
        return view('dashboard', compact('quizzes'));
    }
}
