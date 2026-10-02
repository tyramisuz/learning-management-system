<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Notification;
use App\Models\Participant;
use App\Models\User;
use App\Models\Group;
use App\Models\Quiz;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Models\AnnouncementRecipient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class AnnouncementController extends Controller
{
    public function manual(Request $request, $groupId)
    {
        // dd($groupId);
        $request->validate([
            'message' => 'required',
        ]);

        $announcement = Announcement::create([
            'title' => 'Teacher',
            'message' => $request->message, 
            'type'=> 'manual',
            'created_by'=> auth()->user()->id,
            'group_id' => $groupId,
        ]);

        // dd($announcement);
        // Send announcement to all accepted group members
        $groupMembers = Invitation::where('group_id', $groupId)
        ->where('status', 'accepted')
        ->get();
        // dd($groupMembers);
        foreach ($groupMembers as $member) {

        $resi = AnnouncementRecipient::create([
        'announcement_id' => $announcement->id,
        'user_id' => $member->user_id,

        ]);
        // dd($resi);
        }

        return redirect()->back()->with('success', 'Announcement sent successfully');
    }

    public function fetchAnnouncements($id)
    {
        // dd($id);
        $group = Group::find($id);
        $creator = Participant::where('group_id', $group->id)
        ->where('is_creator', true)
        ->pluck('user_id');
        $owner = User::where('id', $creator)
        ->first();
        // dd($owner);
        $ownerImage = $owner->image ? Storage::url($owner->image) : '/images/default.jpeg';

        $announcements = Announcement::where('group_id', $id)->orderBy('created_at', 'desc')->get();
        // dd($announcements);
        $announcements->transform(function ($announcement) {
            $announcement->image = $announcement->image ? Storage::url($announcement->image) : '/images/default.jpeg';
            $announcement->time = Carbon::parse($announcement->created_at)->format('h:iA');
            $announcement->date = Carbon::parse($announcement->created_at)->format('Y-m-d');
            return $announcement;
        });

        $groupedAnnouncements = $announcements->groupBy(function($announcement) {
            $created_at = Carbon::parse($announcement->created_at);
            if ($created_at->isToday()) {
                return 'Today';
            } elseif ($created_at->isYesterday()) {
                return 'Yesterday';
            } else {
                return $created_at->format('Y-m-d');
            }
        });

        return response()->json(['owner' => $owner,
        'groupedAnnouncements' => $groupedAnnouncements, 'ownerImage' => $ownerImage]); 
    }
}
