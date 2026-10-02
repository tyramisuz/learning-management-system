<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Reviewquiz;
use App\Models\Response;
use App\Models\Quiz;
use App\Models\Participant;
use App\Models\Groupquiz;
use App\Models\Invitation;
use App\Models\Notification;
use App\Models\Announcement;
use App\Models\AnnouncementRecipient;
use Carbon\Carbon;
use App\Notifications\InvitationNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Http\Controllers\PushNotifications;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;




class GroupController extends Controller
{
    public function sidenav()
    {
        $groups = Group::all();
        return view('sidenav', compact('groups'));
    }

    public function index()
    {
        $groups = Group::whereHas('participants', function($query){
            ($query)->where('user_id', auth()->user()->id)
            ->where('is_creator', true);
        })
        ->get();
        // dd($groups);

        $userId = auth()->user()->id;
        $creator = true; 

        $id= null;
        foreach($groups as $group){
            $id = $group->id;
            // dd($group->color);
        }

        return view('groups.index', compact('groups', 'userId', 'creator', 'id'));
    }

    public function create()
    {
        $quizzes = Quiz::all();

        return view('groups.create', compact('quizzes'));
    }

    protected $colorCodes = [
        '#ffb3ba',
        '#ffdfba',
        '#ffffba',
        '#baffc9',
        '#bae1ff',
        '#CCF1FF',
        '#E0D7FF',
        '#FFCCE1',
        '#D7EEFF',
        '#FAFFC7',
        '#9FE2BF',
        '#40E0D0',
        '#40E0D0',
        '#40E0D0',
        '#40E0D0',
        '#40E0D0',
        '#DBE9FA',
        '#E6E6FA',
        '#7BCCB5',
        '#A0D6B4',
        '#FFFFCC',
        '#FAEBD7',
        '#F5DEB3',

    ];

