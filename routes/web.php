<?php

use App\Models\Motivation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('motivation');
});

// Route Data Binding
// Route::get('motivation/{motivation:slug}', 'MotivationController@show');



Route::group(['middleware' => 'auth'], function () {
    // Motivation Login
    Route::resource('motivation', 'MotivationController')->except(['index', 'show']);
    // Like
    Route::get('/like/{id}/{type}', 'LikeController@store');
    // Unlike
    Route::get('/unlike/{id}/{type}', 'UnlikeController@store');
});
// Motivation Not Login
Route::resource('motivation', 'MotivationController')->only(['index', 'show']);
// Route Tag
Route::get('tag/{tag:slug}', 'TagController@show');
// Route::get('tag/{slug}', 'TagController@show2');



// File Mnager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Auth::routes();
