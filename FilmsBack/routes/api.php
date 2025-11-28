<?php

use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// api controller index
Route::get('films', [FilmController::class, 'index']);
Route::get('genres', [GenreController::class, 'index']);

// api controller show
Route::get('films/{film}', [FilmController::class, 'show']);
