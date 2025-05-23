<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\DocumentPublicController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\MaterialsController;
use App\Http\Middleware\ActivityLogCustom;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->middleware(ActivityLogCustom::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware(ActivityLogCustom::class);
    Route::get('/puzzles', [PuzzleController::class, 'index'])->name('puzzles.index')->middleware(ActivityLogCustom::class);
    Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index')->middleware(ActivityLogCustom::class);
    Route::get('/materials', [MaterialsController::class, 'index'])->name('materials.index')->middleware(ActivityLogCustom::class);
    Route::get('document-sign/waiver-form/{regCode}', [DocumentPublicController::class, 'showWaiverFormPublic']);
});

