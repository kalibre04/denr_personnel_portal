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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/{id}', [App\Http\Controllers\PersonnelController::class, 'profile'])->name('personnel.profile');
    //Route::get('/profile/{id}', 'App\Http\Controllers\PersonnelController@profile')->name('personnel.profile');
    Route::patch('/profile/updateprofile/{id}', 'App\Http\Controllers\PersonnelController@updateprofile')->name('personnel.profile.update');
    Route::patch('/profile/updatepassword/{id}', 'App\Http\Controllers\PersonnelController@profilepasswordupdate')->name('personnel.password.update');

    Route::post('/profile/promotion/{id}', [App\Http\Controllers\PromotionController::class, 'store'])->name('promotion.add');
    Route::get('/profile/delete/{id}', 'App\Http\Controllers\PromotionController@destroy');

    Route::post('/profile/officeassign/{id}', [App\Http\Controllers\OfficeAssignmentController::class, 'store'])->name('officeassign.add');
    Route::get('/profile/deleteassign/{id}', 'App\Http\Controllers\OfficeAssignmentController@destroy');


    Route::get('/{url}', 'App\Http\Controllers\TravelController@index')->name('travel.index');
    Route::get('travel/{url}', 'App\Http\Controllers\TravelController@create')->name('travel.create');
    Route::post('saveto', 'App\Http\Controllers\TravelController@create_travel');

});