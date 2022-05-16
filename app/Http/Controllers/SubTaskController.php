<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Illuminate\Http\Request;
use App\Http\Requests\SubTaskStoreRequest;

class SubTaskController extends Controller
{

    public function index()
    {
        return SubTask::all();
    }
    public function store(SubTaskStoreRequest $request)
    {
        $validData = $request->validated();
        SubTask::create($request->all());
    }

    public function show($id)
    {
        $subTask = SubTask::findOrFail($id);
        return $subTask;
    }

    public function update(Request $request, SubTask $subTask)
    {
        //
    }

    public function destroy($id)
    {
        $project = SubTask::findOrFail($id);
        $project->delete(); 
    }
}
