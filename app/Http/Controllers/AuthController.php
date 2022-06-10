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
            'email' => 'required|string',
            'password'=> 'required|string|confirmed',
        ]);
        
        if(!filter_var($fileds['email'], FILTER_VALIDATE_EMAIL)){
            return response([
                'message' => 'invalid Email format'
            ], 403);
        }
        if($user = User::where('email', $fileds['email'])->first()){
            return response([
                'message' => 'This Email Is already registered'
            ], 403);
        }


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
            ], 403);
        }

        
        // check password

        if(!$user || !Hash::check($fileds['password'], $user->password)){
            return response([
                'message' => 'wrong password'
            ], 403);
        }


        // user is valid... do whatever
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //dd($response);
        return response($response, 201);
    }

    public function logOut(){

        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged Out'
        ];
    }
}
