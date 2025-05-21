<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::delete('/cart', [CartController::class , 'deleteItem']);
    Route::put('/increaseQuantity', [CartController::class , 'increaseQuantity']);
    Route::put('/decreaseQuantity', [CartController::class , 'decreaseQuantity']);
    Route::post('/address', [AddressController::class, 'saveAddress']);
    Route::get('/address', [AddressController::class, 'fetchAddresses']);
    Route::delete('/address', [AddressController::class, 'deleteAddress']);
    Route::post('/order', [OrderController::class , 'createOrder']);
    Route::get('/order', [OrderController::class, 'fetchOrder']);
    Route::post('/favorite', [FavoriteController::class, 'addToFavorite']);
    Route::delete('/favorite', [FavoriteController::class, 'removeFromFavorite']);
    Route::get('/favorite', [FavoriteController::class, 'getFavoriteItems']);
});

Route::post('/login', [UserController:: class,'login']);            
Route::post('/register', [UserController:: class,'register']);

Route::post('/product',[ProductController::class, 'addProduct']);
Route::get('/product',[ProductController::class, 'fetchAllProducts']);