<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Response;
use App\Models\Groupquiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class QuestionController extends Controller
{

    public function index($id)
    {
        
        $questions = Question::where('quiz_id', $id)->latest()->paginate(5);
        $i = ($questions->currentPage() - 1) * $questions->perPage();
        
        $points = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '20' ];
        
        $quiz = Quiz::with('questions')->findOrFail($id);
        $totalpoint = $quiz->questions()->sum('point');

        $creatorId = User::where('id', $quiz->user_id)->first();
        
        // Get the questions related to the quiz
        
        return view('questions.index', compact('quiz', 'questions', 'i', 'points', 'totalpoint', 'creatorId'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate input data
        $request->validate([
            'questions' => 'required|array',
            'questions.*.questiontype' => 'required',
            'questions.*.answertype' => 'required',
            'questions.*.point' => 'required',
            'questions.*.question' => 'required',
            'questions.*.iscorrect_text' => 'nullable|string',
            'questions.*.iscorrect_image' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'questions.*.answer_text.*' => 'nullable|string',
            'questions.*.multi_answer_text.*' => 'nullable|string',
            'questions.*.answer_image.*' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'questions.*.multi_answer_image.*' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'questions.*.correct_answers.*' => 'nullable|integer', 
        ]);

        $status = $request->status;
        $quiz = Quiz::find($request->quiz_id);
        $questions = $request->questions;

        foreach ($questions as $index => $questionData) 
        {
            $questionType = $questionData['questiontype'];
            // dd($questionData['media']);
            $answers = [];
            $correctAnswers = '';
            $correctAnswerArray = [];
            $mediaPath = null;
            
            // Handle single-choice correct answer
            if ($questionType == 'single-choice') {
                if (isset($questionData['iscorrect_text']) && !empty($questionData['iscorrect_text'])) {
                    $correctAnswers = $questionData['iscorrect_text'];
                } elseif ($request->hasFile("questions.0.iscorrect_image")) {
                    // dd($questionType);
                    $iscorrectImage = $request->file("questions.0.iscorrect_image");
                    $imageName = $iscorrectImage->getClientOriginalName();
                    $path = $iscorrectImage->storeAs('public/answerImage', $imageName);
                    $correctAnswers = $path;
                    // dd($correctAnswers);
                }
                
                $answers[]= $correctAnswers;
                // $correctAnswers = [];
                
                //answer text- single
                if(isset($questionData['answer_text'])){
                    // dd($questionData['answer_text']);
                    foreach($questionData['answer_text'] as $key =>$textAnswer){
                        if(!empty($textAnswer)){
                            $answers[] = $textAnswer;
                        }
                    }
                }

                //answer image - single
                // dd($questionData['answer_image']);
                if(isset($questionData['answer_image'])){
                    foreach($questionData['answer_image'] as $key =>$imageAnswer){
                        if($request->hasFile("questions.0.answer_image.$key")){
                            $answerImage = $request->file("questions.0.answer_image.$key");
                            $answerImageName = $answerImage->getClientOriginalName();
                            $path2 = $answerImage->storeAs('public/answerImage', $answerImageName);
                            $answers[] = $path2;
                        }
                    }
                }
                $correctAnswerCount = 1;
            }
            
            // Handle multiple-choice answers
            else if ($questionType == 'multiple-choice') {
                $correctAnswerArray = [];

                if (isset($questionData['multi_answer_text'])) {
                    foreach ($questionData['multi_answer_text'] as $key => $textAnswer) {
                        if (!empty($textAnswer)) {
                            $answers[] = $textAnswer;
                            // dd($answers);
                        }
                    }
                }

                if (isset($questionData['multi_answer_image'])) {
                    foreach ($questionData['multi_answer_image'] as $key => $imageAnswer) {
                        if ($request->hasFile("questions.$index.multi_answer_image.$key")) {
                            $answerImage = $request->file("questions.$index.multi_answer_image.$key");
                            $answerImageName = $answerImage->getClientOriginalName();
                            $path2 = $answerImage->storeAs('public/answerImage', $answerImageName);
                            $answers[] = $path2;
                        }
                    }
                }


                // Handle correct answers
                if (isset($questionData['correct_answers'])) {
                    foreach ($questionData['correct_answers'] as $correctIndex) {
                        $correctAnswerArray[] = $answers[$correctIndex] ?? null;
                    }
                }
                
                $correctAnswerCount = count(array_filter($correctAnswerArray, fn($answer) => !empty($answer)));
                $correctAnswers = implode(',', $correctAnswerArray);
            }


            $answersJson = json_encode($answers);
            // dump($answersJson);
            // dd($correctAnswers);
            // $correctAnswersJson = json_encode($correctAnswers);
            // dd($correctAnswersJson);

            // Handle media file
            if ($request->hasFile("questions.$index.media")) {
                // dd('ada');
                $request->validate([
                    'questions.*.media' => 'nullable|file|mimes:jpg,jpeg,png,svg,mp4,mkv,mp3|max:20480', // (20MB)
                ]);

                $attachMedia = $request->file("questions.$index.media");
                $mediaName = Carbon::now()->format('Y-m-d_His') . '.' . $attachMedia->getClientOriginalExtension();
                $mediaPath = $attachMedia->storeAs('public/media', $mediaName);

                if (!$mediaPath) {
                    return redirect()->back()->withErrors(['error' => 'Failed to store media']);
                }
            }

            // dd(gettype($correctAnswers), $correctAnswers);
            $question_data = [
                'quiz_id' => $request->quiz_id,
                'type' => $questionData['questiontype'],
                'answertype' => $questionData['answertype'],
                'point' => $questionData['point'],
                'question' => $questionData['question'],
                'media' => isset($mediaPath) ? $mediaPath : null,
                'answer' => $answersJson,
                'IsCorrect' => $correctAnswers, 
                'totalCorrect' => $correctAnswerCount,
            ];
            Question::create($question_data);
        }
        // dd($question_data);

        $quiz->update(['status' => $status, 'publish_date' => $request->publish_date]);

        return redirect()->route('quizzes.index', ['quiz' => $request->quiz_id])->with('success', 'Questions created successfully');
    }
    
    public function create($quiz_id)
    {
    
      $quiz = Quiz::findOrFail($quiz_id);
      $points = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
      '11', '12', '13', '14', '15', '16', '17', '18', '19', '20' ];
    
      $questions = Question::where('quiz_id', $quiz->id)->get();
    
    
      return view('questions.create', compact('quiz', 'points', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'questiontype' => 'required',
            'answertype' => 'required',
            'point' => 'required',
            'question' => 'required',
            'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mp3|max:2048',
            'answer_text.*' => 'nullable|string',
            'multi_answer_text.*' => 'nullable|string',
            'answer_image.*' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'multi_answer_image.*' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'correct_answers.*' => 'nullable|integer', 
        ]);

        $status = $request->status;
        // dd($status);
        $quiz = Quiz::find($request->quiz_id);
        $questions = $request->questions;
        $question = Question::find($id);

        if (!$question) {
            return redirect()->back()->withErrors(['error' => 'Question not found']);
        }

            $questionType = $request->questiontype;
            $answers = [];
            $correctAnswers = '';
            $correctAnswerArray = [];
            $mediaPath = null;
        
            if ($questionType == 'single-choice') {
                $answers = [];
                $correctAnswerArray = [];
            
                // $existingAnswers = json_decode($question->answer, true); 
                // $answers = $existingAnswers ?: [];
            
                if ($request->answertype == 'text' && $request->has('answer_text')) {
                    foreach ($request->answer_text as $key => $textAnswer) {
                        if (!empty($textAnswer)) {
                            if (!in_array($textAnswer, $answers)) {
                                $answers[] = $textAnswer;
                            }
                        }
                    }
                }
            
                if ($request->hasFile('answer_image')) {
                    foreach ($request->file('answer_image') as $key => $imageAnswer) {
                        $imageName = $imageAnswer->getClientOriginalName();
                        $path = $imageAnswer->storeAs('public/answerImage', $imageName);
                        $answers[$key] = $path; 
                    }
                }
            
                if ($request->correct_answers !== null) {
                    $correctIndex = (int) $request->correct_answers;  
                    $correctAnswers = $answers[$correctIndex] ?? null;
                    // dd($correctAnswers);
                }
            
                $correctAnswerCount = 1; 
                $answersJson = json_encode($answers); 
            
                $question->update([
                    'answer' => $answersJson,
                    'IsCorrect' => $correctAnswers,
                    'totalCorrect' => $correctAnswerCount
                ]);
            } 
            

            else if ($questionType == 'multiple-choice') {
                $answers = []; 
                $correctAnswerArray = []; 
            
                if ($request->has('multi_answer_text')) {
                    foreach ($request->multi_answer_text as $key => $textAnswer) {
                        if (!empty($textAnswer)) {
                            if (!in_array($textAnswer, $answers)) {
                                $answers[] = $textAnswer;
                            }
                        }
                    }
                }
            
                if ($request->hasFile('multi_answer_image')) {
                    foreach ($request->file('multi_answer_image') as $key => $imageAnswer) {
                        $answerImageName = $imageAnswer->getClientOriginalName();
                        $path2 = $imageAnswer->storeAs('public/answerImage', $answerImageName);
                        if (!in_array($path2, $answers)) {
                            $answers[] = $path2; 
                        }
                    }
                }
            
                if ($request->correct_answers) {
                    foreach ($request->correct_answers as $correctIndex) {
                        if (isset($answers[$correctIndex]) && !in_array($answers[$correctIndex], $correctAnswerArray)) {
                            $correctAnswerArray[] = $answers[$correctIndex];
                        }
                    }
                    // dd('korek', $correctAnswerArray); 
                }
            
                $correctAnswerCount = count(array_filter($correctAnswerArray, fn($answer) => !empty($answer)));
            
                $correctAnswers = implode(',', $correctAnswerArray);
            
                $answersJson = json_encode($answers);
            
                $question->update([
                    'answer' => $answersJson, 
                    'IsCorrect' => $correctAnswers, 
                    'totalCorrect' => $correctAnswerCount
                ]);
            }
            
            

            $question_data = [
                'quiz_id' => $request->quiz_id,
                'type' => $request->questiontype,
                'answertype' => $request->answertype,
                'point' => $request->point,
                'question' => $request->question,
            ];
            $question->update($question_data);

            if ($request->hasFile('media')) {
                // dd('ada');
                $request->validate([
                    'media' => 'nullable|file|mimes:jpg,jpeg,png,svg,mp4,mkv,mp3|max:20480', // (20MB)
                ]);

                $attachMedia = $request->file('media');
                $mediaName = Carbon::now()->format('Y-m-d_His') . '.' . $attachMedia->getClientOriginalExtension();
                $mediaPath = $attachMedia->storeAs('public/media', $mediaName);

                if (!$mediaPath) {
                    return redirect()->back()->withErrors(['error' => 'Failed to store media']);
                }

                $media = ['media' => isset($mediaPath) ? $mediaPath : 'NULL'];
                $question->update($media);
            }
            // dd('media',$mediaPath);


        return redirect()->route('questions.index', ['quiz' => $quiz->id])->with('success', 'Questions updated successfully');
    }

    public function storeEdit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'type' => 'required',
            'question' => 'required',
            'answer' => 'required|array',
            'iscorrect' => 'required',
            'point' => 'required'
        ]);

        $correctAns = $request->iscorrect;
        // dd($correctAns);
        $answers = $request->input('answer');

        if (!is_null($correctAns)) {
            $answers[] = $correctAns;
        } else {
            dd('Correct answer is null');
        }

        $answers = array_filter($answers, function ($value) {
            return !is_null($value);
        });

        $answersJson = json_encode(array_values($answers));
        

        $questionData = [
            'type' => $request->type,
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
            'answer' => $answersJson,
            'IsCorrect' => $correctAns,
            'point' => $request->point,
        ];

        $question = Question::create($questionData);

        $quiz = Quiz::find($request->quiz_id);

        $totalpoint = $quiz->questions()->sum('point');

        return redirect()->route('questions.index', ['quiz' => $request->quiz_id])->with('success', 'Question created successfully');
    }
    
    //answer form
    public function show($id, $groupId=null)
    {
        // dd($groupId);
        $quiz = Quiz::find($id);
        // dd($quiz);
        if($quiz->status == 'inactive')
        {
            return redirect()->back()->with('error', 'Sorry, the quiz has been deleted.');
        }
        $quizzes = Quiz::all(); // Fetching all quizzes
        $questions = Question::where('quiz_id', $id)->get();

        $answers = [];
        
        
        foreach($questions as $question){
            $answer = json_decode($question->answer);
            $question->answer = collect($answer)->shuffle()->all();
            if($question->media != null){
                $question->media = $question->media;
            }
            $correct = $question->totalCorrect;
            // dd($correct);
        }

        $hours = floor($quiz->duration / 60);
        $minutes = $quiz->duration % 60;
        $totalminutes= ($hours * 60) + $minutes;
        $remainingminutes = $totalminutes;
        $totalDuration = $totalminutes;
        $progressPercentage = (($totalDuration - $remainingminutes) / $totalDuration) * 100;


        $progressPercentage = ($totalminutes / $totalDuration) * 100;

        $dueDate = Groupquiz::where('quiz_id', $quiz->id)
                        ->pluck('dueDate')
                        ->first();
                        // dd($dueDate);

        if ($dueDate == Carbon::now()) {
            // dd('jadi jer');
            Log::info('Redirecting back with error: Sorry, this quiz is no longer available.');
            return redirect()->back()->with('error', 'Sorry, this quiz is no longer available.');
        }
                        


        return view('questions.show', compact('quiz', 'quizzes','questions', 'hours', 'minutes','totalminutes', 'totalDuration', 'progressPercentage', 'remainingminutes', 'groupId'));
    }
    
    public function edit(Question $question, $id)
    {
        $question = Question::find($id);
        $quiz = $question->quiz;
    
        $points = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'];
    
        $answers = json_decode($question->answer);
        // dump($answers);
        $totalAnswer = count($answers);
        // dd($totalAnswer);
        $correctAnswers = array_map('trim', explode(',', $question->IsCorrect));
        // dd($correctAnswers);
    
        return view('questions.edit', compact('question', 'points', 'quiz', 'answers', 'correctAnswers', 'totalAnswer'));
    }
    

    public function destroy($id)
    {
        $question =Question::find($id);
        // $quizId = $question->quiz_id;
        if($question)
        {
            $quizId = $question->quiz_id;
            $questionpoint = $question->point;
            // dump('qp', $questionpoint);
            $question->delete();

            $totalpoint = Question::where('quiz_id', $quizId)->sum('point');
            // dd($totalpoint);
            $newpoint = $totalpoint - $questionpoint;
        }
        
        // dd($quizId);
        return redirect()->route('questions.index', $quizId)
        ->with('totalpoints', $totalpoint)
        ->with('success','Question deleted successfully');
    }

    public function delete($id)
    {
        Question::find($id)->delete();
  
        return back();
    }
}
