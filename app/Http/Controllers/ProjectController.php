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
        // just testing out validation, this works, but it can be done better, using seperation of intrestes
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
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
