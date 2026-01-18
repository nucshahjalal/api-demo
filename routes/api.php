<?php

use App\Http\Controllers\API\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user-list', [AuthController::class, 'index']);
Route::get('/userlist', [AuthController::class, 'apiUserList']); //api data handover another user
//Route::get('/userlist', [AuthController::class, 'userlist']);  //this is  use web.php file


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

