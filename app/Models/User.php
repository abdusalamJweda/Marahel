<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//  not used yet
    public function assginedToProjects(){

        $userRoles = Role::where('user_id', $this->id)->pluck('project_id')->toArray();
        $assignedProjects = Project::whereIn('id', $userRoles)->orderBy('created_at', 'DESC')->get();
        return $assignedProjects;
    }



    public function projects(){
        return Project::where('user_id', $this->id)->get();
    
        // $this->hasMany('App\Models\Project');
    }

    public function phases(){

        //define user_id in migration first

        // return Phase::where('user_id', $this->id)->get();
        // $this->hasMany('App\Models\Phase');
    }

    public function tasks(){
        return Task::where('user_id', $this->id)->get();
        // $this->hasMany('App\Models\Task');
    }

    public function roles(){
        return Role::where('user_id', $this->id)->get();
        // $this->hasMany('App\Models\Role');
    }
}
