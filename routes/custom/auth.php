<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeamLeaderboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\PuzzleGameStateController;
use App\Http\Controllers\PuzzleProofController;

Route::middleware(['web'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('document-sign/waiver-form', [DocumentController::class, 'index']);
    Route::post('document-sign/save', [DocumentController::class, 'saveWaiverForm']);

    Route::get('team-leaderboards', [TeamLeaderboardController::class, 'index'])->name('team-leaderboard.index');
    Route::get('team-leaderboards-table/{puzzleNum?}', [TeamLeaderboardController::class, 'getTeamLeaderboard'])->name('team-leaderboard.table');
    Route::get('get-team-members', [TeamLeaderboardController::class, 'getTeamMembersPerTeam']);

    Route::get('/puzzles/{reference}', [PuzzleController::class, 'getDetails'])->name('puzzles.getDetails');
    Route::post('/validate-puzzle-key', [PuzzleController::class, 'validatePuzzleKey'])->name('puzzles.validate');
    Route::post('/puzzle-wordle-get-word', [PuzzleController::class, 'getWordleWord']);
    Route::post('/puzzle-wordle-check-guess', [PuzzleController::class, 'checkWordleGuess']);
    Route::get('/puzzle-wordle-reset', [PuzzleController::class, 'resetPuzzles']);

    Route::post('/puzzle-save-game-state', [PuzzleGameStateController::class, 'saveGameState']);
    Route::get('/puzzle-get-game-state/{puzzle_num}', [PuzzleGameStateController::class, 'getGameState']);

    Route::post('/puzzle-upload-proof', [PuzzleProofController::class, 'uploadProof'])->name('puzzles.upload');
    Route::post('/puzzle-proof/{proof}/reaction', [PuzzleProofController::class, 'toggleReaction'])->name('puzzle-proof.toggleReaction');
    Route::get('/puzzle-proof/{proof}/reactions', [PuzzleProofController::class, 'getReactions'])->name('puzzle-proof.getReactions');
    Route::get('/puzzle-proof/{proof}/reactions/users', [PuzzleProofController::class, 'getReactors']);
});
