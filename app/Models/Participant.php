<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "participants";
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'user_id');
    }
}
