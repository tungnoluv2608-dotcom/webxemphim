<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\IndexController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\GenreController;
// use App\Http\Controllers\CountryController;
// use App\Http\Controllers\MovieController;
// use App\Http\Controllers\EpisodeController;
// use App\Http\Controllers\InfoController;
// use App\Http\Controllers\VisitorController;
// use App\Http\Controllers\LinkMovieController;
// use App\Http\Controllers\AdsController;
// use App\Http\Controllers\AdsNetworkController;
// use App\Http\Controllers\LoginGoogleController;
// use App\Http\Controllers\LoginFBController;
// use App\Http\Controllers\LeechMovieController;
// use App\Http\Controllers\Auth\LoginController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});