<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use App\Models\Export;
use App\Models\Reviewquiz;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportQuiz;
use App\Jobs\ExportCreatorReport;
use App\Jobs\ExportStudentReport;
use App\Jobs\ExportStudentReportPdf;
use Spatie\Browsershot\Browsershot;



class ReportController extends Controller
{
    public function studentReport(Request $request, $userId, $quizId, $attemptNumber)
    {
        $passMark = Quiz::where('id', $quizId)->pluck('passgrade')->first();
        preg_match('/\d+/', $passMark, $matches);
        $passMarkNumber = $matches[0];
        $participants = Quiz::where('id', $quizId)->pluck('participants')->first();
        // dd($participants);
        // dump($passMarkNumber);
        $quiz = Quiz::with('questions')->find($quizId);
        // dd($quiz);
        $user = User::find($userId);

        $responses = Response::
            where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->where('attempt', $attemptNumber)
            ->get()
            ->keyBy('question_id');
            
            // dd($responses);
            $QuestionIds = $quiz->questions->pluck('id')->toArray();
            $performance = []; 
            
            $questions = range(1, $quiz->questions->count());
            // dd($questions);

            foreach ($QuestionIds as $questionId) {
                $performance[$questionId] = 0; 
            }

            $sturesponses = DB::table('responses')
                ->join('questions', 'responses.question_id', '=', 'questions.id')
                ->where('responses.quiz_id', $quizId)
                ->where('responses.user_id', $userId)
                ->where('responses.attempt', $attemptNumber)
                ->select(
                    'responses.id',
                    'responses.question_id',
                    'responses.stuAns',
                    'questions.IsCorrect',
                    DB::raw('CASE WHEN responses.stuAns = questions.IsCorrect THEN 1 ELSE 0 END AS is_correct')
                    )
                    ->get();
                    // dd($sturesponses);

            foreach ($sturesponses as $sturesponse) {
                $performance[$sturesponse->question_id] = $sturesponse->is_correct;
            }

            $performance = array_values($performance);
            
            $currentAttemptDate = $responses->where('attempt', $attemptNumber)->first();
            // dd($currentAttemptDate->created_at);
            
            foreach ($responses as $response) {
                // dd($performance);
                $studentAnswer = $response->stuAns;
                // dd($studentAnswer);
                }
                $attemptedQuestions = $responses->count();
                // dd($attemptedQuestions);
                
        $reportData = [];

        foreach ($quiz->questions as $question) {
            $response = $responses->get($question->id);
            // dd($response);
            // $stuans = $response->stuAns;
            $questionData = [
                'question' => $question->question,
                'options' => json_decode($question->answer),
                'studentAnswer' => $response->stuAns ?? null, 
                'correctAnswer' => $question->IsCorrect,
            ];
            // dd($questionData);

            $reportData[] = $questionData;
        }

        $totalQuestions = $quiz->questions->count();
        // dump($totalQuestions);
        $totalpoints = $quiz->questions()->sum('point');
        $totalResponses = $responses->count();
        $totalUnanswered = $totalQuestions - $totalResponses;
        // dd($totalUnanswered);

        $totalCorrect = Response::where('quiz_id', $quizId)
        ->where('user_id', $userId)
        ->where('attempt', $attemptNumber)
        ->whereHas('question', function ($query) {
            $query->whereColumn('responses.stuAns', 'questions.IsCorrect');
            })
            ->count();

        // dd($totalCorrect);
        $totalIncorrect = $totalResponses - $totalCorrect;

        $userscore = $responses->sum('score');
        $scores = $userscore;

        if ($userscore > 0) {
            $overallScore = round(($userscore / $totalpoints) * 100);
        } else {
            $overallScore = 0;
        }

        $formatted = number_format($overallScore, 0, '', '');
        // dd($formatted);

        $timeTaken = Response::where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->pluck('timeTaken')
            ->first();

        // dd($quiz);


        $review = Reviewquiz::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->pluck('rating');

        // Fetch and rank all students' scores
        $allScores = Response::where('quiz_id', $quizId)
        ->join('users', 'responses.user_id', '=', 'users.id')
        ->select('user_id', 'users.name as user_name', DB::raw('SUM(score) as total_score'))
        ->groupBy('user_id', 'users.name')
        ->orderBy('total_score', 'desc')
        ->get();

        $rankedScores = $allScores->map(function($score, $index) use ($userId) {
            return [
                'rank' => $index + 1,
                'user_id' => $score->user_id,
                'user_name' => $score->user_name,
                'total_score' => $score->total_score,
                'is_current_user' => $score->user_id == $userId
            ];
        });

        $currentUserRankData = $rankedScores->firstWhere('is_current_user', true);

        $currentUserRank = $currentUserRankData['rank'] ?? null;
        // dd($currentUserRank);

        return view('report.student', compact(
            'quiz', 
            'user', 
            'totalIncorrect', 
            'passMarkNumber',
            'userscore',
            'totalCorrect', 
            'totalQuestions', 
            'formatted', 
            'reportData', 
            'timeTaken', 
            'questions',
            'performance', 
            'totalUnanswered',
            'performance', 
            'review',
            'rankedScores',
            'currentUserRank',
            'attemptNumber',
            'totalpoints',
            'participants',
            'currentAttemptDate',
        ));
    }

