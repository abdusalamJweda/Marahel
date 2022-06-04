<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request){

        $fileds = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password'=> 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fileds['name'],
            'email' => $fileds['email'],
            'password' => bcrypt($fileds['password'])
        ]);
        
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //dd($response);
        return response($response, 201);
    }

    public function logIn(Request $request){

        $fileds = $request->validate([
            'email' => 'required|string',
            'password'=> 'required|string',
        ]);

        // check email

        if(!$user = User::where('email', $fileds['email'])->first()){
            return response([
                'message' => 'wrong E-mail'
            ], 401);
        }

        
        // check password

        if(!$user || !Hash::check($fileds['password'], $user->password)){
            return response([
                'message' => 'wrong password'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //dd($response);
        return response($response, 201);
    }

    public function logOut(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }
}
