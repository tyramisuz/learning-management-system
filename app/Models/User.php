<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table="users";

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
    public function reviewquizzes()
    {
        return $this->hasMany(Reviewquiz::class);
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmarks::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'student_id');
    }

    public function createdGroups()
    {
        return $this->hasMany(Group::class, 'user_id');
    }
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    public function enrolledGroup()
    {
        return $this->belongsToMany(Group::class, 'participants');
    }

    public function groups_real()
    {
        return $this->belongsToMany(Group::class, 'participants', 'user_id', 'group_id')
                    ->withPivot('is_creator');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'user_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function createdAnnouncements()
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    public function receivedAnnouncements()
    {
        return $this->hasMany(AnnouncementRecipient::class);
    }

    public function invites()
    {
        return $this->belongsToMany(Group::class, 'invitations')
                    ->withPivot('status')
                    ->wherePivot('status', 'accepted');
    }

}
