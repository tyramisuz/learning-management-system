<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\Administration\QuizFactory;



class Quiz extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="quizzes";

    protected $guarded =[];

    public function user()
    {
        return $this-> belongsTo(User::class);
    }
    public function questions()
    {
        return $this-> hasMany(Question::class);
    }
    public function responses()
    {
        return $this -> hasMany(Response::class);
    }
    public function groupquizzes()
    {
        return $this->hasMany(Groupquiz::class);
    }
    public function reviewquizzes()
    {
        return $this->hasMany(Reviewquiz::class);
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

   

}
