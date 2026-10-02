<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female'],
            'dob' =>['required', 'date'],
            'school' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'gender' =>$request->gender,
            'dateOfBirth' => $request->dob,
            'school'=> $request ->school,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=> 'active',
        ]);
        
        // $user ->auth()->user();
        
        $userId = $user->id;
        // $roleName = 'student';
        // $role = Role::where('name', $roleName)->first();

        // $user->roles()->attach($role);

        event(new Registered($user));
        
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
