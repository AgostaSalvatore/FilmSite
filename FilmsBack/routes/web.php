<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/films', FilmController::class);
    Route::resource('/genres', GenreController::class);
    Route::resource('/directors', DirectorController::class);
});

require __DIR__ . '/auth.php';
