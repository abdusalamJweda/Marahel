<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phase;
use App\Models\Task;
class AssignedTo extends Model
{   use HasFactory;

    protected $fillable = [
    'team_id',
    'phase_id',
    'status'];

    public function teams(){
        return Teams::where('id', $this->team_id)->first();
        // $this->belongsTo('App\Models\Project');
    }
    public function Phase(){
        return Phase::where('id', $this->Phase_id)->first();
        // $this->belongsTo('App\Models\Project');
    }
    
}
