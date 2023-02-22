<?php

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware(['auth:api'])->group(function(){
    // Profile
    Route::get('profile',[ProfileController::class,'profile']);
    Route::get('profile-posts',[ProfileController::class,'post']);
    Route::post('logout',[AuthController::class,'logout']);
    // Category
    Route::get('categories',[CategoryController::class,'index']);

    // Post
    Route::get('post',[PostController::class,'index']);

    Route::post('post',[PostController::class,'create']);
     Route::get('post/{id}',[PostController::class,'show']);


});
