<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectStoreRequest;


class ProjectController extends Controller
{

    public function index()
    {
        return Project::all();
    }

    public function findByName(string $name){
        return Project::where('name', 'LIKE', "%{$name}%")->get()->all();
    }


    public function store(ProjectStoreRequest $request)
    {
        $validData = $request->validated();
        Project::create($request->all());
    }

    public function show(int $id)
    {
        
        return Project::where('id', $id)->first();//Project::find($id);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return $project;
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete(); 
    }
}
