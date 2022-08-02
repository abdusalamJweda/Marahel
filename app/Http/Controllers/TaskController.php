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
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];

        $fileds = $request->validate([
            'phase_id' => 'required'
        ]);
        $fileds['phase_id'] = $fileds['phase_id'] + 0;
        $phases = Task::where('phase_id', $fileds['phase_id'])->get()->all();

        return response($phases);
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

    public function store(TaskStoreRequest $request)
    {
        $validData = $request->validated();
        Task::create($request->all());
    }

    public function show($id)
    {
        return Task::findOrFail($id);
        
    }

    public function update(Request $request, Task $task)
    {
        $task = Task::find($id);
        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {

        $task = Task::findOrFail($id);
        $task->delete(); 
    }
}
