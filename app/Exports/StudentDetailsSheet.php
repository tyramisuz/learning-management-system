<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Response;
use App\Models\Reviewquiz;
use DB;
use Illuminate\Support\Facades\Log;

class StudentDetailsSheet implements FromArray, WithHeadings
{
    protected $userId;
    protected $quizId;
    protected $attempt;


    public function __construct($userId, $quizId, $attempt)
    {
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->attempt = $attempt;
    }

    public function array(): array
    {
            $userId = $this->userId;
            $quizId = $this->quizId;
            $attemptNumber = $this->attempt;

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
                $currentAttemptDate = $currentAttemptDate->created_at->format('m/d/Y');
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

            $hours = floor($timeTaken / 60);
            $minutes = $timeTaken % 60;
    
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
            Log::info($currentUserRankData);
            $currentUserRank = $currentUserRankData['rank'] ?? null;
            // dd($currentUserRank);
            $result = null;
            if($formatted >= $passMarkNumber)
            {
                $result = 'Passed';
            }
            else {
                $result = 'Failed';
            }

        return [
            
            ['Student Details'],
            ['Name','Gender','School','Email'],
            [ $user->name, $user->gender, $user->school, $user->email],
            [''],
            ['Quiz Details'],
            ['Attempt Date', 'Attempt', 'Time Taken', 'Overall Score(%)', 'Correct', 'Incorrect', 'Not Answered', 'Score', 'Rank', 'Result'],
            [$currentAttemptDate, $attemptNumber, "{$hours}h {$minutes}m", $formatted, $totalCorrect, $totalIncorrect, $totalUnanswered, "$userscore/$totalpoints", "$currentUserRank/$participants", $result], 
            
        ];
    }

    public function headings(): array
    {
        return [];
    }
}