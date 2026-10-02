<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "groups";

    public function groupquizzes()
    {
        return $this->hasMany(Groupquiz::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function creator_real()
    {
        // Retrieve the participant who is the creator
        $participant = $this->participants()->where('is_creator', true)->first();
    
        if ($participant) {
            // Return the user associated with the participant
            return $participant->user;
        }
    
        return null; // Handle case where no creator participant is found
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'participants', 'group_id', 'user_id')
                    ->withPivot('is_creator');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'group_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'invitations')
                    ->withPivot('status')
                    ->wherePivot('status', 'accepted');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

}
