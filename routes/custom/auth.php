<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;

Route::middleware(['web'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('document-sign/waiver-form', [DocumentController::class, 'index']);
    Route::post('document-sign/save', [DocumentController::class, 'saveWaiverForm']);
});
