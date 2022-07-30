<?php

// use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\GoogleController;

  
  
Route::get('upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
Route::post('upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');



Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');

// Route::get('auth/google',[ App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth/google');

// Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::post('logout', [App\Http\Controllers\GoogleController::class, 'logout' ])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);

