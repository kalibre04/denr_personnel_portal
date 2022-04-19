<?php

use Illuminate\Support\Facades\Route;


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


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile/{id}', 'App\Http\Controllers\PersonnelController@profile')->name('personnel.profile');
Route::patch('/profile/updateprofile/{id}', 'App\Http\Controllers\PersonnelController@updateprofile')->name('personnel.profile.update');
Route::patch('/profile/updatepassword/{id}', 'App\Http\Controllers\PersonnelController@profilepasswordupdate')->name('personnel.password.update');
Route::get('travel/{url}', 'App\Http\Controllers\PersonnelController@index')->name('travel.index');