    public function groupReport(Request $request, $userId, $quizId, $attemptNumber)
    {
        // Existing logic
        $passMark = Quiz::where('id', $quizId)->pluck('passgrade')->first();
        preg_match('/\d+/', $passMark, $matches);
        $passMarkNumber = $matches[0];
        $participants = Quiz::where('id', $quizId)->pluck('participants')->first();
        
        $quiz = Quiz::with('questions')->find($quizId);
        $user = User::find($userId);

        $responses = DB::table('responses')
            ->where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->where('attempt', $attemptNumber)
            ->get()
            ->keyBy('question_id');
            // dd($responses);

        $QuestionIds = $quiz->questions->pluck('id')->toArray();
        $performance = []; 
                
        $questions = range(1, $quiz->questions->count());

        foreach ($QuestionIds as $questionId) {
            $performance[$questionId] = 0; 
        }

        $sturesponses = DB::table('responses')
            ->join('questions', 'responses.question_id', '=', 'questions.id')
            ->where('responses.quiz_id', $quizId)
            ->where('responses.user_id', $userId)
            ->where('responses.attempt', $attemptNumber)
            ->select(
                'responses.id',
                'responses.question_id',
                'responses.stuAns',
                'questions.IsCorrect',
                DB::raw('CASE WHEN responses.stuAns = questions.IsCorrect THEN 1 ELSE 0 END AS is_correct')
            )
            ->get();

        foreach ($sturesponses as $sturesponse) {
            $performance[$sturesponse->question_id] = $sturesponse->is_correct;
        }
        // dd($sturesponses);

        $performance = array_values($performance);

        foreach ($responses as $response) {
            $studentAnswer = $response->stuAns;
        }
        $attemptedQuestions = $responses->count();

        $reportData = [];

        foreach ($quiz->questions as $question) {
            $response = $responses->get($question->id);
            $questionData = [
                'question' => $question->question,
                'options' => json_decode($question->answer),
                'studentAnswer' => $response->stuAns ?? null, 
                'correctAnswer' => $question->IsCorrect,
            ];

            $reportData[] = $questionData;
        }

        $totalQuestions = $quiz->questions->count();
        $totalpoints = $quiz->questions()->sum('point');
        $totalResponses = $responses->count();
        $totalUnanswered = $totalQuestions - $totalResponses;

        $totalCorrect = Response::where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->where('attempt', $attemptNumber)
            ->whereHas('question', function ($query) {
                $query->whereColumn('responses.stuAns', 'questions.IsCorrect');
            })
            ->count();

        $totalIncorrect = $totalResponses - $totalCorrect;
        $userscore = $responses->sum('score');

        if ($userscore > 0) {
            $overallScore = round(($userscore / $totalpoints) * 100);
        } else {
            $overallScore = 0;
        }

        $formatted = number_format($overallScore, 0, '', '');
        $timeTaken = Response::where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->pluck('timeTaken')
            ->first();

        $review = Reviewquiz::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->pluck('rating');

        $allScores = Response::where('quiz_id', $quizId)
            ->join('users', 'responses.user_id', '=', 'users.id')
            ->select('user_id', 'users.name as user_name', DB::raw('SUM(score) as total_score'))
            ->groupBy('user_id', 'users.name')
            ->orderBy('total_score', 'desc')
            ->get();

        $rankedScores = $allScores->map(function($score, $index) use ($userId) {
            return [
                'rank' => $index + 1,
                'user_id' => $score->user_id,
                'user_name' => $score->user_name,
                'total_score' => $score->total_score,
                'is_current_user' => $score->user_id == $userId
            ];
        });

        $currentUserRankData = $rankedScores->firstWhere('is_current_user', true);
        $currentUserRank = $currentUserRankData['rank'] ?? null;
        $totalAttempts = Response::where('quiz_id', $quizId)->where('user_id', $userId)->distinct('attempt')->count('attempt');

        $attemptDates = Response::select('attempt', DB::raw('MIN(created_at) as created_at'))
        ->where('quiz_id', $quizId)
        ->where('user_id', $userId)
        ->groupBy('attempt')
        ->orderBy('attempt')
        ->get();

        $currentAttemptDate = $attemptDates->where('attempt', $attemptNumber)->first();
        // dd($currentAttemptDate);
        
        return view('groups.groupReport', compact(
            'quiz', 
            'userId',
            'quizId',
            'user', 
            'totalIncorrect', 
            'passMarkNumber',
            'userscore',
            'totalCorrect', 
            'totalQuestions', 
            'formatted', 
            'reportData', 
            'timeTaken', 
            'questions',
            'performance', 
            'totalUnanswered',
            'performance', 
            'review',
            'rankedScores',
            'currentUserRank',
            'attemptNumber',
            'totalpoints',
            'participants',
            'totalAttempts',
            'attemptDates',
            'currentAttemptDate',
        ));
    }
    
