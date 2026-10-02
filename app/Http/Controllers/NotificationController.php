<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Notification;
use App\Models\Participant;
use App\Models\User;
use App\Models\Group;
use App\Models\Announcement;
use App\Notifications\InvitationNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        // dd('nn');
        $notifications = Notification::where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        // dd($notifications);

        $unreadCount = $notifications->where('is_read', false)->count();
        // dd($unreadCount);

            $inviteId = null;
            $status= null;
            
        foreach ($notifications as $notification) {
            $invitation = Invitation::find($notification->invitation_id);
            // dump($invitation->status);
            if($notification->invitation_id !== null)
            {
                // dd($invitation);
                $notification->status = $invitation->status;
                // dd($notification->status);
            }
                $senderId = $notification->sender_id;
                // dd($senderId);
                $sender = User::select('name', 'image', 'email')
                    ->where('id', $senderId)
                    ->first();
                    // dd($sender);
                $group = Group::where('user_id', $notification->user_id)->first();
                // dd($group);
                $notification->sender = $sender;
                if($notification->sender && $notification->sender->image){
                    $notification->sender->image = Storage::url($notification->sender->image);
                } 
                // dd($notification->sender->name);
                $notification->group = $group;


            $group = Group::where('name', $notification->group_name)->first();
            // dump($group);
           if($group){
               $member = Participant::where('group_id', $group->id)->where('is_creator', false)->get();
               // dump($member);
            }
               $notification->time_ago = $notification->created_at->diffForHumans();
               $inviteId = $notification->invitation_id;
        }


        // dd('kk');
        $groupedNotifications = $notifications->groupBy(function ($notification) {
            $notificationDate = $notification->created_at->format('d-m-Y');
            $today = Carbon::now()->format('d-m-Y');
            $yesterday = Carbon::yesterday()->format('d-m-Y');
            if ($notificationDate === $today) {
                return 'Today';
            } elseif ($notificationDate === $yesterday) {
                return 'Yesterday';
            } else {
                return $notificationDate;
            }
        });

        if ($request->ajax()) {
            return response()->json([
                'notifications' => $notifications->items(), 
                'current_page' => $notifications->currentPage(),
                'next_page' => $notifications->hasMorePages() ? $notifications->currentPage() + 1 : null
            ]);
        }
        
        // dump($groupedNotifications);
        // dd($notifications);
        return view('notifications.index', compact('groupedNotifications', 'notifications', 'inviteId', 'unreadCount', 'status'));
    }

    // public function loadMore(Request $request)
    // {
    //     $page = $request->get('page', 1);

    //     $notifications = Notification::where('user_id', auth()->user()->id)
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10, ['*'], 'page', $page);

    //     $notificationsData = $notifications->map(function ($notification) {
    //         return [
    //             'created_at' => $notification->created_at->toDateTimeString(),
    //             'sender_name' => optional($notification->sender)->name,
    //             'sender_image' => optional($notification->sender)->image,
    //             'message' => $notification->message,
    //             'group_name' => $notification->group_name,
    //             'time_ago' => $notification->created_at->diffForHumans(),
    //             'is_read' => $notification->is_read,
    //         ];
    //     });

    //     return response()->json([
    //         'notifications' => $notificationsData,
    //         'next_page' => $notifications->hasMorePages() ? $notifications->currentPage() + 1 : null
    //     ]);
    // }

    public function getNewNotifications(Request $request) {
        $user = auth()->user();
        $lastFetchedId = $request->input('last_fetched');
    
        Log::info('Last Fetched ID: ' . $lastFetchedId);
    
        // Fetch new notifications based on the last fetched ID
        $query = Notification::where('user_id', $user->id);
        
        if ($lastFetchedId) {
            $query->where('id', '>', $lastFetchedId);
        }
    
        $notifications = $query->get();
    
        foreach ($notifications as $notification) {
            if ($notification->invitation_id) {
                $invitation = Invitation::find($notification->invitation_id);
                $notification->status = $invitation ? $invitation->status : null;
            }
    
            $sender = User::select('name', 'image', 'email')
                ->where('id', $notification->sender_id)
                ->first();
            $notification->sender = $sender;
    
            if ($notification->sender && $notification->sender->image) {
                $notification->sender->image = Storage::url($notification->sender->image);
            }
    
            $group = Group::where('user_id', $notification->user_id)->first();
            $notification->group = $group;
    
            $notification->time_ago = $notification->created_at->diffForHumans();
        }
    
        $groupedNotifications = $notifications->groupBy(function ($notification) {
            $notificationDate = $notification->created_at->format('d-m-Y');
            $today = Carbon::now()->format('d-m-Y');
            $yesterday = Carbon::yesterday()->format('d-m-Y');
            if ($notificationDate === $today) {
                return 'Today';
            } elseif ($notificationDate === $yesterday) {
                return 'Yesterday';
            } else {
                return $notificationDate;
            }
        });
    
        return response()->json([
            'notifications' => $notifications,
        ]);
    }
    
    

    public function fetchNotifications()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($notifications as $notification) {
            $invitation = Invitation::find($notification->invitation_id);
            if ($notification->invitation_id !== null) {
                $notification->status = $invitation->status;
            }
            // dd($notification->invitation->id);
            $senderId = $notification->sender_id;
            $sender = User::select('name', 'image', 'email')
                ->where('id', $senderId)
                ->first();
                // dd($sender);
            $group = Group::where('name', $notification->group_name)->first();
            if($sender){
                $notification->sender = $sender;
                if($notification->sender && $notification->sender->image){
                    $notification->sender->image = Storage::url($notification->sender->image);
                } 
            }
                $notification->group = $group;
                // dd($notification->group->name);
                $notification->time_ago = $notification->created_at->diffForHumans();
        }

        return response()->json($notifications);
    }

    public function accept($id)
    {
        // dd($id);
        // dd($invitation);
        $invitation = Invitation::find($id);
        if($invitation)
        {
            $invitation->update(['status'=>'accepted']);

            $groupId = $invitation->pluck('group_id')->first();
            // dd($groupId);
    
            $participant = Participant::create([
                'user_id' => auth()->user()->id,
                'group_id' => $groupId,
                'is_creator' => false,
            ]);
    
            $name = $participant->user->where('id', auth()->user()->id)->pluck('name')->first();
            
            $announce = Announcement::create([
                'title' => $name,
                'message' => ' has joined the group',
                'type' => 'new_member',
                'group_id' => $groupId,
                'created_by' => null,
            ]);
            $group = Group::find($groupId);
           
    
                Notification::create([
                    'user_id' => $invitation->user_id,
                    'sender_id' =>auth()->user()->id,
                    'invitation_id' => $invitation->id,
                    'message' => 'accepted your invitation',
                    'type' => 'accept',
                    'group_name' => $group->name,
                    'is_read' => false,
                ]);
    
    
            // dd($announce);
            // dd($status);

        }
        else
        {
            return response()->json(['error'=>'invitation not found.'], 404);
        }


        return redirect()->route('notifications.index')->with('success', 'You have joined the group');
    }

    public function reject($id)
    {
        $invitation = Invitation::find($id);
        $invitation->update(['status'=>'rejected']);

        $groupId = $invitation->pluck('group_id')->first();
        $group = Group::find($groupId);

            Notification::create([
                'user_id' => $invitation->user_id,
                'sender_id'=> auth()->user()->id,
                'invitation_id' => $invitation->id,
                'message' => 'rejected your invitation',
                'type' => 'reject',
                'group_name' => $group->name,
                'is_read' => false,
            ]);


        return redirect()->back();
    }

    public function markAsRead($id)
    {
        // dd($id);
        $notification = Notification::find($id);
        // dd($notification);
        $notification->update(['is_read' => true]);

        return redirect()->route('notifications.index');
    }

    public function readAll()
    {
        $userId = auth()->user()->id;
        $updated = Notification::where('user_id', $userId)->update(['is_read' =>true]);

        return response()->json(['success' => $updated]);

    }

    // public function loadItems(Request $request)
    // {
    //     $page = $request->query('page', 1);
    //     $itemsPerPage = 10;

    //     $items = Item::skip(($page - 1) * $itemsPerPage)
    //             ->take($itemsPerPage)
    //             ->get();

    //     return response()->json(['items'=>$items]);
    // }
}
