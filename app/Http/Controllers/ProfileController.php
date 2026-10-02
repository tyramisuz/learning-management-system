<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }



        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function uploadImage(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();

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

        // Redirect back with error if image upload failed or user is not authenticated
        return redirect()->back()->withErrors(['image' => 'Image upload failed']);
    }
}
