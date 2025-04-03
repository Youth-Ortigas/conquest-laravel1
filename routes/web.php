<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/puzzles', 'App\Http\Controllers\PuzzlesController@index')->name('puzzles.index');
Route::get('/puzzles/{reference}', 'App\Http\Controllers\PuzzlesController@getDetails')->name('puzzles.getDetails');

Route::get('/updates', 'App\Http\Controllers\UpdateController@index')->name('updates.index');

