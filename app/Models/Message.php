<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;
    protected $appends = ['receiver'];
    protected $fillable = ['message', 'user_id', 'receiver_id']; 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function getReceiverAttribute(){
        $user = User::find($this->receiver_id);
        return $user;
    }
}
