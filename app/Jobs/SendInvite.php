<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\InviteMail;
use App\Models\EmailLog;
use Mail;

class SendInvite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $inviteLink;
    public $groupName;
    public $senderName;
    public $student;
    public $inviteId;
    /**
     * Create a new job instance.
     */
    public function __construct($inviteLink, $groupName, $senderName, $student, $inviteId)
    {
        $this->inviteLink = $inviteLink;
        $this->groupName= $groupName;
        $this->senderName = $senderName;
        $this->student = $student;
        $this->inviteId = $inviteId;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $link = $this->inviteLink;
        $name = $this->groupName;
        $sName = $this->senderName;
        $stud = $this->student;
        $id = $this->inviteId;

        try{
            Mail::to($stud->email)->send(new InviteMail($link, $name, $sName, $stud));
            EmailLog::create([
                'invitation_id' => $id,
                'job' => get_class($this),
                'response' => json_encode('Email success'),
            ]);

        }
        catch(\Exception $e){
            EmailLog::create([
                'invitation_id' => $id,
                'job' => get_class($this),
                'response' => json_encode($e->getMessage()),
            ]);
        }
        
    }
}
