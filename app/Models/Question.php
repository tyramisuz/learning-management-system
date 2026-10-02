<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="questions";
    protected $guarded=[];

    public function responses()
    {
        return $this-> hasMany(Response::class);
    }
    
    public function quiz()
    {
        return $this-> belongsTo(Quiz::class);
    }
}