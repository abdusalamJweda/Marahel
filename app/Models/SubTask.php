<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'removed',
        'status',
        'created_at',
    ];
    public function task(){
        return $this->belongsTo('App\Models\Task');
    }
    public function phase(){
        return $this->belongsTo('App\Models\Phase');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
