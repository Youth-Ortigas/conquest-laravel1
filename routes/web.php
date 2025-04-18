<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\PuzzleGameStateController;
use App\Http\Controllers\UpdateController;
use App\Http\Middleware\ActivityLogCustom;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->middleware(ActivityLogCustom::class);;
    Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware(ActivityLogCustom::class);

    Route::get('/puzzles', [PuzzleController::class, 'index'])->name('puzzles.index');
    Route::get('/puzzles/{reference}', [PuzzleController::class, 'getDetails'])->name('puzzles.getDetails')->middleware(ActivityLogCustom::class);
    Route::post('/validate-puzzle-key', [PuzzleController::class, 'validatePuzzleKey'])->name('puzzles.validate')->middleware(ActivityLogCustom::class);
    Route::post('/puzzle-wordle-get-word', [PuzzleController::class, 'getWordleWord'])->middleware(ActivityLogCustom::class);
    Route::post('/puzzle-wordle-check-guess', [PuzzleController::class, 'checkWordleGuess'])->middleware(ActivityLogCustom::class);
    Route::get('/puzzle-wordle-reset', [PuzzleController::class, 'resetWordle'])->middleware(ActivityLogCustom::class);

    Route::post('/puzzle-save-game-state', [PuzzleGameStateController::class, 'saveGameState'])->middleware(ActivityLogCustom::class);
    Route::get('/puzzle-get-game-state/{user_id}/{puzzle_num}', [PuzzleGameStateController::class, 'getGameState'])->middleware(ActivityLogCustom::class);

    Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index')->middleware(ActivityLogCustom::class);
});

