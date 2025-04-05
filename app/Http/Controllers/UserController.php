<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $request -> validate([
            'email' => 'required|string',
            'password' => 'required|min:6',
            'remember' => 'boolean'
        ]);

        $user = User::where('email', $request->email)->first();


        if(!$user){
            return response()->json(['message' => 'User Not Found'], 404);
        }




        if(Hash::check($request->password, $user->password)){
            $token = $user->createToken('authToken')->plainTextToken;

            
        if($request-> remember){
            $user->remember_token = $token;
            $user->save();
        }
       
            return response()->json(['message' => 'Login Successful', 'user' => $user, 'token' => $token] ,200);
        } else {
            return response()->json(['message' => 'Incorrect Password'] , 401);
        }
      
    } 

    public function register(Request $request){

        $request-> validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Registration Successful',
            'user' => $user,
            'token' => $token,

        ], 201);
    }
}