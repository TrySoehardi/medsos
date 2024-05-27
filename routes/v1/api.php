<?php

use App\Http\Controllers\API\v1\auth\AuthController;
use App\Http\Controllers\API\v1\auth\RegisterController;
use App\Http\Controllers\API\v1\get\GetUserController;
use App\Http\Controllers\API\v1\put\PutUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//~~~~~~ 
use App\Http\Controllers\API\v1\UserController;



//~~~~~~~~~~~~~~~~~~ ROUTING API V1 ~~~~~~~~~~~~~~~~//
//~~~~~~~~~~~~ PUBLIC API ~~~~~~~~~~~~~~~~//
Route::post(RegisterController::$patch, [RegisterController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);

// ~~~~~~~~~~~ SECURE API ~~~~~~~~~~~~~~~~~~//
Route::group(['middleware'=>['auth:sanctum']],function(){

    // ~~~~~~~~~~~~ GET METHOD ~~~~~~~~~ //
    Route::get(GetUserController::$path, [GetUserController::class, 'index']);

    // ~~~~~~~~~~~~ POST METHOD ~~~~~~~~ //
    

    // ~~~~~~~~~~~~ DELETE METHOD ~~~~~~~ //

    // ~~~~~~~~~~~~ PUT METHOD ~~~~~~~~~ //
    Route::put(PutUserController::$path, [PutUserController::class, 'index']);

});