<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Announcement extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "announcements";

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function recipients()
    {
        return $this->hasMany(AnnoucementRecipients::class);
    }
}
