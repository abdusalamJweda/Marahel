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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return Project::create($request->all());
    }

    public function show(int $id)
    {
        return Project::find($id);
    }

    public function edit(Project $project)
    {
        //
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
