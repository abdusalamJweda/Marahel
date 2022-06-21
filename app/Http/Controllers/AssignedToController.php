<?php

namespace App\Http\Controllers;

use App\Models\AssignedTo;
use App\Http\Requests\StoreAssignedToRequest;
use App\Http\Requests\UpdateAssignedToRequest;

class AssignedToController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssignedToRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignedToRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedTo  $assignedTo
     * @return \Illuminate\Http\Response
     */
    public function show(AssignedTo $assignedTo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignedTo  $assignedTo
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedTo $assignedTo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssignedToRequest  $request
     * @param  \App\Models\AssignedTo  $assignedTo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignedToRequest $request, AssignedTo $assignedTo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignedTo  $assignedTo
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignedTo $assignedTo)
    {
        //
    }
}
