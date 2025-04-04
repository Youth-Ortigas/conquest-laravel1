<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\PuzzleGameStateController;
use App\Http\Controllers\UpdateController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/puzzles', [PuzzleController::class, 'index'])->name('puzzles.index');
Route::get('/puzzles/{reference}', [PuzzleController::class, 'getDetails'])->name('puzzles.getDetails');
Route::post('/validate-puzzle-key', [PuzzleController::class, 'validatePuzzleKey'])->name('puzzles.validate');
Route::post('/puzzle-wordle-get-word', [PuzzleController::class, 'getWordleWord']);
Route::post('/puzzle-wordle-check-guess', [PuzzleController::class, 'checkWordleGuess']);

Route::post('/puzzle-save-game-state', [PuzzleGameStateController::class, 'saveGameState']);
Route::get('/puzzle-get-game-state/{user_id}/{puzzle_num}', [PuzzleGameStateController::class, 'getGameState']);

Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index');


