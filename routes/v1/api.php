<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//~~~~~~ 
use App\Http\Controllers\API\v1\UserController;



//~~~~~~~~~~~~~~~~~~ ROUTING API V1 ~~~~~~~~~~~~~~~~//
//~~~~~~~~~~~~ PUBLIC API ~~~~~~~~~~~~~~~~//
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'index']);

// ~~~~~~~~~~~ SECURE API ~~~~~~~~~~~~~~~~~~//
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'update']);
});