<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{ protected $fillable = [
    'project_id',
    'name'
];

public function project(){
    return Project::where('id', $this->project_id)->first();
    // $this->belongsTo('App\Models\Project');
}

    use HasFactory;
}
