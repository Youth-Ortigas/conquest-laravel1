<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\PuzzleGameStateController;
use App\Http\Controllers\UpdateController;
use App\Http\Middleware\ActivityLogCustom;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->middleware(ActivityLogCustom::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware(ActivityLogCustom::class);

    Route::get('/puzzles', [PuzzleController::class, 'index'])->name('puzzles.index');

    Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index')->middleware(ActivityLogCustom::class);
});

