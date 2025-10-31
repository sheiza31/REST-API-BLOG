<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostTagsController;
use App\Http\Controllers\PostCategoriesController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('v1/posts', PostsController::class);
Route::apiResource('v1/categories', CategoriesController::class);
Route::apiResource('v1/tags', TagsController::class);
Route::apiResource('v1/media', MediaController::class);
