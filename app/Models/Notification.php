<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'notifications';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
