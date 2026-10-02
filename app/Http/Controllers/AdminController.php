<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Group;
use App\Models\Genre;
use App\Models\Participant;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function indexUser()
    {

        $users = User::where('role', 'user')->latest()->paginate(5);
        // dd($users);
        $i = ($users->currentPage() - 1) * $users->perPage();
        
        // dd($users);
        return view('admin.indexUser', compact('users', 'i'));
    }

    public function genre()
    {
        $genres = Genre::latest()->paginate(5);
        // dd($genres);
        $i = ($genres->currentPage()-1) * $genres->perPage();
        return view('admin.genre', compact('genres', 'i'));
    }

    public function indexQuiz($userId)
    {
        $name = User::where('id', $userId)->pluck('name')->first();
        $quizzes = Quiz::where('user_id', $userId)->latest()->paginate(5);
        $i = ($quizzes->currentPage() - 1) * $quizzes->perPage();
        
        // dd($users);
        return view('admin.indexQuiz', compact('quizzes', 'i', 'name'));
    }

    public function indexGroup($userId)
    {
        $name = User::where('id', $userId)->pluck('name')->first();
        
        $groupId = Participant::where('user_id', $userId)
        ->where('is_creator', true)
        ->pluck('group_id');
        
        $groups = Group::whereIn('id', $groupId)->latest()->paginate(5);
        $i = ($groups->currentPage() - 1) * $groups->perPage();

        // dd($users);
        return view('admin.indexGroup', compact('groups', 'i', 'name'));
    }
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.editUser', compact('user', 'id'));
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all());
        // dump($request->publish_date);
        // dd($request->status);
        $user = User::find($id);
        
        $request->validate([
            'name' => 'required|string',
            'gender' => 'required','in:Male, Female',
            'dob' => 'required','date', 
            'school' => 'required', 'string',
        ]);

        // $quiz = new Quiz();
        $user_data=[            
            'name' =>  $request->name,
            'gender' => $request->gender,
            'dateOfBirth' => $request->dob,
            'school' => $request->school,
        ];
        // dd($quiz_data);
        $user->update($user_data);
    
        // Check if the request contains the 'image' file and the user is authenticated
        if ($request->hasFile('image')) {
            $profileImage = $request->file('image');
            $imageName = Carbon::now()->format('Y-m-d_His').'.'.$profileImage->getClientOriginalExtension();

            // Store the image in the 'public/icon' directory
            $path = $profileImage->storeAs('public/profile', $imageName);
            $user->image = $path;
            $user->save();

            if (!$path) {
                return redirect()->back()->withErrors(['image' => 'Failed to store image']);
            }
        } else {
            // If the file is not received, return an error
            return redirect()->back()->withErrors(['image' => 'File not received']);
        }

        

        return redirect()->route('admin.indexUser')->with('success', 'User updated successfully.');
    }

    public function storeGenre(Request $request)
    {
        // dd($request->all());
        $request->validate ([
            'genre' => 'required'
        ]);

        Genre::create([
            'name'=> $request->genre,
        ]);

        return redirect()->back()->with('success', 'Genre added successfully');
    }

    public function archiveGenre($id)
    {
        $genre = Genre::find($id);
        // dd($genre);
        $genre->update(['status' =>'archived']);

        return redirect()->back()->with('success', 'Genre has been archived successfully');
    }

    public function unarchiveGenre($id)
    {
        // dd($id);
        $genre = Genre::find($id);
        // dd($genre);
        $genre->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Genre has been unarchived successfully');
    }

    public function destroyGroup($id)
    {
        $group = Group::find($id);
        $group->delete();

        return redirect()->back()->with('success', 'Group has been removed successfully');
    }

    public function blockUser($id)
    {
        $user = User::find($id);
        // dd($user);
        $user->update(['status' => 'blocked']);

        return redirect()->back()->with('success', 'User has been blocked');
    }

    public function unblockUser($id)
    {
        $user = User::find($id);
        // dd($user);
        $user->update(['status' => 'active']);

        return redirect()->back()->with('success', 'User has been unblocked');
    }

}
