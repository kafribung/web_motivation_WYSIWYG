<?php

use App\Models\Motivation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('motivation');
});

// Route Data Binding
// Route::get('motivation/{motivation:slug}', 'MotivationController@show');

// File Mnager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('motivation', 'MotivationController')->except(['index', 'show']);
});
// Route Tag
Route::get('tag/{tag:slug}', 'TagController@show');
// Route::get('tag/{slug}', 'TagController@show2');

Route::resource('motivation', 'MotivationController')->only(['index', 'show']);

Auth::routes();
