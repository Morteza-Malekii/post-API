<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/hello', function () {
    return response()->json([
        'message' => 'Hello, API is up and running!'
    ]);
});

Route::apiResource('posts', PostController::class);
