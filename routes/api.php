<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\MessageController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return 'Hello World';
});
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/test-auth', [App\Http\Controllers\TestController::class, 'testAuth'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/my-messages', [MessageController::class, 'myMessages']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::delete('/messages/{message}', [MessageController::class, 'destroy']);
    Route::put('/messages/{message}', [MessageController::class, 'update']);
});
