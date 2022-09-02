<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
 
    public function index()
    {
        return Task::all();
    }
    public function findPTasksByPhaseId(Request $request){

        $fileds = $request->validate([
            'phase_id' => 'required'
        ]);

        $fileds['phase_id'] = $fileds['phase_id'] + 0;
        $tasks = Task::where('phase_id', $fileds['phase_id'])->get()->all();

        return response($tasks);
    }
    public function changeStatus(Request $request){

        $userId = auth()->user()->currentAccessToken()->tokenable['id'];


        $fileds = $request->validate([
            'task_id' => 'required',
            'status' => 'required'
        ]);
        $fileds['task_id'] = $fileds['task_id'] + 0;

        $task = Task::find($fileds['task_id']);
        // dd($task['id']);
        $task->update(array('status' => $fileds['status']));
        return $task;

    }

    public function store(Request $request)
    {
        $fileds = $request->validate([

            'project_id'=>'required',
            'phase_id' => 'required',
            'name'=> 'required',
            'description'=> 'required',
            'due_date'=> 'required',
            'phase_id' => 'required',
            
        ]);

       $Tasks = Task::create($fileds);

       return response([
        $Tasks
    ], 200);
    }

    public function show($id)
    {
        return Task::findOrFail($id);
        
    }

    public function update(Request $request)
    {
        $request = $request->validate([

            'name' => '',
            'id' => 'required',
            'description' => '',
            'due_date'=>'',
            'status' => ''

        ]);
        $task = Task::find($request['id']);
        $task->update($request);

        return $task;
    }

    public function delete(Request $request)
    {
        $user = $requst->user();

        $userId = auth()->user()->currentAccessToken()->tokenable['id'];
        $fileds = $request->validate([
            'task_id' => 'required',
        ]);

        $task = Task::findOrFail($fileds['task_id']);
        // if($task->project()->user()->id != $userId){
        //     return response([
        //         "message" => "you do not have permission"
        //     ]);
        // }

        $task->delete();

        return response([
            "message" => "task Deleted"
        ], 200);
    
    }

    public function destroy(Request $request)
    {
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];
        $fileds = $request->validate([
            'task_id' => 'required',
        ]);

        $task = Task::where('id',$fileds['task_id'])->get()->first();
        if($task->project()->user()->id != $userId){
            return response([
                "message" => "you do not have permission"
            ]);
        }

        $task->delete();

        return response([
            "message" => "task Deleted"
        ], 200);
    
    }
}
