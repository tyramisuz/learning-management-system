<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded =[];
    protected $table = 'invitations';

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function creator()
    {
        return $this ->belongsTo(User::class, 'user_id');
    } 
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
    public function participant()
    {
        return $this->hasMany(Participant::class, 'user_id');
    }

    public function emailLog()
    {
        return $this->belongsTo(EmailLog::class);
    }

}
