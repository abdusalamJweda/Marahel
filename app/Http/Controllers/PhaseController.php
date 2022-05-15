<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use Illuminate\Http\Request;

class PhaseController extends Controller
{

    public function index()
    {
        return Phase::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return Phase::create($request->all());
    }

    public function show( $id)
    {
        return Phase::findOrFail($id);
    }

    public function edit(Phase $phase)
    {
        //
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
