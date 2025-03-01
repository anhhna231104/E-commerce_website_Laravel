<?php

use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/blog', [BlogController::class, 'list']);

Route::get('/blog-detail/{id}', [BlogController::class, 'detail']);
Route::post('/login', [MemberController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/my-products', [ProductController::class, 'myProduct']);
    Route::post('/blog/{id}/comment', [BlogController::class, 'comment']);
});