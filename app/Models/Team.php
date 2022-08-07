<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;

class Team extends Model
{ 
    protected $appends = ['members'];
    
    
    protected $fillable = [
    'project_id',
    'name'
];

public function getMembersAttribute(){
   
    
    $roles = Role::where('team_id', $this->id)->pluck('user_id')->toArray();
    
    $users = User::whereIn('id', $roles)->get();
    
    return $users;
}


public function roles(){

    return $this->hasMany('App\Models\Role');
}

    use HasFactory;
}