    public function AnswerReview($quizId, $userId, $attemptNumber)
    {
        $quiz = Quiz::with('questions')->find($quizId);
        // dd($quiz);
        $user = User::find($userId);

        $responses = DB::table('responses')
        ->where('quiz_id', $quizId)
        ->where('user_id', $userId)
        ->where('attempt', $attemptNumber)
        ->get()
        ->keyBy('question_id');
        // dd($responses);
        $QuestionIds = $quiz->questions->pluck('id')->toArray();
        $performance = []; 
        
        $questions = range(1, $quiz->questions->count());
        // dd($questions);

        foreach ($QuestionIds as $questionId) {
            $performance[$questionId] = 0; 
        }

        $sturesponses = DB::table('responses')
            ->join('questions', 'responses.question_id', '=', 'questions.id')
            ->where('responses.quiz_id', $quizId)
            ->where('responses.user_id', $userId)
            ->where('responses.attempt', $attemptNumber)
            ->select(
                'responses.id',
                'responses.question_id',
                'responses.stuAns',
                'questions.IsCorrect',
                DB::raw('CASE WHEN responses.stuAns = questions.IsCorrect THEN 1 ELSE 0 END AS is_correct')
                )
                ->get();
                // dd($sturesponses);

        foreach ($sturesponses as $sturesponse) {
            $performance[$sturesponse->question_id] = $sturesponse->is_correct;
        }

        $performance = array_values($performance);
        
        
        foreach ($responses as $response) {
            // dd($performance);
            $studentAnswer = $response->stuAns;
            // dd($studentAnswer);
            }
            $attemptedQuestions = $responses->count();
            // dd($attemptedQuestions);
            
        $reportData = [];

        foreach ($quiz->questions as $question) {
            $response = $responses->get($question->id);
            // dd($response);
            // $stuans = $response->stuAns;
            $questionData = [
                'question' => $question->question,
                'options' => json_decode($question->answer),
                'studentAnswer' => $response->stuAns ?? null, 
                'correctAnswer' => $question->IsCorrect,
                'questionType' => $question->answertype,
                'totalCorrect' => $question->totalCorrect,
            ];
            // dd($questionData);

            $reportData[] = $questionData;
        }

        $totalQuestions = $quiz->questions->count();
        // dump($totalQuestions);
        $totalpoints = $quiz->questions()->sum('point');
        $totalResponses = $responses->count();
        $totalUnanswered = $totalQuestions - $totalResponses;
        // dd($totalUnanswered);

        $totalCorrect = Response::where('quiz_id', $quizId)
        ->where('user_id', $userId)
        ->where('attempt', $attemptNumber)
        ->whereHas('question', function ($query) {
            $query->whereColumn('responses.stuAns', 'questions.IsCorrect');
            })
            ->count();

        // dd($totalCorrect);
        $totalIncorrect = $totalResponses - $totalCorrect;

        return view('report.answerReview', compact(
                'quiz', 
                'user', 
                'totalIncorrect', 
                'totalCorrect', 
                'totalQuestions', 
                'reportData', 
                'questions',
                'performance', 
                'totalUnanswered',
                'performance', 
                'attemptNumber',
                'totalpoints',
        ));
    }

