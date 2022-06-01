<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 
    public function index()
    {
        return User::all();
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }



    public function show($id)
    {
        return User::findOrFail($id);
        
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }
}
