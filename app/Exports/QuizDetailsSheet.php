<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Response;
use DB;
use Illuminate\Support\Facades\Log;

class QuizDetailsSheet implements FromArray, WithHeadings
{
    protected $quizId;


    public function __construct($quizId)
    {
        $this->quizId = $quizId;
    }

    public function array(): array
    {
        $quiz = Quiz::find($this->quizId);
        $hours = floor($quiz->duration / 60);
        $minutes = $quiz->duration % 60;

        $users = User::whereHas('responses', function ($query) {
            $query->where('quiz_id', $this->quizId);
        })->get();

        $questions = DB::table('questions')->where('quiz_id', $this->quizId)->get(['IsCorrect', 'id', 'point']);
        $correctAnswers = $questions->pluck('IsCorrect', 'id');
        $points = $questions->pluck('point', 'id');

        $totalScore = 0;
        $numberOfUsers = count($users);
        $highestScore = 0;
        $lowestScore = PHP_INT_MAX;

        $userScores = [];

        foreach ($users as $user) {
            $userId = $user->id;
            $userResponses = Response::where('user_id', $userId)->whereIn('question_id', $correctAnswers->keys())->get();
            $score = 0;
            foreach ($userResponses as $response) {
                if ($response->stuAns === $correctAnswers[$response->question_id]) {
                    $score += $points[$response->question_id];
                }
            }

            $totalpoints = $quiz->questions()->sum('point');
            $timeTaken = Response::where('quiz_id', $this->quizId)->where('user_id', $userId)->pluck('timeTaken')->first();
            $percentages = round(($score / $totalpoints) * 100);
            $userScores[] = [
                'user' => $user->name,
                'score' => $score,
                'percentage' => $percentages,
                'totalpoints' => $totalpoints,
                'timeTaken' => $timeTaken,
            ];
        }

        usort($userScores, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        $totalScore = array_sum(array_column($userScores, 'score'));
        $highestScore = $numberOfUsers > 0 ? max(array_column($userScores, 'score')) : 0;
        $lowestScore = $numberOfUsers > 0 ? min(array_column($userScores, 'score')) : 0;
        $averageScore = $numberOfUsers > 0 ? $totalScore / $numberOfUsers : 0;
        $aveScore = number_format($averageScore, '0', '', '');

        $passThreshold = $quiz->passgrade;
        $userScores = collect($userScores);

        $passCount = $userScores->filter(function ($userScore) use ($passThreshold) {
            return $userScore['percentage'] >= $passThreshold;
        })->count();

        Log::info($passCount);

        $failCount = $userScores->filter(function ($userScore) use ($passThreshold) {
            return $userScore['percentage'] <= $passThreshold;
        })->count();

        $passCount = $passCount ?? 0;
        $failCount = $failCount ?? 0;

        $exportArray = [
            
            ['Quiz Details'],
            ['Quiz Title','Average Score','Highest Score','Lowest Score','Duration','Total Points','Participants','Total Passed','Total Failed'],
            [ $quiz->title, $aveScore, $highestScore, $lowestScore, "{$hours}h {$minutes}m", $totalpoints, $numberOfUsers, $passCount, $failCount],
            [''],
            ['List Participants'],
            ['Name', 'Score', 'Percentage(%)', 'Total Points', 'Time Taken'],
            
        ];

        foreach ($userScores as $userScore) {
            $exportArray[] = [
                $userScore['user'],
                $userScore['score'],
                $userScore['percentage'],
                $userScore['totalpoints'],
                $userScore['timeTaken'],
            ];
        }
    
        return $exportArray;
    }

    public function headings(): array
    {
        return [];
    }
}