<?php

namespace App\Jobs;

use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use App\Models\Reviewquiz;
use App\Models\Review;
use Illuminate\Support\Facades\View;

class ExportStudentReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $quizId;
    protected $exportId;

    public function __construct($quizId, $exportId)
    {

        $this->quizId = $quizId;
        $this->exportId = $exportId;
    }
    
    public function handle()
    {
        $export = Export::find($this->exportId);
        $quizId = $this->quizId;
        $userId = $export->user_id;

        if($export)

        try {
            $passMark = Quiz::where('id', $quizId)->pluck('passgrade')->first();
            preg_match('/\d+/', $passMark, $matches);
            $passMarkNumber = $matches[0];
            $participants = Quiz::where('id', $quizId)->pluck('participants')->first();
            // dd($participants);
            // dump($passMarkNumber);
            $quiz = Quiz::with('questions')->find($quizId);
            // dd($quiz);
            $user = User::find($userId);

            $responses = DB::table('responses')
                ->where('quiz_id', $quizId)
                ->where('user_id', $userId)
                ->where('attempt', '=', '1')
                ->get()
                ->keyBy('question_id');
                // dd($responses);

                $attempt = $responses->pluck('attempt')->first();
                // dd($attempt);
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
                    ->where('responses.attempt', '=', '1')
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
            ->where('attempt', '=', '1')
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

            $currentAttemptDate = $responses->where('attempt', $attempt)->first();
            $createdAt = \Carbon\Carbon::parse($currentAttemptDate->created_at);

            $view = View::make('report.pdf', compact(
                'quiz', 
                'user',
                'userId', 
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
                'totalpoints',
                'participants',
                'attempt',
                'createdAt',
            ))->render();
            
                    $pdf = Browsershot::html($view)
                    ->format('A4')
                    ->margins(0.5,0.5,0.5,0.5)
                    ->paper('A4')
                    ->waitUntilNetworkIdle()
                    ->setDelay(5000)
                    // ->waitForFunction('()')
                    ->pdf();
                    
                    $filePath = $export->file_path;

                    // if (!$filePath) {
                    //     throw new \Exception('File path is not set.');
                    // }

                    Storage::disk('public')->put($filePath, $pdf);
                    $export->update(['status' => 'success']);

                    // Log::info('Storing PDF at: ' . $filePath);
                    
                    
                    Log::info('PDF generated and saved successfully for export ID: ' . $this->exportId);
                    
        } catch (\Exception $e) {
            $export->update([
                'status' => 'failed',
                'response' => $e->getMessage(),
                'failed_at' => now(),
            ]);

            Log::error('PDF generation failed for export ID: ' . $this->exportId . ' with error: ' . $e->getMessage());
   
        }


    }
}
