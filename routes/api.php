<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/validate-token', function (Request $request) {
  
    $user = $request->user();  

    return response()->json([
        'message' => 'Token is valid',
        'user' => $user,
        'token' => $user->createToken('authToken')->plainTextToken,  
    ]);
});

Route::post('/login', [UserController:: class,'login']);
Route::post('/register', [UserController:: class,'register']);