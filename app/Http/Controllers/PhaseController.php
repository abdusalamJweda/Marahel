<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use Illuminate\Http\Request;
use App\Http\Requests\PhaseStoreRequest;

class PhaseController extends Controller
{

    public function index()
    {
        return Phase::all();
    }

    public function findByProjectId(int $id){
        return Phase::where('project_id', $id)->get()->all();
    }
    public function AllDoneByProjectId(int $id){
        return Phase::where('project_id', $id)->Where('status', 1)->get()->all();
    }
    public function store(PhaseStoreRequest $request)
    {
        $validData = $request->validated();
        Phase::create($request->all());
    }

    public function show( $id)
    {
        return Phase::findOrFail($id);
    }

    public function update(Request $request, Phase $phase)
    {
        $phase = Phase::find($id);
        $phase->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        $phase = Phase::findOrFail($id);
        $phase->delete();
    }
}