    public function viewReport(Request $request, $userId, $quizId, $attemptNumber)
    {
        $passMark = Quiz::where('id', $quizId)->pluck('passgrade')->first();
        preg_match('/\d+/', $passMark, $matches);
        $passMarkNumber = $matches[0];
        $participants = Quiz::where('id', $quizId)->pluck('participants')->first();
        // dd($participants);
        // dump($passMarkNumber);
        $quiz = Quiz::with('questions')->find($quizId);
        // dd($quiz);
        $user = User::find($userId);

        $responses = Response::
            where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->where('attempt', $attemptNumber)
            ->get()
            ->keyBy('question_id');
            
            // dd($responses);
            $QuestionIds = $quiz->questions->pluck('id')->toArray();
            $performance = []; 
            
            $questions = range(1, $quiz->questions->count());
            // dd($questions);

            foreach ($QuestionIds as $questionId) {
                $performance[$questionId] = 0; 
            }

            $sturesponses = DB::table('responses')
                ->join('questions', 'responses.question_id', '=', 'questions.id')
                ->where('responses.quiz_id', $quizId)
                ->where('responses.user_id', $userId)
                ->where('responses.attempt', $attemptNumber)
                ->select(
                    'responses.id',
                    'responses.question_id',
                    'responses.stuAns',
                    'questions.IsCorrect',
                    DB::raw('CASE WHEN responses.stuAns = questions.IsCorrect THEN 1 ELSE 0 END AS is_correct')
                    )
                    ->get();
                    // dd($sturesponses);

            foreach ($sturesponses as $sturesponse) {
                $performance[$sturesponse->question_id] = $sturesponse->is_correct;
            }

            $performance = array_values($performance);
            
            $currentAttemptDate = $responses->where('attempt', $attemptNumber)->first();
            // dd($currentAttemptDate->created_at);
            
            foreach ($responses as $response) {
                // dd($performance);
                $studentAnswer = $response->stuAns;
                // dd($studentAnswer);
                }
                $attemptedQuestions = $responses->count();
                // dd($attemptedQuestions);
                
        $reportData = [];

        foreach ($quiz->questions as $question) {
            $response = $responses->get($question->id);
            // dd($response);
            // $stuans = $response->stuAns;
            $questionData = [
                'question' => $question->question,
                'options' => json_decode($question->answer),
                'studentAnswer' => $response->stuAns ?? null, 
                'correctAnswer' => $question->IsCorrect,
            ];
            // dd($questionData);

            $reportData[] = $questionData;
        }

        $totalQuestions = $quiz->questions->count();
        // dump($totalQuestions);
        $totalpoints = $quiz->questions()->sum('point');
        $totalResponses = $responses->count();
        $totalUnanswered = $totalQuestions - $totalResponses;
        // dd($totalUnanswered);

        $totalCorrect = Response::where('quiz_id', $quizId)
        ->where('user_id', $userId)
        ->where('attempt', $attemptNumber)
        ->whereHas('question', function ($query) {
            $query->whereColumn('responses.stuAns', 'questions.IsCorrect');
            })
            ->count();

        // dd($totalCorrect);
        $totalIncorrect = $totalResponses - $totalCorrect;

        $userscore = $responses->sum('score');
        $scores = $userscore;

        if ($userscore > 0) {
            $overallScore = round(($userscore / $totalpoints) * 100);
        } else {
            $overallScore = 0;
        }

        $formatted = number_format($overallScore, 0, '', '');
        // dd($formatted);

        $timeTaken = Response::where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->pluck('timeTaken')
            ->first();

        // dd($quiz);


        $review = Reviewquiz::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->pluck('rating');

        // Fetch and rank all students' scores
        $allScores = Response::where('quiz_id', $quizId)
        ->join('users', 'responses.user_id', '=', 'users.id')
        ->select('user_id', 'users.name as user_name', DB::raw('SUM(score) as total_score'))
        ->groupBy('user_id', 'users.name')
        ->orderBy('total_score', 'desc')
        ->get();

        $rankedScores = $allScores->map(function($score, $index) use ($userId) {
            return [
                'rank' => $index + 1,
                'user_id' => $score->user_id,
                'user_name' => $score->user_name,
                'total_score' => $score->total_score,
                'is_current_user' => $score->user_id == $userId
            ];
        });

        $currentUserRankData = $rankedScores->firstWhere('is_current_user', true);

        $currentUserRank = $currentUserRankData['rank'] ?? null;
        // dd($currentUserRank);

        // $currentAttemptDate = $responses->where('attempt', $attempt)->first();
        $createdAt = \Carbon\Carbon::parse($currentAttemptDate->created_at);

        return view('report.view', compact(
            'quiz', 
            'user', 
            'totalIncorrect', 
            'passMarkNumber',
            'userscore',
            'totalCorrect', 
            'totalQuestions', 
            'formatted', 
            'reportData', 
            'timeTaken', 
            'questions',
            'performance', 
            'totalUnanswered',
            'performance', 
            'review',
            'rankedScores',
            'currentUserRank',
            'attemptNumber',
            'totalpoints',
            'participants',
            'currentAttemptDate',
            'createdAt',
        ));
    }

