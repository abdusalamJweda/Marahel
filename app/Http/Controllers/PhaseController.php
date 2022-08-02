<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use Illuminate\Http\Request;
use App\Http\Requests\PhaseStoreRequest;


use App\Models\Project;
use App\Models\Task;

use Illuminate\Http\Response;
use App\Models\Role;

use App\Http\Requests\ProjectStoreRequest;
use Illuminate\Support\Facades\DB;


class PhaseController extends Controller
{

    public function findPhasesByProjectId(Request $request){
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];

        $fileds = $request->validate([
            'project_id' => 'required'
        ]);
        $fileds['project_id'] = $fileds['project_id'] + 0;
        $phases = Phase::where('project_id', $fileds['project_id'])->get()->all();
        // $phases = Phase::all();

        return response($phases);
    }
    public function index()
    {
        // Phase::withTrashed()->get()->all(); to get with deleted
        $phases = Phase::all();
        return $phases;
    }
    public function findByName(Request $request)
    {

        $userId = auth()->user()->currentAccessToken()->tokenable['id'];

        $fileds = $request->validate([
            
            'phase_name' => 'required'
            
            
        ]);
        
        $phases = Phase::where('name', 'LIKE', "%{$fileds['phase_name']}%")->get()->all();

        return response($phases);
    }
    public function store(Request $request)
    {
        //$userId = array('user_is' => auth()->user()->currentAccessToken()->tokenable['id']);
        
        $fileds = $request->validate([
            'project_id' => 'required',
            'name'=> 'required',
            'description'=> 'required',
            // 'due_date'=> 'required',
            // 'user_id' =>'required'
        ]);

        
        $phase = Phase::create($fileds);

        return response([
            $phase
        ], 200);
    }
    public function show(Request $request)
    {
        
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];
        $fileds = $request->validate([
            'phase_id' => 'required',
        ]);


        $phase = Phase::where('id', $fileds['phase_id'])->first();

        $tasks = Task::where('phase_id', $fileds['phase_id'])->get()->all();
        
        $response = [
            "phase" => $phase,
            "tasks" => $tasks
        ];
        return $response;

        
    }
    public function update(Request $request)
    {

        $fileds = $request->validate([
            'phase_id' => 'required',
            'project_id' => 'required',
            'user_id' => 'required',
            'name' => '',
            'description'=>'',
            'due_date' => '',
            'status' => '',
        ]);
        $phase = Phase::findOrFail($fileds['phase_id']);
        
        $phase->update($fileds);
        // dd($project);
        return $phase;

    }
    public function destroy(Request $request)
    {
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];
        $fileds = $request->validate([
            'phase_id' => 'required',
        ]);

        $phase = Phase::findOrFail($fileds['phase_id']);
        if($phase->project()->user()->id != auth()->user()->currentAccessToken()->tokenable['id']){
            return response([
                "message" => "you donot have permission"
            ]);
        }

        $phase->delete();

        return response([
            "message" => "phase Deleted"
        ], 200);
    }

}
