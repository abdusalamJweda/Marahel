<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id', 'receiver_id', 'project_id']; 

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\User');
    }
}
