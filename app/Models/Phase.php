<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phase extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'project_id',
        'status',
        'created_at',

    ];
    
    public function project(){
        return Project::findOrFail($this->project_id);
        //  $this->belongsTo('App\Models\Project');
    }

    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }
}
