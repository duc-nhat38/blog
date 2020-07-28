<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('blogs', 'BlogController');
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('/index', 'HomePageController@homePage')->name('blog.index');
    Route::patch('changePassword', 'Auth\ResetPasswordController@changePassword')->name('blog.changePassword');
    Route::get('search', 'BlogController@search')->name('blog.search');
});
