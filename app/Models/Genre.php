<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz;


class Genre extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];
    protected $table = 'genres';

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