    protected function getColorFromList()
    {
        // Retrieve all existing group colors
        $usedColors = Group::pluck('color')->toArray();

        // Filter out used colors from the color list
        $availableColors = array_diff($this->colorCodes, $usedColors);

        // If all colors are used, you can reset and use from the beginning or handle as per your logic
        if (empty($availableColors)) {
            $availableColors = $this->colorCodes;
        }

        // Pick a random color from the available colors
        return $availableColors[array_rand($availableColors)];
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $randomColor = $this->getColorFromList();
        // dd($randomColor);

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $randomColor,
            'user_id' => auth()->user()->id,
        ]);
        // dd($group);

        Participant::create([
            'user_id' =>auth()->user()->id,
            'group_id' => $group->id,
            'is_creator' => true,
        ]);

        return redirect()->route('groups.index')->with('success', 'Group successfully created');
    }

    public function invitationCancel(Request $request, $id)
    {
        // dump('user',$id);
        // dd('group', $request->group_id);
        $group = $request->group_id;
        // dd($group);
        $invitation = Invitation::find($id);
        $invitation->delete();
        // dd($invitation);

        return redirect()->route('groups.invitationStatus', $group)->with('success', 'Invitation canceled successfully');
    }
    public function invitationStatus($id)
    {
        // dump($id);
        $invitations = Invitation::with('user', 'participant')->where('group_id', $id)->paginate(5);
        // dd($invitations);
        
        $group = Group::find($id);
        // dd($group);

        $i = ($invitations->currentPage() - 1) * $invitations->perPage();


        return view('groups.invitationStatus', compact('invitations', 'i', 'id', 'group'));
    }

    public function manageGroup($id)
    {
        // dd($id);
        $members = Participant::where('group_id', $id)->where('is_creator', false)
        ->paginate(5);
        
        $i = ($members->currentPage() - 1) * $members->perPage();

        $group = Group::find($id);
        // dd($group);

        
        return view('groups.manageGroup', compact( 'id', 'group', 'members', 'i'));
    }

    public function shareLink($id)
    {

        $url = route('groups.join',  $id);

        return response()->json([
            'url' => $url,
        ]);
    }

    public function shareCode($id)
    {
        $group = Group::find($id);
        if(auth()->user()->id == $group->user_id)
        {
            $code = Str::random(6);
            if($group->code != null){
                $group->update(['code'=>$code]);
            } else {
                $group->code = $code;
                $group->save();
            }
        }
        else{
            return response()->json(['error' => 'You are not authorized.'], 404);
        }

    
        return response()->json(['code' => $group->code]);
    }
    
    public function joinGroup(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $group = Group::where('code', $request->code)->first();
        // dd($group);

        if (!$group) {
            return redirect()->back()->with(['error' => 'Invalid group code. Please try again.']);
        }

        $participant = Participant::where('user_id', auth()->user()->id)->where('group_id', $group->id)->where('is_creator', false)->get();
        // dd($participant);
        if ($participant->isNotEmpty()) {
            return redirect()->back()->with(['error' => 'You are already a member of this group.']);
        }

        // $group->students()->attach(Auth::id());
        Participant::create([
            'user_id' => auth()->user()->id,
            'group_id' => $group->id,
            'is_creator' => false,
        ]);

        return redirect()->route('groups.show', $group->id)->with('success', 'You have successfully joined the group!');
    
    }

    public function edit($id)
    {
        $group = Group::find($id);
        // dd($group);

        return view('groups.edit', compact('group', 'id'));
    }
    public function manageQuiz($id)
    {
        $group = Group::find($id);
        $dueDate = [];

        $groupquizzes = Groupquiz::where('group_id', $id)
        ->where('status', 'active')
        ->with('quiz')->paginate(5); 
        // dd($groupquizzes);
        $quizzes = $groupquizzes->pluck('quiz');
        // dd($quizzes);
        $i = ($groupquizzes->currentPage() - 1) * $groupquizzes->perPage();

        foreach($groupquizzes as $groupquiz)
        {
                $visibility = $groupquiz->quiz->visibility;
                // dd($visibility);
                $participant = $groupquiz->quiz->participants;

        }
        // foreach($quizzes as $quiz)
        // {
        //     dd($quiz->title);
        // }

        return view('groups.manageQuiz', compact('group', 'groupquizzes', 'quizzes', 'i', 'id'));
    }

    public function members($groupId, $quizId)
    {
        // dump('group', $groupId);
        // dd('quiz', $quizId);
        $quiz = Quiz::find($quizId);
        $members = Participant::where('group_id', $groupId)->where('is_creator', false)
        ->paginate(5);
        // dd($members);

        $responses = [];
        $status= null;
        $i = ($members->currentPage() - 1) * $members->perPage();
        $status = null;
        foreach ($members as $member) {
            $response = Response::where('group_id', $groupId)
                        ->where('quiz_id', $quizId)
                        ->where('user_id', $member->user->id)
                        ->first();
                        
            $totalAttempts = Response::where('quiz_id', $quizId)->where('user_id', $member->user->id)->distinct('attempt')->count('attempt');
            // dd($totalAttempts);
            if ($response) {
                $status = 'assigned';
                $attempt = $response->attempt; 

            } else {
                $status = 'missing';
                $attempt = null; 
            }
        
            $responses[] = [
                'member' => $member,   
                'status' => $status,
                'attempt' => $attempt, 
                'totalAttempts' => $totalAttempts,
            ];
        }
        
        // dd($responses);

        $group = Group::find($groupId);
        return view('groups.members', compact('members', 'i', 'group', 'status','quizId', 'groupId', 'responses'));
    }


    public function enroll_real()
    {
        $user = Auth::user();
        // dd($user);
        // $enrolledGroups = $user->groups()->where('user_id', $user->id)->where('is_creator', false)->get(); 
        $enrolledGroups = $user->invitations()->where('status', 'accepted')->get();
        // $enrolledGroups = Participant::where('user_id', $user->id)->where('is_creator', false)->get(); 
        // dd($enrolledGroups);
        $groupIds = [];
        $creatorIds = [];

        // dd($enrolledGroups);
        // dump($enrolledGroups);
        
        // foreach($enrolledGroups as $enrolledGroup)
        // {
        //     $enrolledGroup->creator = Group::where('id', $enrolledGro->id)->pluck('name')->first(); 
        //     // dd($enrolledGroup->creator);
        // }
        // dd($creators);
        
        foreach ($enrolledGroups as $enrolledGroup) {
            $groupIds[] = $enrolledGroup->group_id; 
            $creatorIds[] = $enrolledGroup->user_id; 
            // dd($creatorIds);
        }
        
        $groups = !empty($groupIds) ? Group::whereIn('id', $groupIds)->get() : collect();
        $creators = !empty($creatorIds) ? User::whereIn('id', $creatorIds)->get() : collect();
        // dd($creators);

        foreach ($enrolledGroups as $enrolledGroup) {
            $enrolledGroup->group = $groups->where('id', $enrolledGroup->group_id)->first();
            $enrolledGroup->creator = $creators->where('id', $enrolledGroup->user_id)->first();
            $id = $enrolledGroup->id; 
            // dd($enrolledGroup->creator);
        }
        
        // dd($enrolledGroup->creator);

        return view('groups.enroll', compact('enrolledGroups', 'id'));
    }

    public function enroll()
    {
        $userId = auth()->id();

        $groupData = [];
        $enrolledGroups = Participant::where('user_id', $userId)
            ->where('is_creator', false) 
            ->with(['group.creator']) 
            ->get();

        foreach($enrolledGroups as $enrolledGroup)
        {
            // dd($enrolledGroup);
            $gpid = $enrolledGroup->group_id;
            $group = Group::where('id', $gpid)->first();
            if($group){
                $user = User::where('id', $group->user_id)->first();
                $groupData[] = ([
                    'group_name' => $group->name,
                    'creator_name' => $user->name,
                    'creator_image' => $user->image,
                    'join_date' => $enrolledGroup->created_at,
                    'group_id'=> $group->id,
                    'group_color' => $group->color,
                ]);
                // dd($groupData['group_color']);
                $groupId = $group->id;
            }
        }


        return view('groups.enroll', compact('groupData','groupId'));
    }

    public function leaveGroup($id)
    {
        // dd($id);
        $userId = auth()->user()->id;
        $invitation = Invitation::where('student_id', $userId)
        ->where('group_id', $id)
        ->first();
        // dd($invitation);

        $invitation->delete();

        return redirect()->route('groups.enroll')->with('success', 'You have left the group');

    }

    public function update(Request $request, $id)
    {
        $group = Group::find($id);

        $request->validate([
            'name' => 'required',
            'description'=> 'required',
        ]);

        $group_data = [
            'name' =>$request->name,
            'description' => $request->description,
        ];

        $group->update($group_data);

        return redirect()->back()->with('success', 'Group updated successfully');

    }
    
    public function editAssignment($id, $groupId)
    {
        // dd($groupId);
        $group = Group::find($id);
        $groupquiz = Groupquiz::where('group_id', $groupId)->where('quiz_id', $id)->first();
        // dd($groupquiz);
        $quizzes = Quiz::where('id', $id)->get();
        // dump($quizzes);

        $quiz = Quiz::where('id', '!=', $id)->get();
        // dd($quiz);
        return view('groups.editAssignment', compact('quiz', 'quizzes', 'groupquiz', 'id', 'groupId'));
    }

    public function updateAssignment(Request $request, $id, $groupId)
    {
        $groupquiz = Groupquiz::where('quiz_id', $id);

        // dd($groupquiz);
        // dd($request->all());
        $request->validate([
            'quiz_id' => 'required',
            'dueDate'=> 'required',
        ]);

        $quiz_data = [
            'quiz_id' => $request->quiz_id,
            'dueDate'=> $request->dueDate,
        ];

        $groupquiz->update($quiz_data);

        return redirect()->route('groups.edit', $groupId )->with('success', 'Assignment updated successfully');

    }
    public function assignBack(Request $request,$quiz)
    {
        $id= $request->group_id;
        $groupquiz = Groupquiz::where('quiz_id', $quiz)
        ->where('group_id', $request->group_id)->update(['status'=> 'active']);

        return redirect()->route('groups.manageQuiz', $id)->with('success', 'The quiz is activated');
    } 

    public function assign($id)
    {
        $groups = Group::find($id);
        $quizzes = Quiz::all();

        return view('groups.assignQuiz',  compact('groups', 'quizzes'));
    }

    public function assignQuiz(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'dueDate'=> 'required',
            'quiz_id' => 'required',
        ]);
        
         Groupquiz::create([
            'dueDate' => $request->dueDate,
            'group_id' =>$request->group_id,
            'quiz_id' => $request->quiz_id,
            'status' => 'active',
        ]);

        $announce = Announcement::create([
            'title' => auth()->user()->name,
            'message' => 'has assign a quiz',
            'type' => 'new_quiz',
            'created_by' => null,
            'group_id' =>$request->group_id,
        ]);

        $groupName = Group::where('id' , $request->group_id)->pluck('name')->first();
        // dd($request->group_id);
        $groupMembers = Participant::where('group_id', $request->group_id)->where('is_creator', false)->get();
        // dd($groupMembers);
        foreach($groupMembers as $member)
        {
            $notifications = Notification::create([
                'user_id' => $member->user_id,
                'sender_id' => auth()->user()->id,
                'invitation_id' => null,
                'message' => 'has assign the quiz',
                'type' => 'assign_quiz',
                'group_name' => $groupName,
                'is_read' => false,
            ]);

        }
        // dd($notifications);

        return redirect()->route('groups.index')->with('success', 'Quiz successfully assigned');
    }

    public function unassignQuiz(Request $request,$quiz)
    {
        $id = $request->group_id;
        $groupquiz = Groupquiz::where('quiz_id', $quiz)
        ->where('group_id',$request->group_id)->update(['status'=>'inactive']);

        return redirect()->route('groups.manageQuiz', $id)->with('success', 'Quiz unassigned successfully');
    }

    public function quizContent($groupId, $quizId)
    {
        // dump(auth()->user()->id);
        // dd($quizId);
        $quiz= Quiz::where('id', $quizId)->with('reviewquizzes', 'questions', 'groupquizzes')->first();
        $rate = $quiz->reviewquizzes->avg('rating');

        $group = Group::find($groupId);
        $points = $quiz->questions->sum('point');
        $questions = $quiz->questions->count('question');
        $date = $quiz->groupquizzes->pluck('dueDate')->first();
        // dd($date);

        $response = Response::where('quiz_id', $quizId)
                ->where('user_id', auth()->user()->id)
                ->first();

        $action = $response ? 'retake' : 'take';
                // dd($action);
        // dd($groupId);

        return view('groups.quizContent',compact('group', 'quiz', 'rate', 'points', 'questions', 'date', 'action', 'groupId'));
    }
    
    public function show($id)
    {
        
        $quiz= Quiz::latest()->paginate(5);
        $i = ($quiz->currentPage() - 1) * $quiz->perPage();
       
        $group = Group::find($id);
        $groupquizzes = Groupquiz::where('group_id', $id)->with('quiz')->get();
        $quizzes = Groupquiz::where('group_id', $id)->where('status', 'active')->with('quiz')->get()->pluck('quiz');
        // dd($quizzes);
        $creator = Participant::where('group_id', $group->id)
        ->where('is_creator', true)
        ->pluck('user_id');
        $owner = User::where('id', $creator)
        ->first();

        $quizzes->each(function($quiz) {
            $response = Response::where('quiz_id', $quiz->id)
                    ->where('user_id', auth()->user()->id)
                    ->first();

            $attempNumber = $response->attempt;
            // dd($attempNumber);
    
            $quiz->action = $response ? 'retake' : 'take';
            // dd($quiz->action);
        });
        // dd($quiz->action);
        // dd($owner);

        // dd($groupquizzes);
        // $quiz = $groupquizzes->quiz;
        $announcements = Announcement::where('group_id', $id)->orderBy('created_at', 'desc')->get();

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
        // dd($announcements);
        return view('groups.show',compact('group', 'i', 'quiz', 'groupquizzes', 'quizzes', 'owner', 'id', 'groupedAnnouncements'));
    }

    public function destroy($id)
    {
        // dd($id);
        $group = Group::find($id);

        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted Successfully');
    }

    public function memberDestroy(Request $request,$id)
    {
        // dump('memid',$id);
        $groupId = $request->group_id;
        $participant = Participant::where('user_id', $id)->where('is_creator', false)
        ->where('group_id', $groupId)
        ->first();
        // dd($participant);
        
        $participant->delete();
        // dd($groupId);

        return redirect()->route('groups.manage', $groupId)->with('success', 'Member deleted Successfully');
    }


}
