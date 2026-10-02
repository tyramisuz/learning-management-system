<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reviewquiz extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "reviewquizzes";
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function groupquizzes()
    {
        return $this->belongsTo(Groupquiz::class, 'quiz_id');
    }
}
