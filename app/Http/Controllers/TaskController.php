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
