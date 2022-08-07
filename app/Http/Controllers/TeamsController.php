<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamsRequest;
use App\Http\Requests\UpdateTeamsRequest;
use Illuminate\Http\Request;
use App\Models\Role;

class TeamsController extends Controller
{

    public function index()
    {
        return Team::all();
    }

    public function create(Request $request)
    {

    }

    public function getTeamMembers(Request $request){

        $request = $request->validate([
            'team_id' => 'required',
        ]);
   
        $team = Team::find($request['team_id']);
        return $team->members;
    }
    public function store(Request $request)
    {
        $request = $request->validate([

            'project_id' => 'required',
            'name' => 'required'

        ]);
        return Team::create($request);
    }

    public function show(Request $request)
    {
        $request = $request->validate([
            'id' => 'required',
        ]);
        
    }
    public function addMember(Request $request){
        $request = $request->validate([

            'team_id' => 'required',
            'user_id' => 'required',
            'name' => ''

        ]);
        $role = Role::create($request);
        dd($role);
        if($role !=null){
            $role->delete();
            return response([
                "message" => "member Deleted"
            ], 200);
        }
        else{
            return response([
                "message" => "member is not here"
            ], 200);
        }
        
    }
    

    

    public function edit(Teams $teams)
    {
        //
    }


    public function update(UpdateTeamsRequest $request, Teams $teams)
    {
        //
    }


    public function delete(Request $request)
    {
        $userId = auth()->user()->currentAccessToken()->tokenable['id'];

        $request = $request->validate([
            'team_id' => 'required',
        ]);

        $team = Team::find($request['team_id']);
        if($team){
            $team->delete();
            return response([
                "message" => "team Deleted"
            ], 200);
        }
        else{
            return response([
                "message" => "team is not here"
            ], 200);
        }

    }
    public function deleteMember(Request $request){
        $request = $request->validate([

            'team_id' => 'required',
            'user_id' => 'required'
        ]);
        $role = Role::where('user_id', $request['user_id'])->where('team_id', $request['team_id'])->first();
        
        if($role !=null){
            $role->delete();
            return response([
                "message" => "member Deleted"
            ], 200);
        }
        else{
            return response([
                "message" => "member is not here"
            ], 200);
        }
        $role->delete();
    }
}
