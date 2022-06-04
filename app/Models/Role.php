<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'project_id'
    ];

    public function project(){
        return Project::where('id', $this->project_id)->first();
        // $this->belongsTo('App\Models\Project');
    }
    public function user(){
        return User::where('id', $this->project_id)->first();
        // $this->belongsTo('App\Models\User');
    }
}
