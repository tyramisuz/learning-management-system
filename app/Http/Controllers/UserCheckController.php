<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Group;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Invitation;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class UserCheckController extends Controller
    {
        public function checkUser(Request $request, $id)
        {
        //    dd($request->all());
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]);

            $group = Group::where('id', $id)->first();

            $user = User::where('email', $validatedData['email'])->first();

            if ($user) {
                if (Auth::attempt([
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                ])) {

                    Invitation::create([
                        'user_id' => $group->user_id,
                        'group_id' => $id,
                        'student_email' => $user->email,
                        'status' => 'accepted',
                        'student_id' =>$user->id,
                    ]);
                    Participant::create([
                        'user_id' =>$user->id,
                        'group_id' => $id,
                        'is_creator' => false,
                    ]);

                    $announce = Announcement::create([
                        'title' => $user->name,
                        'message' => ' has joined the group',
                        'type' => 'new_member',
                        'group_id' => $id,
                        'created_by' => null,
                    ]);
            
                    Notification::create([
                        'user_id' => $group->user_id,
                        'sender_id' => $user->id,
                        'invitation_id' => null,
                        'message' => 'accepted your invitation',
                        'type' => 'accept',
                        'group_name' => $group->name,
                        'is_read' => false,
                    ]);
                    return redirect()->route('groups.show', $id)->with('success', 'You have joined the group'); 

                } else {
                    return redirect()->back()->withErrors(['password' => 'Invalid credentials'])->withInput();
                }
            } else {
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']), 
                    'status' => 'active',
                ]);
                // dd($user);

                Auth::login($user);

                $Invitation = Invitation::create([
                    'user_id' => $group->user_id,
                    'group_id' => $id,
                    'student_email' => $user->email,
                    'status' => 'accepted',
                    'student_id' => $user->id
                ]);
                // dd($Invitation);
                Participant::create([
                    'user_id' =>$user->id,
                    'group_id' => $id,
                    'is_creator' => false,
                ]);

                $announce = Announcement::create([
                    'title' => $user->name,
                    'message' => ' has joined the group',
                    'type' => 'new_member',
                    'group_id' => $id,
                    'created_by' => null,
                ]);
        
                Notification::create([
                    'user_id' => $group->user_id,
                    'sender_id' => $user->id,
                    'invitation_id' => null,
                    'message' => 'accepted your invitation',
                    'type' => 'accept',
                    'group_name' => $group->name,
                    'is_read' => false,
                ]);

                return redirect()->route('groups.show', $id)->with('success', 'You have joined the group'); 
            }
        }

        public function entry($id)
        {
            return view('groups.userCheck', compact('id'));
        }
    }