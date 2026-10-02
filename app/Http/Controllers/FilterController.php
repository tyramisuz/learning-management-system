<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Question;
use App\Models\Response;
use App\Models\Review;
use App\Models\Reviewquiz;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilterController extends Controller
{

    public function search(Request $request)
    {

        $quizzes = Quiz::with(['reviewquizzes','user', 'questions', 'responses', 'bookmarks', 'genre'])->get();
        

        $search = $request->search;
        $genres = $request->input('genres', []); 
        $durations = $request->input('durations', []); 
        $passgrades = $request->input('passgrades', []); 
        $sort = request()->input('sort', []); 
        
        $quizzes->each(function($quiz) {
            $quiz->userId = auth()->user()->id;
            $quiz->total_points = $quiz->questions->sum('point');
            $quiz->total_questions = $quiz->questions->count();
            $quiz->average = $quiz->reviewquizzes->avg('rating');
            $quiz->hours = floor($quiz->duration / 60);
            $quiz->minutes = $quiz->duration % 60;
            $quiz->iconUrl = $quiz->icon ? Storage::url($quiz->icon) : null;
            $quiz->imageUrl = $quiz->user->image ? Storage::url($quiz->user->image) : '/images/default.jpeg'; 
            $quiz->savestatus = $quiz->bookmarks->where('user_id', auth()->user()->id)->pluck('status')->first();
            // Check if the user has a response for this quiz
            $response = Response::where('quiz_id', $quiz->id)
                                ->where('user_id', $quiz->userId)
                                ->first();

            $quiz->action = $response ? 'retake' : 'take';
        });


        // Filter quizzes based on the search query
        $filteredQuizzes = $quizzes->filter(function($quiz) use ($search, $genres, $durations, $passgrades) {
            $searchMatch = stripos($quiz->title, $search) !== false
                || stripos($quiz->total_points, $search) !== false
                || stripos($quiz->publish_date, $search) !== false
                || stripos($quiz->total_questions, $search) !== false
                || stripos($quiz->average, $search) !== false
                || stripos($quiz->hours, $search) !== false
                || stripos($quiz->minutes, $search) !== false
                || stripos($quiz->passgrade, $search) !== false
                || stripos($quiz->action, $search) !== false;

                $genreMatch = empty($genres) || in_array($quiz->genre->name, $genres);
        
                $durationMatch = true;
                if (!empty($durations)) {
                    $durationMatch = false;
                    foreach ($durations as $duration) {
                        switch ($duration) {
                            case 'Less than 1 hour':
                                if ($quiz->hours < 1) $durationMatch = true;
                                break;
                            case '1 hour':
                                if ($quiz->hours == 1 && $quiz->minutes == 0) $durationMatch = true;
                                break;
                            case 'More than 1 hour':
                                if ($quiz->hours > 1) $durationMatch = true;
                                break;
                        }
                        if ($durationMatch) break;
                    }
                }
                $passgradeValue = (int) str_replace('%', '', $quiz->passgrade);
                $passGradeMatch = true;
                if (!empty($passgrades)) {
                    $passGradeMatch = false;
                    foreach ($passgrades as $passgrade) {
                        switch ($passgrade) {
                            case 'below 50%':
                                if ($passgradeValue < 50) {
                                    $passGradeMatch = true;
                                }
                                break;
                            case 'above 50%':
                                if ($passgradeValue >= 50) {
                                    $passGradeMatch = true;
                                }
                                break;
                        }
                        if ($passGradeMatch) break;
                    }
                }
                
                return $searchMatch && $genreMatch && $durationMatch && $passGradeMatch;
            });

            if (!empty($sort)) {
                foreach ($sort as $sortOption) {
                    switch ($sortOption) {
                        case 'Most Popular':
                            $filteredQuizzes = $filteredQuizzes->sortByDesc('participants');
                            break;
                        case 'Best Rating':
                            $filteredQuizzes = $filteredQuizzes->sortByDesc('average');
                            break;
                        case 'Newest':
                            $filteredQuizzes = $filteredQuizzes->sortByDesc('publish_date');
                            break;
                    }
                }
            }
            
            
        $filteredQuizzes = $filteredQuizzes->values()->all();

        return response()->json(['quizzes' => $filteredQuizzes]);
    }
    
    public function searchWelcome(Request $request)
    {

        $quizzes = Quiz::with(['reviewquizzes','user', 'questions', 'responses', 'bookmarks', 'genre'])->get();
        

        $search = $request->search;
        $genres = $request->input('genres', []); 
        $durations = $request->input('durations', []); 
        $passgrades = $request->input('passgrades', []); 
        $sort = request()->input('sort', []); 
        
        $quizzes->each(function($quiz) {
            // $quiz->userId = auth()->user()->id;
            $quiz->total_points = $quiz->questions->sum('point');
            $quiz->total_questions = $quiz->questions->count();
            $quiz->average = $quiz->reviewquizzes->avg('rating');
            $quiz->hours = floor($quiz->duration / 60);
            $quiz->minutes = $quiz->duration % 60;
            $quiz->iconUrl = $quiz->icon ? Storage::url($quiz->icon) : null;
            $quiz->imageUrl = $quiz->user->image ? Storage::url($quiz->user->image) : '/images/default.jpeg'; 
            // $quiz->savestatus = $quiz->bookmarks->where('user_id', auth()->user()->id)->pluck('status')->first();
            // Check if the user has a response for this quiz
            $response = Response::where('quiz_id', $quiz->id)
                                ->where('user_id', $quiz->userId)
                                ->first();

            $quiz->action = $response ? 'retake' : 'take';
        });


        // Filter quizzes based on the search query
        $filteredQuizzes = $quizzes->filter(function($quiz) use ($search, $genres, $durations, $passgrades) {
            $searchMatch = stripos($quiz->title, $search) !== false
                || stripos($quiz->total_points, $search) !== false
                || stripos($quiz->publish_date, $search) !== false
                || stripos($quiz->total_questions, $search) !== false
                || stripos($quiz->average, $search) !== false
                || stripos($quiz->hours, $search) !== false
                || stripos($quiz->minutes, $search) !== false
                || stripos($quiz->passgrade, $search) !== false
                || stripos($quiz->action, $search) !== false;

                $genreMatch = empty($genres) || in_array($quiz->genre->name, $genres);
        
                $durationMatch = true;
                if (!empty($durations)) {
                    $durationMatch = false;
                    foreach ($durations as $duration) {
                        switch ($duration) {
                            case 'Less than 1 hour':
                                if ($quiz->hours < 1) $durationMatch = true;
                                break;
                            case '1 hour':
                                if ($quiz->hours == 1 && $quiz->minutes == 0) $durationMatch = true;
                                break;
                            case 'More than 1 hour':
                                if ($quiz->hours > 1) $durationMatch = true;
                                break;
                        }
                        if ($durationMatch) break;
                    }
                }
                $passgradeValue = (int) str_replace('%', '', $quiz->passgrade);
                $passGradeMatch = true;
                if (!empty($passgrades)) {
                    $passGradeMatch = false;
                    foreach ($passgrades as $passgrade) {
                        switch ($passgrade) {
                            case 'below 50%':
                                if ($passgradeValue < 50) {
                                    $passGradeMatch = true;
                                }
                                break;
                            case 'above 50%':
                                if ($passgradeValue >= 50) {
                                    $passGradeMatch = true;
                                }
                                break;
                        }
                        if ($passGradeMatch) break;
                    }
                }
                
                return $searchMatch && $genreMatch && $durationMatch && $passGradeMatch;
            });

            if (!empty($sort)) {
                foreach ($sort as $sortOption) {
                    switch ($sortOption) {
                        case 'Most Popular':
                            $filteredQuizzes = $filteredQuizzes->sortByDesc('participants');
                            break;
                        case 'Best Rating':
                            $filteredQuizzes = $filteredQuizzes->sortByDesc('average');
                            break;
                        case 'Newest':
                            $filteredQuizzes = $filteredQuizzes->sortByDesc('publish_date');
                            break;
                    }
                }
            }
            
            
        $filteredQuizzes = $filteredQuizzes->values()->all();

        return response()->json(['quizzes' => $filteredQuizzes]);
    }

   public function searchUsers(Request $request)
   {
        $query = $request->get('query', '');
        $perPage = 5;

        $users = User::where('role', 'user')
                    ->where(function($q) use($query){
                    $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
                    })
                    ->paginate($perPage);

        // $users->getCollection()->transform(function ($user) {
        //     $user->imageUrl = $user->image ? Storage::url($user->image) : null;
        //     return $user;
        // });

        $users->each(function ($user){
            $user->imageUrl = $user->image ? Storage::url($user->image) : null;
            // dd($user->image);
        });
        
        // dd($users);
       return response()->json([
        'users' => $users->items(),
        'links' => $users ->links('pagination.custom')->render(),
        'currentPage' =>$users->currentPage(),
        'totalPages' => $users->lastPage(),
        ]);
   }

   public function searchQuizzes(Request $request)
   {
        $query = $request->get('query', '');
        $perPage = 5;

        $query = $request->get('query', '');
        $quizzes = Quiz::where('title', 'LIKE', "%{$query}%")
                    ->paginate($perPage);

        $quizzes->each(function ($quiz){
            $quiz->created_on = $quiz->created_at->format('M d, Y');
            // dd($quiz->created_on);
        });
        
        // dd($users);
       return response()->json([
        'quizzes' => $quizzes->items(),
        'links' => $quizzes ->links('pagination.custom')->render(),
        'currentPage' =>$quizzes->currentPage(),
        'totalPages' => $quizzes->lastPage(),
        ]);
   }

   public function searchGroups(Request $request)
   {
        $query = $request->get('query', '');
        $perPage = 5;

        $query = $request->get('query', '');
        $groups = Group::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->paginate($perPage);

        $groups->each(function ($group){
            $group->created_on = $group->created_at->format('M d, Y');
            // dd($group->created_on);
        });
    
       return response()->json([
        'groups' => $groups->items(),
        'links' => $groups ->links('pagination.custom')->render(),
        'currentPage' =>$groups->currentPage(),
        'totalPages' => $groups->lastPage(),
        ]);
   }
}
