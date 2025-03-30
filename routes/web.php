<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index');
Route::get('/puzzles', 'App\Http\Controllers\PuzzlesController@index');
