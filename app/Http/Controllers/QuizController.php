<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Genre;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use App\Models\Reviewquiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Log;


class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('user_id', auth()->user()->id)->where('status', '!=', 'inactive')->latest()->paginate(5);
        $i = ($quizzes->currentPage() - 1) * $quizzes->perPage();

        $quiz = Quiz::all();

        foreach($quizzes as $quiz)
        {
            $questions = Question::where('quiz_id', $quiz->id)
            ->get(['IsCorrect', 'id', 'point']);

            $quiz->totalpoints = $questions->sum('point');
        }

        // $user = User::where('id', '15')->first();
        // dd($user->password);
        $user = User::where('id', auth()->user()->id)->first();
        // dd($user);

        return view('quizzes.index', compact('quizzes', 'i', 'user'));
    }

    public function create(Quiz $quiz)
    {
        $genres = Genre::all();

        $lhours=['1 Hour',
        '2 Hours',
        '3 Hours',
        '4 Hours',
        '5 Hours',
        '6 Hours',
        '7 Hours',];

        $lminutes=['1 Minutes','2 Minutes','3 Minutes','4 Minutes','5 Minutes','6 Minutes','7 Minutes','8 Minutes','9 Minutes','10 Minutes',
        '11 Minutes','12 Minutes','13 Minutes','14 Minutes','15 Minutes','16 Minutes','17 Minutes','18 Minutes','19 Minutes','20 Minutes',
        '21 Minutes','22 Minutes','23 Minutes','24 Minutes','25 Minutes','26 Minutes','27 Minutes','28 Minutes','29 Minutes','30 Minutes',
        '31 Minutes','32 Minutes','33 Minutes','34 Minutes','35 Minutes','36 Minutes','37 Minutes','38 Minutes','39 Minutes','40 Minutes',
        '41 Minutes','42 Minutes','43 Minutes','44 Minutes','45 Minutes','46 Minutes','47 Minutes','48 Minutes','49 Minutes','50 Minutes',
        '51 Minutes','52 Minutes','53 Minutes','54 Minutes','55 Minutes','56 Minutes','57 Minutes','58 Minutes','59 Minutes',];

        $points = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '20' ];

        $questions = Question::where('quiz_id', $quiz->id)->get();

        $passing = ['10%', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '90%', '100%'];

        return view('quizzes.create', compact('quiz','lminutes', 'lhours', 'questions', 'points', 'passing', 'genres'));

    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'visibility' => 'required',
            'duration_hours' => ['required_with:duration_hours', 'nullable', 'min:0'], 
            'duration_minutes' => ['required_with:duration_minutes', 'nullable', 'min:0', 'max:59'], 
            'permission' => 'required',
            'passgrade' => 'required',
        ]);

        // Calculate total duration in minutes
        $hours = ($request->duration_hours) ? (int)$request->duration_hours : 0;
        $minutes = ($request->duration_minutes) ? (int)$request->duration_minutes : 0;
        $duration = ($hours * 60) + ($minutes);

        // Debug statement to check if the file is being received
        if ($request->hasFile('icon')) {
            $quizImage = $request->file('icon');
            $imageName = Carbon::now()->format('Y-m-d_His').'.'.$quizImage->getClientOriginalExtension();

            // Store the image in the 'public/icon' directory
            $path = $quizImage->storeAs('public/icon', $imageName);

            if (!$path) {
                return redirect()->back()->withErrors(['icon' => 'Failed to store image']);
            }
        }

        $genre = Genre::where('name', $request->genre)->pluck('id')->first();
        // dd($genre);
        
        $quiz_data = [
            'title' => $request->title,
            'genre_id' => $genre,
            'visibility' => $request->visibility,
            'duration' => $duration,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'permission' => $request->permission,
            'icon' => isset($path) ? $path : null,
            'passgrade' => $request->passgrade,
        ];
        // dd($quiz_data);
        $quiz = Quiz::create($quiz_data);

        return redirect()->route('questions.create', ['quiz_id' => $quiz->id])->with('success', 'Quiz created successfully.');
    }

    public function history()
    {
        $studentId = auth()->user()->id;
        // dump($studentId);
        $quizzes = Quiz::whereHas('responses', function ($query) use ($studentId){
            $query->where('user_id', $studentId);
        })->latest()->paginate(5);
        $i = ($quizzes->currentPage() - 1) * $quizzes->perPage();

        return view('quizzes.history', compact('quizzes'));
    }
    public function edit($id)
    {
        $questions = Question::latest()->paginate(5);
        $i = ($questions->currentPage() - 1) * $questions->perPage();
        
        $lhours=['0 hour',
                '1 Hour',
                '2 Hours',
                '3 Hours',
                '4 Hours',
                '5 Hours',
                '6 Hours',
                '7 Hours',];

        $lminutes=['1 Minutes','2 Minutes','3 Minutes','4 Minutes','5 Minutes','6 Minutes','7 Minutes','8 Minutes','9 Minutes','10 Minutes',
        '11 Minutes','12 Minutes','13 Minutes','14 Minutes','15 Minutes','16 Minutes','17 Minutes','18 Minutes','19 Minutes','20 Minutes',
        '21 Minutes','22 Minutes','23 Minutes','24 Minutes','25 Minutes','26 Minutes','27 Minutes','28 Minutes','29 Minutes','30 Minutes',
        '31 Minutes','32 Minutes','33 Minutes','34 Minutes','35 Minutes','36 Minutes','37 Minutes','38 Minutes','39 Minutes','40 Minutes',
        '41 Minutes','42 Minutes','43 Minutes','44 Minutes','45 Minutes','46 Minutes','47 Minutes','48 Minutes','49 Minutes','50 Minutes',
        '51 Minutes','52 Minutes','53 Minutes','54 Minutes','55 Minutes','56 Minutes','57 Minutes','58 Minutes','59 Minutes',];

       
        $points = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '20' ];

        $passing = ['10%', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '90%', '100%'];

        $quiz = Quiz::with('questions')->findOrFail($id);

        // Get the questions related to the quiz
        $questions = $quiz->questions;

        return view('quizzes.edit', compact('quiz','lminutes', 'lhours','questions', 'i', 'points' , 'passing'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dump($request->publish_date);
        // dd($request->status);
        $quiz = Quiz::find($id);
        
        $request->validate([
            'title' => 'required',
            'visibility' => 'required',
            'duration_hours' => ['required_with:duration_hours', 'nullable','min:0'], 
            'duration_minutes' => ['required_with:duration_minutes', 'nullable', 'min:0', 'max:59'],
            'permission' => 'required',
            'passgrade' => 'required',
        ]);

        $hours = ($request->duration_hours) ? (int)$request->duration_hours : 0;
        $minutes = ($request->duration_minutes) ? (int)$request->duration_minutes : 0;
        // dump($hours);
        // dd($minutes);

        // Calculate total duration in minutes
        $duration =($hours * 60) + ($minutes);
        // dd($duration);

        // $quiz = new Quiz();
        $quiz_data=[            

            'title' =>  $request->title,
            'visibility' => $request->visibility,
            'duration' => $duration,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'permission' => $request->permission,
            'passgrade' => $request->passgrade,
            'publish_date' =>$request->publish_date,

        ];
        // dd($quiz_data);
        $quiz->update($quiz_data);
    
        // dd($request->icon);
        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $productImage = $request->file('icon');
            $imageName = Carbon::now()->format('Y-m-d_His'). '.' . $productImage->getClientOriginalExtension();
            // Store the image in the 'public/icon' directory
            $path = $productImage->storeAs('public/icon', $imageName);
    
            if (!$path) {
                return redirect()->back()->withErrors(['icon' => 'Failed to store image']);
            }
            
            $quiz_icon = ['icon' => isset($path) ? $path : 'NULL'];
            $quiz->update($quiz_icon);

        }

        

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function showParticipants($id)
    {
        $quiz = Quiz::find($id);
        $firstparticipant = Response::where('quiz_id', $id)
            ->where('attempt', 1)
            ->select('user_id')
            ->distinct()
            ->count('user_id');
            // dump($firstparticipant);
            $subsequentparticipant = Response::where('quiz_id', $id)
            ->where('attempt', '>','1')
            ->select('user_id')
            ->distinct()
            ->count('user_id');
            // dd($subsequentparticipant);

        return view('quizzes.participants',compact('quiz', 'firstparticipant', 'subsequentparticipant'));
    }
    
    public function showFirst(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        $dateSubmit = $quiz->created_at->format('m/d/Y');
        $users = User::whereHas('responses', function ($query) use ($quiz) {
            $query->whereHas('question', function ($q) use ($quiz) {
                $q->where('quiz_id', $quiz->id);
            })->where('attempt', '=', '1');
        })->paginate(5);
        $i = ($users->currentPage() - 1) * $users->perPage();

        $totalpoints = $quiz->questions()->sum('point');
    
        $scores = [];
        $percentages = [];
        $formatted= [];
    
        foreach ($users as $user) {
            $responses = Response::whereHas('question', function ($query) use ($quiz) {
                $query->where('quiz_id', $quiz->id);
            })->where('user_id', $user->id)
            ->where('attempt', '=', '1')
            ->get();

            $attempt = $responses->pluck('attempt')->first();
            // dd($attempt);

            $userscore = $responses->sum('score');
            $scores[$user->id] = $userscore;
            
            if ($userscore> 0) {
                $percentages[$user->id] = round(($userscore / $totalpoints) * 100);
            } else {
                $percentages[$user->id] = 0;
            }

            $formatted[$user->id] = number_format($percentages[$user->id], 0, '','');
            // dd($formatted);
            
        }
        // dd($responses);
    
        return view('quizzes.firstparticipants', compact('quiz', 'users', 'totalpoints', 'scores', 'formatted', 'i', 'attempt', 'dateSubmit'));
    }

    public function showSubsequent(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        $dateSubmit = $quiz->created_at->format('m/d/Y');
        // dd($dateSubmit);
        $users = User::whereHas('responses', function ($query) use ($quiz) {
            $query->whereHas('question', function ($q) use ($quiz) {
                $q->where('quiz_id', $quiz->id);
            })->where('attempt', '>', '1');
        })->paginate(5);
        $i = ($users->currentPage() - 1) * $users->perPage();

    
        $totalpoints = $quiz->questions()->sum('point');
    
        $scores = [];
        $percentages = [];
        $formatted= [];
    
        foreach ($users as $user) {
            $responses = Response::whereHas('question', function ($query) use ($quiz) {
                $query->where('quiz_id', $quiz->id);
            })->where('user_id', $user->id)
            ->where('attempt', '>', '1')
            ->get();
    
            $attempt = $responses->pluck('attempt')->first();

            $userscore = $responses->sum('score');
            $scores[$user->id] = $userscore;
            
            if ($userscore> 0) {
                $percentages[$user->id] = round(($userscore / $totalpoints) * 100);
            } else {
                $percentages[$user->id] = 0;
            }

            $formatted[$user->id] = number_format($percentages[$user->id], 0, '','');
            // dd($formatted);
            
        }
    
        return view('quizzes.subsequentparticipants', compact('quiz', 'users', 'totalpoints', 'scores', 'formatted', 'i', 'attempt', 'dateSubmit'));
    }
      
    public function showQuiz($id)
    {
        $selectedQuiz = Quiz::findOrFail($id);
        return view('questions.show', compact('selectedQuiz'));
    }

    public function destroy($id)
    {
        // dd($id);
        $quiz = Quiz::find($id);
        $quiz->update(['status' => 'inactive']);
    
        return redirect()->back()->with('success','Quiz deleted successfully');
    }

    public function dashboard()
    {
        $quizzes = Quiz::with('reviewquizzes','user', 'questions', 'responses')->get();
        // dd($quizzes);
        $userRole = User::where('id',auth()->user()->id)->pluck('role')->first();
        // dd($userRole);

        $quizzes->each(function($quiz) {
            $quiz->total_points = $quiz->questions->sum('point');
            $quiz->questions = $quiz->questions->count();
            $quiz->average = $quiz->reviewquizzes->avg('rating');

            // Check if the user has a response for this quiz
                $response = Response::where('quiz_id', $quiz->id)
                ->where('user_id', auth()->user()->id)
                ->first();

            $quiz->action = $response ? 'retake' : 'take';
        });
        // dd($quizzes);
        
    
        return view('dashboard', compact('quizzes', 'userRole'));
    }
    
    public function duplicate($quizId)
    {
            $quiz = Quiz::find($quizId);

            $newQuiz = $quiz->replicate();
            $newQuiz->title = $quiz->title . '-(Copy)';
            $newQuiz->status = 'draft';
            $newQuiz->publish_date = null;
            $newQuiz->save();

            $questions = $quiz->questions;
            foreach($questions as $question)
            {
                $newQuestions = $question->replicate();
                $newQuestions->quiz_id = $newQuiz->id;
                $newQuestions->save();
            }

        return redirect()->route('quizzes.index')->with('success', 'Quiz duplicated successfully');
    }

    public function back()
    {
        return redirect()->back();
    }
    
    public function publish(Request $request,$id)
    {
        // dd('publish kkk');
        $quiz = Quiz::findOrFail($id);

        $quiz->update(['status'=> 'publish', 'publish_date' => $request->publish_date]);
        // dd($quiz);

        return redirect()->back()->with('success', 'Quiz published successfully.');
    }

    public function unpublish($id)
    {
        // dd('kkk');
        $quiz = Quiz::find($id);
        $quiz->update(['status'=> 'draft']);
        // dd($quiz);

        return redirect()->back()->with('success', 'Quiz unpublished successfully.');
    }
    
    public function sorting()
    {
        return view('sorting');
    }
    
}
