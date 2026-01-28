<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user-list', [AuthController::class, 'index']);//->middleware('auth:sanctum');
Route::get('/userlist', [AuthController::class, 'apiUserList']); //api data handover another user
Route::post('/user/search', [AuthController::class, 'searchUser']);

Route::delete('/delete-user', [AuthController::class, 'destroy']);
Route::put('/edit-user/{id}', [AuthController::class, 'update']);

//file upload 
Route::post('/file-upload', [BlogController::class, 'store']);
Route::get('/file-upload-list', [BlogController::class, 'index']);//->middleware('auth:sanctum');

//encode decode file
Route::post('/encode-file', [BlogController::class, 'encode']);
Route::post('/decode-file', [BlogController::class, 'decodePost']);
Route::get('/decode-file/{id}', [BlogController::class, 'decode']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});



