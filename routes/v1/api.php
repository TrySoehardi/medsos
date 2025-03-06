<?php

use App\Http\Controllers\API\v1\auth\AuthController;
use App\Http\Controllers\API\v1\auth\RegisterController;
use App\Http\Controllers\API\v1\get\GetFollow;
use App\Http\Controllers\API\v1\get\GetLike;
use App\Http\Controllers\API\v1\get\GetOtherUser;
use App\Http\Controllers\API\v1\get\GetPost;
use App\Http\Controllers\API\v1\get\GetUserController;
use App\Http\Controllers\API\v1\post\PostComment;
use App\Http\Controllers\API\v1\post\PostFollow;
use App\Http\Controllers\API\v1\post\PostLike;
use App\Http\Controllers\API\v1\post\PostPost;
use App\Http\Controllers\API\v1\put\PutPost;
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
    Route::get(GetFollow::$path, [GetFollow::class, 'index']);
    Route::get(GetPost::$path, [GetPost::class,'index']);
    Route::get(GetLike::$path, [GetLike::class, 'index']);
    // ~~~~~~~~~~~~ POST METHOD ~~~~~~~~ //
    Route::post(PostFollow::$path, [ PostFollow::class, 'index']);
    Route::post(PostPost::$path, [PostPost::class, 'index']);
    Route::post(PostLike::$path, [PostLike::class, 'index']);
    Route::post(PostComment::$path, [PostComment::class, 'index']);

    // ~~~~~~~~~~~~ DELETE METHOD ~~~~~~~ //

    // ~~~~~~~~~~~~ PUT METHOD ~~~~~~~~~ //
    Route::put(PutUserController::$path, [PutUserController::class, 'index']);
    Route::put(PutPost::$path, [PutPost::class, 'index']);

});