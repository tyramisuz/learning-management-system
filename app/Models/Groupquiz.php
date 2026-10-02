<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Groupquiz extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "groupquizzes";
    protected $guarded = [];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function reviewquizzes()
    {
        return $this->hasMany(Reviewquiz::class, 'quiz_id');
    }
}
