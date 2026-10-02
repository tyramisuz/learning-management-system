<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Response extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="responses";

    protected $guarded =[];

    public function question()
    {
        return $this -> belongsTo(Question::class);
    }

    public function quizzes()
    {
        return $this -> belongsTo(Quiz::class);
    }
    public function user()
    {
        return $this -> belongsTo(User::class);
    }
    public function group()
    {
        return $this -> belongsTo(Group::class);
    }
}