<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Phase;
use Illuminate\Http\Response;
use App\Models\Role;
use App\Models\Teams;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectStoreRequest;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{

    
    public function index()
    {
        // Project::withTrashed()->get()->all(); to get with deleted
        $projects = Project::all();
        return $projects;
    }

    public function assignedProjects($userId){
        $userRoles = Role::where('user_id', $userId)->pluck('project_id')->toArray();
        $assignedProjects = Project::whereIn('id', $userRoles)->orderBy('created_at', 'DESC')->get();
        return $assignedProjects;

    }

    public function recentProjects(){

        


        $userId = auth()->user()->currentAccessToken()->tokenable['id'];


        $userProjects = Project::where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
        
        $userRoles = Role::where('user_id', $userId)->pluck('team_id')->toArray();
        $userTeams = Teams::where('id', $userRoles)->pluck('project_id')->toArray();
        $assignedProjects = Project::whereIn('id', $userTeams)->orderBy('created_at', 'DESC')->get();
        
        if(!$userProjects && !$assignedProjects){

            return response([
                "message" => "No projects yet :\ ",
            ]);
        }
        
        $recentProjects = [
            $userProjects,
            $assignedProjects,
        ];

        return response([
            "userProjects" => $userProjects,
            "assignedProjects" => "cat"
        ]);

    }
    public function findByName(Request $request){

        $userId = auth()->user()->currentAccessToken()->tokenable['id'];
        // dd($request);
        $fileds = $request->validate([
            
            'project_name' => 'required'
            
        ]);
        
        $project = Project::where('name', 'LIKE', "%{$fileds['project_name']}%")->where('user_id', '=', $userId)->get()->all();

        $userRoles = Role::where('user_id', $userId)->pluck('team_id')->toArray();
        $userTeams = Teams::where('id', $userRoles)->pluck('project_id')->toArray();
        $assignedProjects = Project::whereIn('id', $userTeams)->orderBy('created_at', 'DESC')->get();

        $response = [
            "projects" => $project,
            "assignedProjects" => $assignedProjects
        ];
        return response($response);
    }

    public function store(Request $request)
    {
        $userId = array('user_is' => auth()->user()->currentAccessToken()->tokenable['id']);
        
        $fileds = $request->validate([
            'name'=> 'required',
            'description'=> 'required',
            'due_date'=> 'required',
        ]);
        
        $fileds = array_merge($fileds, ["user_id" => auth()->user()->currentAccessToken()->tokenable['id']]);
        //dd($fileds);
        
        $projects = Project::create($fileds);

        return response([
            $projects
        ], 200);
    }

    public function show(Request $request)
    {
        
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];

        $fileds = $request->validate([
            'project_id' => 'required',
        ]);


        $project = Project::where('id', $fileds['project_id'])->first();
        $teams = Teams::where('project_id', $fileds['project_id'])->get()->toArray();
        $phases = Phase::where('project_id', $fileds['project_id'])->get()->toArray();
        
        $response = [
            "project" => $project,
            "phases" => $phases,
            "teams"=> $teams,

        ];
        return $response;
    }

    public function update(Request $request)
    {

        
        

        $fileds = $request->validate([

            'project_id' => 'required',
            'user_id' => 'required',
            'name' => '',
            'description'=>'',
            'due_date' => '',
            'status' => '',

        ]);
        $project = Project::findOrFail($fileds['project_id']);
        
        $project->update($fileds);
        // dd($project);

        return $project;

        
        
        // return $project;
    }

    public function destroy(Request $request)
    {
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];
        $fileds = $request->validate([
            'project_id' => 'required',
        ]);

        $project = Project::findOrFail($fileds['project_id']);
        if($project->user_id != auth()->user()->currentAccessToken()->tokenable['id']){
            return response([
                "message" => "you donot have permission"
            ]);
        }

        $project->delete();

        return response([
            "message" => "project Deleted"
        ], 200);
    }


}
