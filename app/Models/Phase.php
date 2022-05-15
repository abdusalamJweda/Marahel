<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'total_phases',
        'total_tasks',
        'removed',
        'status',
        'created_at',

    ];
    
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }
}
