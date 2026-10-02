<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded =[];
    protected $table = 'emailLogs';

    public function invitation()
    {
        return $this->hasMany(Invitation::class); 
    }
    public function Notification()
    {
        return $this->hasMany(Notification::class);
    }
    
}
