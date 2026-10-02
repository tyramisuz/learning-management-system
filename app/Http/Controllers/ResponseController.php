<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Group;
use App\Models\Response;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResponseController extends Controller
{

    public function index($quizId)
    {
        $users = User::latest()->paginate(5);
        $i = ($users->currentPage() - 1) * $users->perPage();

        return view('quizzes.participants', compact('users', 'i'));
    }

    public function store(Request $request, $quizId, $userId, $groupId=null)
    {
        // dd($request->all());
        // dd($groupId);
        $stuAns = [];
        $existingAttempt = Response::where('user_id', $userId)
        ->where('quiz_id', $quizId)
        ->max('attempt');

        $attemptNumber = $existingAttempt ? $existingAttempt + 1 : 1;
        // dd($attemptNumber);

            // dd($request->all());
            // dd($request->timeTaken);
            $request->validate([
                'question_id' => 'required|array',
                'quiz_id' => 'required|integer',
                'timeTaken' => 'required|integer',
            ]);

    
            $quiz = Quiz::find($quizId);
            $ownerId = $quiz->user_id;
            $userId = auth()->id();
            $selectedAns = $request->stuAns;
            $questionIds = $request->question_id;
            foreach ($questionIds as $questionId) {
                if (isset($selectedAns[$questionId])) {
                    $selectedAnswer = $selectedAns[$questionId];
                    if (is_array($selectedAnswer)) {
                        if (count($selectedAnswer) > 1) {
                            $stuAns = implode(',', $selectedAnswer);                          
                        } else {
                            $stuAns = $selectedAnswer[0];
                        }
                    } else {
                        $stuAns = $selectedAnswer; 
                    }
                    if(!empty($stuAns)){
                        if ($userId !== $ownerId) {
                            $isFirstResponse = !Response::where('user_id', $userId)
                                ->where('quiz_id', $request->quiz_id)
                                ->exists();
                            $response_data = [
                                'user_id' => $userId,
                                'quiz_id' => $request->quiz_id,
                                'group_id' => $groupId,
                                'question_id' => $questionId,
                                'stuAns' => $stuAns,
                                'timeTaken' => $request->timeTaken,
                                'attempt' => $attemptNumber,
    
                            ];
        
                            $response = Response::create($response_data);
        
                            $question = Question::findOrFail($questionId);
                            
                            if ($question->totalCorrect > 1){
                                $correctAnswers = explode(',', $question->IsCorrect);
                                // $stuAnswer = explode(',', $response->stuAns);
                                $scoreCount = 0;
                                foreach($correctAnswers as $correctAnswer){
                                    $correct = Response::where(function($c) use($correctAnswer){
                                        $c->where('stuAns' ,'LIKE', '%'.$correctAnswer.'%');
                                    });
                                    if($correct){
                                        $scoreCount++;
                                    } 
                                }
                                $score = (($scoreCount / $question->totalCorrect) * $question->point);
                                // dd($score);
                            } else if($question->totalCorrect == 1){
                                // dd($isCorrect);
                                $score = ($response->stuAns == $question->IsCorrect) ? $question->point : 0;
                            }
        
                            $response->update(['score' => $score, 'totalCorrect' => $scoreCount ?? null]);
        
                                $participants=$quiz->increment('participants');
                                // dd($participants);
                            
                        }
                    }
                }
            }

            if($groupId)
            {
                $message='';
                $type = '';
                if($isFirstResponse == true){
                    $message = 'has completed the quiz';
                    $type = 'completed';
                } else if ($isFirstResponse == false) {
                    $message = 'has retake the quiz';
                    $type = 'retake';
                }
                $announce = Announcement::create([
                    'title' => auth()->user()->name,
                    'message' => $message,
                    'type' => $type,
                    'created_by' => null,
                    'group_id' =>$groupId,
                ]);

                // dd($isFirstResponse);
                // dump($message);
                // dd($type);
                $group = Group::find($groupId);
                Notification::create([
                    'user_id' => $ownerId,
                    'sender_id' => $userId,
                    'invitation_id' => null,
                    'message' => $message,
                    'type' => $type,
                    'group_name' => $group->name,
                    'is_read' => false,
                ]);
                // dd($announce);
            } 
            
            $totalParticipants= DB::table('responses')
                            ->where('quiz_id', $quizId)
                            ->distinct('user_id')
                            ->count('user_id');
            // dd($totalParticipants);
            $quiz->update(['participants' => $totalParticipants]);
            // dd($totalParticipants);

    
            if ($userId !== $ownerId && $quiz->permission == 'Yes') {
                return redirect()->route('report.view', ['userId'=>$userId, 'quizId'=>$request->quiz_id, 'attempt'=>$attemptNumber])
                    ->with('success', 'Quiz submitted successfully');
            }
            else{
                $redirectUrl = $request->input('redirect_url', url('/dashboard'));
    
                return redirect($redirectUrl)->with('success', 'You have practiced the quiz, Creator!');
            }
        
    }
    

    public function destroy(Question $question)
    {
        //model soft deletes
        if($question->trashed())
        {
            $question->forceDelete();
            return redirect()->to('/products');
        }

        $question->delete();
    
        return redirect()->route('question.index')
                        ->with('success','Question deleted successfully');
    }

    public function delete($id)
    {
        Question::find($id)->delete();
  
        return back();
    }
}

