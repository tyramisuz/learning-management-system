<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Response;
use App\Models\Review;
use App\Models\Reviewquiz;
use App\Models\User;
use App\Models\Bookmark;
use DB;
use Log;

class BookmarkController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::with('reviewquizzes','bookmarks', 'user', 'questions', 'responses')->get();
        
        $user = auth()->user()->id;
        // dd($user);

        $savedQuiz = Bookmark::where('user_id', auth()->user()->id)
        ->where('status', 'saved')
        ->with('quiz')
        ->get()
        ->pluck('quiz');

        $quizzes = $savedQuiz->each(function($quiz) {
            $quiz->total_points = $quiz->questions->sum('point');
            $quiz->questions = $quiz->questions->count();
            $quiz->bookmark = $quiz->bookmarks->pluck('status')->first(); 
            $quiz->average = $quiz->reviewquizzes->avg('rating');
            $quiz->userid = $quiz->bookmarks->pluck('user_id')->first();
    
            // Check if the user has a response for this quiz
                $response = Response::where('quiz_id', $quiz->id)
                ->where('user_id', auth()->user()->id)
                ->first();
    
            $quiz->action = $response ? 'retake' : 'take';
        // dd($userId);
        });

        return view('bookmark.index', compact('quizzes', 'savedQuiz'));
    }


    public function store(Request $request)
    {
        $quizId = $request->quiz_id;
        $userId = auth()->user()->id;
        $status = $request->status;
        // dump($status);
        
        if($status == 'saved')
        {
            $status = 'unsaved';
        } else {
            $status ='saved';
        }
        
        $bookmark = Bookmark::where('quiz_id', $quizId)
            ->where('user_id', $userId)->first();

        if($bookmark)
        {
            DB ::table('bookmarks')->where('quiz_id', $quizId)
            ->where('user_id', $userId)->update(['status' => $status]);
        
        } else {
            // dd('kkk');
            Bookmark::create(
                ['quiz_id' => $quizId, 'user_id' => $userId,
                'status'=>$status]
            );
        }
        // dd($status);
        $data_response = [
            'status' => $status,
            'quiz_id' =>$quizId,
            'user_id' =>$userId,
        ];
        // dd($data_response);
        return response()->json([
            'success' => 'Bookmark status updated successfully',
            'status' => $status,
            'quiz_id' => $quizId,
            'user_id' => $userId
        ], 200);
    }
    
}
