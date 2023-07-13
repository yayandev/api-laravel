<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/user', [AuthenticationController::class,'user']);
    Route::post('/posts',[PostController::class, 'store']);
    Route::patch('/posts/{id}',[PostController::class, 'update'])->middleware('pemilik-postingan');
});

Route::get('/posts',[PostController::class, 'index']);
Route::get('/posts/{id}',[PostController::class, 'show']);
Route::post('/login', [AuthenticationController::class, 'login']);
