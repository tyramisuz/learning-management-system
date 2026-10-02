<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Invitation;
use App\Models\Notification;
use App\Models\Participant;
use App\Models\User;
use App\Models\Group;
use App\Jobs\SendInvite;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;


class InvitationController extends Controller
{
    public function invite(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $groupId = $id;
        // dd($groupId);

        $request->validate([
            'student_email' => 'required|string',
        ]);

        // Find the group
        $group = Group::find($groupId);

        if (!$group) {
            return redirect()->route('groups.manage', $id)->with('error', 'Group not found');
        }

        $emails = explode(',', $request->student_email);

        foreach($emails as $email)
        {
            $email = trim($email);
            // Create the invitation
            $invitation = Invitation::create([
                'user_id' => $userId,
                'group_id' => $groupId,
                'student_email' => $email,
                'status' => 'pending'
            ]);
            // dump($invitation);
    
            $student = User::where('email', $email)->first();
            // dd($student);
    
            $invitation->update(['student_id'=> $student->id]);
    
            if ($student) {
                    $Notification = Notification::create([
                        'user_id' => $student->id,
                        'sender_id' => auth()->user()->id,
                        'invitation_id' => $invitation->id,
                        'message' => 'invited you to join the group:',
                        'type' => 'invite',
                        'group_name' => $group->name,
                        'is_read' => false,
                    ]);
                    // dd($Notification);
            }
    
            $inviteLink = route('groups.accept.get', $invitation->id);
            $groupName = $group->name;
            $senderName = auth()->user()->name;
    
            SendInvite::dispatch($inviteLink, $groupName, $senderName, $student, $invitation->id);
        }

        return redirect()->route('groups.manage', $id)->with('success', 'Invitation sent successfully');
    }

    public function accept($id)
    {
        // dump($id);
        $invitation = Invitation::find($id);
        // dd($invitation);
        $invitation->update(['status'=>'accepted']);
        $groupId = $invitation->group_id;
        // dd($groupId);

        Participant::create([
            'user_id' => auth()->user()->id,
            'group_id' => $groupId,
            'is_creator' => false,
        ]);
        $status = $invitation->status;
        // dd($status);


        return redirect()->route('notifications.index')->with('success', 'Invitation accepted');
    }

    public function inviteQr()
    {
        $token = Str::random(32);
        $url = route('groups.show', ['token' => $token]);
    
        // Save the token to the database associated with the group
        GroupInvitation::create([
            'group_id' => $groupId,
            'token' => $token,
        ]);
    
        $qrCode = QrCode::size(300)->generate($url);
    
        return view('group.invite', compact('qrCode', 'url'));
    }

    public function processInvite($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation) {
            return redirect()->route('home')->with('error', 'Invalid invitation link.');
        }

        $user = auth()->user();
        $group = Group::find($invitation->group_id);

        // Check if the student is already in the group
        if ($group && !$group->students()->where('user_id', $user->id)->exists()) {
            $group->students()->attach($user->id);
        }

        // Update the invitation status and student_id
        $invitation->update([
            'status' => 'accepted',
            'student_id' => $user->id,
            'student_email' => $user->email,
        ]);

        // Redirect to the group page
        return redirect()->route('groups.show', ['id' => $group->id])->with('success', 'You have joined the group.');
    }

    public function generateInviteQrCode($groupId)
    {
        $token = Str::random(32);
        $url = route('group.invite', ['token' => $token]);

        Invitation::create([
            'group_id' => $groupId,
            'user_id' => auth()->id(),  
            'student_email' => null,  
            'status' => 'pending',  
            'token' => $token,  
        ]);

        $qrCode = QrCode::size(300)->generate($url);

        return view('group.invite', compact('qrCode', 'url'));
    }

}