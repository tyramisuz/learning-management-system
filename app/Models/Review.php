<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "reviews";

    public function reviewquizzes()
    {
        return $this->hasMany(Reviewquiz::class);
    }

}
