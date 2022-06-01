<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;

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

    public function user(){
        return $this->belongsTo('App\Models\user');
    }

    public function pahses(){
        return $this->hasMany('App\Models\Phase');
    }

    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }



    // protected static function newFactory()
    // {
    //     return ProjectsFactory::new();
    // }
}
