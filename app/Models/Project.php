<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;



class Project extends Model
{
    use HasFactory, SoftDeletes;

    // append getters to pass in json
    //protected $appends = ['progress'];

    protected $fillable = [
        'name',
        'description',
        'due_date',

        'removed',
        'status',
        'created_at',
        'user_id',
    ];

  

    // public function gettDurationAtrribute(){
    //     return due_date - created_at
    // }
  
    public function user(){

        return User::findOrFail($this->user_id);
        //$this->belongsTo('App\Models\User');
    }


    public function phases(){

        // return Phase::where('project_id', $this->id)->get();

        return $this->hasMany('App\Models\Phase');
    }

    public function tasks(){
        return Task::where('project_id', $this->id)->get();
        //$this->hasMany('App\Models\Task');
    }



    // protected static function newFactory()
    // {
    //     return ProjectsFactory::new();
    // }
}
