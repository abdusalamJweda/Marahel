<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function subTasks(){
        return $this->hasMany('App\Models\SubTasks');
    }
    public function phase(){
        return $this->belongsTo('App\Models\Phases');
    }
    public function project(){
        return $this->belongsTo('App\Models\Projects');
    }
}
