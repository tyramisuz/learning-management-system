<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
     /**
     * Retrieve password for a user based on email.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function retrievePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('id', '15')->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        dd($user->password);
        return view('quizzes.index', compact(['password' => $user->password]));
    }
}
