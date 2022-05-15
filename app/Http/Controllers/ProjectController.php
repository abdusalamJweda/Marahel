<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        Project::create($request->all());
    }

    public function show( $id)
    {
        
        return Project::where('name', $id)->first();//Project::find($id);
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
