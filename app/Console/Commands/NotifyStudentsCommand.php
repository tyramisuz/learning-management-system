<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendNotify;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Participant;
use App\Models\Groupquiz;
use App\Models\Group;
use App\Models\User;
use App\Models\Response;
use App\Models\Notification;



class NotifyStudentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $notificationDate = $today->copy()->addDays(2);
        // Log::info($groupQuizzes);

        $groupQuizzes = Groupquiz::whereDate('dueDate',$notificationDate)->get();
        // $groups = Group::with('quizzes')->get();

        if($groupQuizzes->isNotEmpty())
        {
            foreach ($groupQuizzes as $groupQuiz) {
                $groupQuizzes = Groupquiz::with('quiz','group')->get();
                $group = $groupQuiz->group;
                $quiz = $groupQuiz->quiz;
    
                $participants = Participant::where('group_id', $group->id)
                                       ->where('is_creator', false)
                                       ->pluck('user_id');

                $users = User::whereIn('id', $participants)->get();
    
                foreach ($users as $user) {
    
                    $response = Response::where('quiz_id', $quiz->id)
                                        ->where('user_id', $user->id)
                                        ->first();

                
                Log::info("Running NotifyStudentsCommand");
                Log::info("Processing groupQuiz with name: " . $groupQuiz->name);
                Log::info("Notifying user with ID: " . $user->id);
    
                        if (!$response) {
                            $notification = Notification::create([
                                'user_id' => $user->id,
                                'message' => 'You have a pending quiz to take',
                                'group_name' => $group->name,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                                'deleted_at' => null,
                                'is_read' => 0,
                                'type' => 'quiz_reminder',
                                'sender_id' => null,
                            ]);
    
                            $quizLink = route('questions.show', $quiz->id);
                            $groupName = $group->name;
                            $quizName = $quiz->name;
                            $dueDate = Groupquiz::where('group_id', $group->id)->where('quiz_id', $quiz->id)->pluck('dueDate')->first();
                    
                            SendNotify::dispatch($quizLink, $user, $groupName, $quizName, $dueDate, $notification->id);
                        }
                    }
            }
        }

        $this->info('Notifications sent successfully.');
    }
}
