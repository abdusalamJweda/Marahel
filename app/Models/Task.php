<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'todo', 
        'due_date',
        'phase_id',
        'status',
        'created_at',
        'updated_at',
        'user_id',
        'project_id'
    ];
    public function user (){
        return $this->belongsTo('App\Models\User');
    }
    
    public function phase(){
        return $this->belongsTo('App\Models\Phase');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
}