    // public function viewPdf($quizId)
    // {
    //     // dd('view');
    //     // dd($request->stuAns);
    //     $userId = auth()->user()->id;
    //     $passMark = Quiz::where('id', $quizId)->pluck('passgrade')->first();
    //     preg_match('/\d+/', $passMark, $matches);
    //     $passMarkNumber = $matches[0];
    //     $participants = Quiz::where('id', $quizId)->pluck('participants')->first();
    //     // dd($participants);
    //     // dump($passMarkNumber);
    //     $quiz = Quiz::with('questions')->find($quizId);
    //     // dd($quiz);
    //     $user = User::find($userId);

    //     $responses = DB::table('responses')
    //         ->where('quiz_id', $quizId)
    //         ->where('user_id', $userId)
    //         ->where('attempt', '=', '1')
    //         ->get()
    //         ->keyBy('question_id');
    //         // dd($responses);

    //         $attempt = $responses->pluck('attempt')->first();
    //         // dd($attempt);
    //         $QuestionIds = $quiz->questions->pluck('id')->toArray();
    //         $performance = []; 
            
    //         $questions = range(1, $quiz->questions->count());
    //         // dd($questions);

    //         foreach ($QuestionIds as $questionId) {
    //             $performance[$questionId] = 0; 
    //         }


    //         $sturesponses = DB::table('responses')
    //             ->join('questions', 'responses.question_id', '=', 'questions.id')
    //             ->where('responses.quiz_id', $quizId)
    //             ->where('responses.user_id', $userId)
    //             ->where('responses.attempt', '=', '1')
    //             ->select(
    //                 'responses.id',
    //                 'responses.question_id',
    //                 'responses.stuAns',
    //                 'questions.IsCorrect',
    //                 DB::raw('CASE WHEN responses.stuAns = questions.IsCorrect THEN 1 ELSE 0 END AS is_correct')
    //                 )
    //                 ->get();
    //                 // dd($sturesponses);

    //         foreach ($sturesponses as $sturesponse) {
    //             $performance[$sturesponse->question_id] = $sturesponse->is_correct;
    //         }

    //         $performance = array_values($performance);
            
            
    //         foreach ($responses as $response) {
    //             // dd($performance);
    //             $studentAnswer = $response->stuAns;
    //             // dd($studentAnswer);
    //             }
    //             $attemptedQuestions = $responses->count();
    //             // dd($attemptedQuestions);
                
    //     $reportData = [];

