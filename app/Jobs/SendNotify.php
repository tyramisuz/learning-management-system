<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NotifyMail;
use App\Models\EmailLog;
use Mail;

class SendNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quizLink;
    public $user;
    public $groupName;
    public $quizName;
    public $dueDate;
    public $notificationId;
    /**
     * Create a new job instance.
     */
    public function __construct($quizLink, $user, $groupName, $quizName, $dueDate, $notificationId)
    {
        $this->quizLink = $quizLink;
        $this->user = $user;
        $this->groupName = $groupName;
        $this->quizName = $quizName;
        $this->dueDate= $dueDate;
        $this->notificationId = $notificationId;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $link = $this->quizLink;
        $user = $this->user;
        $gName = $this->groupName;
        $qName = $this->quizName;
        $due = $this->dueDate;
        $id = $this->notificationId;

        try{
            Mail::to($user->email)->send(new NotifyMail($link, $user, $gName, $qName, $due));
            EmailLog::create([
                'notification_id' => $id,
                'job' => get_class($this),
                'response' => json_encode('Email success'),
            ]);

        }
        catch(\Exception $e){
            EmailLog::create([
                'notification_id' => $id,
                'job' => get_class($this),
                'response' => json_encode($e->getMessage()),
            ]);
            
        }
        
    }
}
