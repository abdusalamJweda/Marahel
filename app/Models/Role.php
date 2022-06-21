<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teams;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'team_id'
    ];

    public function team(){
        return Teams::where('id', $this->project_id)->first();
        // $this->belongsTo('App\Models\Project');
    }
    public function user(){
        return User::where('id', $this->project_id)->first();
        // $this->belongsTo('App\Models\User');
    }
}