    //     foreach ($quiz->questions as $question) {
    //         $response = $responses->get($question->id);
    //         // dd($response);
    //         // $stuans = $response->stuAns;
    //         $questionData = [
    //             'question' => $question->question,
    //             'options' => json_decode($question->answer),
    //             'studentAnswer' => $response->stuAns ?? null, 
    //             'correctAnswer' => $question->IsCorrect,
    //         ];
    //         // dd($questionData);

    //         $reportData[] = $questionData;
    //     }

    //     $totalQuestions = $quiz->questions->count();
    //     // dump($totalQuestions);
    //     $totalpoints = $quiz->questions()->sum('point');
    //     $totalResponses = $responses->count();
    //     $totalUnanswered = $totalQuestions - $totalResponses;
    //     // dd($totalUnanswered);

    //     $totalCorrect = Response::where('quiz_id', $quizId)
    //     ->where('user_id', $userId)
    //     ->where('attempt', '=', '1')
    //     ->whereHas('question', function ($query) {
    //         $query->whereColumn('responses.stuAns', 'questions.IsCorrect');
    //         })
    //         ->count();

    //     // dd($totalCorrect);
    //     $totalIncorrect = $totalResponses - $totalCorrect;

    //     $userscore = $responses->sum('score');
    //     $scores = $userscore;

    //     if ($userscore > 0) {
    //         $overallScore = round(($userscore / $totalpoints) * 100);
    //     } else {
    //         $overallScore = 0;
    //     }

    //     $formatted = number_format($overallScore, 0, '', '');
    //     // dd($formatted);

    //     $timeTaken = Response::where('quiz_id', $quizId)
    //         ->where('user_id', $userId)
    //         ->pluck('timeTaken')
    //         ->first();

    //     // dd($quiz);


    //     $review = Reviewquiz::where('user_id', $userId)
    //         ->where('quiz_id', $quizId)
    //         ->pluck('rating');

    //     // Fetch and rank all students' scores
    //     $allScores = Response::where('quiz_id', $quizId)
    //     ->join('users', 'responses.user_id', '=', 'users.id')
    //     ->select('user_id', 'users.name as user_name', DB::raw('SUM(score) as total_score'))
    //     ->groupBy('user_id', 'users.name')
    //     ->orderBy('total_score', 'desc')
    //     ->get();

    //     $rankedScores = $allScores->map(function($score, $index) use ($userId) {
    //         return [
    //             'rank' => $index + 1,
    //             'user_id' => $score->user_id,
    //             'user_name' => $score->user_name,
    //             'total_score' => $score->total_score,
    //             'is_current_user' => $score->user_id == $userId
    //         ];
    //     });

    //     $currentUserRankData = $rankedScores->firstWhere('is_current_user', true);

    //     $currentUserRank = $currentUserRankData['rank'] ?? null;
    //     // dd($currentUserRank);

    //     $currentAttemptDate = $responses->where('attempt', $attempt)->first();
    //     $createdAt = \Carbon\Carbon::parse($currentAttemptDate->created_at);
    //     // dd($createdAt->format('M d, Y'));

    //     return view('report.pdf', compact(
    //         'quiz', 
    //         'user', 
    //         'totalIncorrect', 
    //         'passMarkNumber',
    //         'userscore',
    //         'totalCorrect', 
    //         'totalQuestions', 
    //         'formatted', 
    //         'reportData', 
    //         'timeTaken', 
    //         'questions',
    //         'performance', 
    //         'totalUnanswered',
    //         'performance', 
    //         'review',
    //         'rankedScores',
    //         'currentUserRank',
    //         'totalpoints',
    //         'participants',
    //         'attempt',
    //         'createdAt',
    //     ));
    // }

    public function creatorReport($quizId)
    {
        
        $quiz = Quiz::find($quizId);
        // dd($quiz->passgrade);
        $hours = floor($quiz->duration / 60);
        $minutes = $quiz->duration % 60;
        
        // Retrieve user that has responses under quiz id
        $users = User::whereHas('responses', function ($query) use ($quizId) {
            $query->where('quiz_id', $quizId);
        })->get();
        
        
        $questions = DB::table('questions')
        ->where('quiz_id', $quizId)
        ->get(['IsCorrect', 'id', 'point']);
        
        $correctAnswers = $questions->pluck('IsCorrect', 'id');
        $points = $questions->pluck('point', 'id');
        
        $totalScore = 0;
        $numberOfUsers = count($users);
        // dd($numberOfUsers);
        $highestScore = 0;
        $lowestScore = PHP_INT_MAX;
        
        foreach ($users as $user) {
            
            $userId = $user->id;
            
            $totalResponses = Response::where('quiz_id', $quizId)
                ->where('user_id', $userId)
                ->count();
    
            $totalCorrect = Response::where('quiz_id', $quizId)
                ->where('user_id', $userId)
                ->whereHas('question', function ($query) {
                    $query->whereColumn('responses.stuAns', 'questions.IsCorrect');
                })
                ->count();
    
            $totalIncorrect = $totalResponses - $totalCorrect;
    
            $percentage = ($totalResponses > 0) ? (($totalCorrect / $totalResponses) * 100) : 0;
            $overallScore = number_format($percentage, '0', '', '');
    
            // Retrieve student answers for the user
            $userResponses = Response::where('user_id', $userId)
                ->whereIn('question_id', $correctAnswers->keys())
                ->get();
                // dd($userResponses);
                $score = 0;
                foreach ($userResponses as $response) {
                    // dd($response);
                    if ($response->stuAns === $correctAnswers[$response->question_id]) { // Assuming the student's answer is stored in 'stuAns' field of the responses table
                        $score += $points[$response->question_id];
                    }
                }
                
                $totalpoints = $quiz->questions()->sum('point');
                
                $timeTaken = Response::where('quiz_id', $quizId)
                    ->where('user_id', $userId)
                    ->pluck('timeTaken')
                    ->first();
                // dd($timeTaken);

                $percentages = round(($score / $totalpoints) * 100);
                $userScores[] = [
                    'user' => $user,
                    'score' => $score,
                    'percentage' => $percentages,
                    'totalpoints' => $totalpoints,
                    'timeTaken' => $timeTaken,
                ];

                // dump($userScores);
                $user = User::latest()->paginate(30);
                $i = ($user->currentPage() - 1) * $user->perPage();

        }
   
            
            // Sort user data by score in descending order
            usort($userScores, function($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            
            $totalScore = array_sum(array_column($userScores, 'score'));
            $numberOfUsers = count($userScores);
            $highestScore = $numberOfUsers > 0 ? max(array_column($userScores, 'score')) : 0;
            $lowestScore = $numberOfUsers > 0 ? min(array_column($userScores, 'score')) : 0;
            $averageScore = $numberOfUsers > 0 ? $totalScore / $numberOfUsers : 0;
            $aveScore = number_format($averageScore, '0', '', '');

            // dd($highestScore);

            $passThreshold= $quiz->passgrade;
            // dd($passThreshold);
            $userScores = collect($userScores);
    
            $passCount = $userScores->filter(function ($userScore) use ($passThreshold) {
                return $userScore['percentage'] >= $passThreshold;
            })->count();
            // dd($passCount);
    
            $failCount = $userScores->filter(function ($userScore) use ($passThreshold) {
                return $userScore['percentage'] <= $passThreshold;
            })->count();
            // dd('fail:',$failCount);

            // Fetch and rank all students' scores
            $allScores = Response::where('quiz_id', $quizId)
            ->join('users', 'responses.user_id', '=', 'users.id')
            ->select('user_id', 'users.name as user_name', DB::raw('SUM(score) as total_score'))
            ->groupBy('user_id', 'users.name')
            ->orderBy('total_score', 'desc')
            ->get();

            $rankedScores = $allScores->map(function($score, $index) use ($userId) {
                return [
                    'rank' => $index + 1,
                    'user_id' => $score->user_id,
                    'user_name' => $score->user_name,
                    'total_score' => $score->total_score,
                    'is_current_user' => $score->user_id == $userId
                ];
            });
            
        $currentUserRank = $rankedScores->firstWhere('is_current_user', true);

            
        return view('report.creator', compact('quiz', 'hours', 'i','minutes', 'totalCorrect', 'totalIncorrect', 'overallScore', 'aveScore', 'lowestScore', 'highestScore', 'totalScore', 'userScores', 'percentages', 'failCount', 'passCount', 'totalpoints', 'timeTaken', 'rankedScores', 'currentUserRank'));
    }
    
    public function exportCreatorReport($quizId)
    {
        $quiz = Quiz::find($quizId);
        $fileName = $quiz->title . '_report_' . Carbon::now()->format('Y-m-d_His') . '.xlsx';
        $filePath = 'exports/' . $fileName;

        $export = Export::create([
            'user_id' => Auth::id(),
            'quiz_id' =>$quizId,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'status' => 'pending',
            'file_type'=>'xlsx',
            'type'=> 'quiz',
        ]);

        $exportId = $export->id;

        ExportCreatorReport::dispatch($quizId, $exportId);

        return redirect()->back()->with('status', 'Export started! You can check the status in the export history.');
    }

    public function regenerate($exportId)
    {
        $export = Export::Find($exportId);
        
        if (!$export) {
            return redirect()->back()->with('error', 'Export not found.');
        }
        $userId = $export->user_id;
        $quizId = $export->quiz_id;
        $attempt = $export->attempt;

        $fileType = $export->file_type;
        $type = $export->type;

        if($fileType == 'xlsx' && $type == 'quiz'){
            ExportStudentReport::dispatch($userId, $quizId, $attempt, $exportId);
        }
        else if ($fileType == 'xlsx' && $type == 'student'){
            ExportStudentReportPdf::dispatch($quizId, $exportId);
        }
        else if($fileType == 'pdf'){
            ExportStudentReportPdf::dispatch($quizId, $exportId);
        }

        $regenerate_data = [
            'status' => 'pending',
            'updated_at' => now(),
        ];

        $export->update($regenerate_data);

        return redirect()->back()->with('status', 'Generate report started, you can download once success');
    }

    public function exportStudentReport($userId, $quizId, $attempt)
    {
        $user = User::find($userId);
        $fileName = $user->name . '_report_' . Carbon::now()->format('Y-m-d_His') . '.xlsx';
        $filePath = 'exports/' . $fileName;

        $export = Export::create([
            'user_id' => Auth::id(),
            'file_path' => $filePath,
            'file_name' => $fileName,
            'status' => 'pending',
            'attempt_number' =>$attempt,
            'quiz_id' =>$quizId,
            'type' =>'student',
            'file_type'=>'xlsx',
        ]);

        $exportId = $export->id;

        ExportStudentReport::dispatch($userId, $quizId, $attempt, $exportId);

        return redirect()->back()->with('status', 'Export started! You can check the status in the export history.');
        
    }

    public function exportStudentReportPdf($quizId)
    {
        $fileName = auth()->user()->name . '_report_' . Carbon::now()->format('Y-m-d_His') . '.pdf';
        $filePath = 'exports/' . $fileName;

        $export = Export::create([
            'user_id' => Auth::id(),
            'quiz_id' =>$quizId,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'status' => 'pending',
            'file_type'=>'pdf',
        ]);

        $exportId = $export->id;

        ExportStudentReportPdf::dispatch($quizId, $exportId);

        return redirect()->back()->with('status', 'Export started! You can check the status in the export history.');
        
    }
 
    public function downloadQuiz($exportId)
    {
        $export = Export::find($exportId);

        if($export)
        {
            $filePath = storage_path("app/public/$export->file_path");
            // dd($filePath);
                return response()->download($filePath);
            // else
            // {
            //     return response()->json(['error' => 'File not found.'], 404);
            // }
        }
        else
        {
            return response()->json(['error' => 'Export record not found.'], 404);
        }
       
    }

    public function downloadStudent($exportId)
    {
        $export = Export::find($exportId);

        if($export)
        {
            $filePath = storage_path("app/public/$export->file_path");
            // dd($filePath);
            return response()->download($filePath);
            // else
            // {
                //     return response()->json(['error' => 'File not found.'], 404);
                // }
        }
        else
        {
            return response()->json(['error' => 'Export record not found.'], 404);
        }
       
    }

    public function exportHistory()
    {
        $exports = Export::where('user_id', Auth::id())->latest()->paginate(5);
        // dd($exports);
    
        return view('exports.history', compact('exports'));
    }

}
