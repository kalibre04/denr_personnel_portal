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


    Route::get('/travel', 'App\Http\Controllers\TravelController@index')->name('travel.index');
    Route::get('travel/viewtravel/{id}', 'App\Http\Controllers\TravelController@view_traveldetails')->name('travel.viewtravel');


    Route::get('travel/createtravel', 'App\Http\Controllers\TravelController@create')->name('travel.create');
    Route::post('travel/saveto', 'App\Http\Controllers\TravelController@create_travel');

    //Division Chief Middleware start
    Route::group(['middleware' => 'divchief'], function () {
        Route::get('travel/chiefindex', 'App\Http\Controllers\TravelApproverController@chief_index')->name('travel.chiefindex');
        Route::get('travel/chiefedit/{id}', 'App\Http\Controllers\TravelApproverController@chief_edit')->name('travel.chiefeditto');

        // route sa pag disapprove if na approve na ang Travel Order sa Div Chief
        Route::get('travel/chiefeditdisapprove/{id}', 'App\Http\Controllers\TravelApproverController@chief_disapprove')->name('travel.chiefdisapprove');
        Route::patch('travel/chiefeditdisapprove/disapproveto/{id}', 'App\Http\Controllers\TravelApproverController@divchief_disapprove_travel');
        // end

        // route sa pag approve if gi cancel sa Div Chief and Travel Order 
        Route::get('travel/chieftravelapprove/{id}', 'App\Http\Controllers\TravelApproverController@chief_approvefromcancelled')->name('travel.chiefapprovetravel');
        Route::post('travel/chieftravelapprove/updateto/{id}', 'App\Http\Controllers\TravelApproverController@divchief_update_travel');
        // end

        Route::get('travel/chiefapproved', 'App\Http\Controllers\TravelApproverController@chief_approvedindex')->name('travel.chiefapproved');
        Route::get('travel/chiefcancelled', 'App\Http\Controllers\TravelApproverController@chief_cancelledindex')->name('travel.chiefcancelled');
        Route::get('travel/chiefcompleted', 'App\Http\Controllers\TravelApproverController@chief_completedindex')->name('travel.chiefcompleted');
        Route::post('travel/chiefedit/updateto/{id}', 'App\Http\Controllers\TravelApproverController@divchief_update_travel');
        Route::patch('travel/chiefedit/disapproveto/{id}', 'App\Http\Controllers\TravelApproverController@divchief_disapprove_travel');
    });
    //Division Chief Middleware end
    /********************************************************************************************************************************/
    
    //CENRO Middleware start
    Route::group(['middleware' => 'cenro'], function () {
        Route::get('travel/cenroindex', 'App\Http\Controllers\TravelApproverCenroController@cenro_index')->name('travel.cenroindex');
        Route::get('travel/cenroedit/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_edit')->name('travel.cenroeditto');

        // route sa pag disapprove if na approve na ang Travel Order sa Div Chief
        Route::get('travel/cenroeditdisapprove/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_disapprove')->name('travel.cenrodisapprove');
        Route::patch('travel/cenroeditdisapprove/disapproveto/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_disapprove_travel');
        // end

        // route sa pag approve if gi cancel sa Div Chief and Travel Order 
        Route::get('travel/cenrotravelapprove/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_approvefromcancelled')->name('travel.cenroapprovetravel');
        Route::post('travel/cenrotravelapprove/updateto/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_update_travel');
        // end

        Route::get('travel/cenroapproved', 'App\Http\Controllers\TravelApproverCenroController@cenro_approvedindex')->name('travel.cenroapproved');
        Route::get('travel/cenrocancelled', 'App\Http\Controllers\TravelApproverCenroController@cenro_cancelledindex')->name('travel.cenrocancelled');
        Route::get('travel/cenrocompleted', 'App\Http\Controllers\TravelApproverCenroController@cenro_completedindex')->name('travel.cenrocompleted');
        Route::post('travel/cenroedit/updateto/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_update_travel');
        Route::patch('travel/cenroedit/disapproveto/{id}', 'App\Http\Controllers\TravelApproverCenroController@cenro_disapprove_travel');
    });
    //CENRO Middleware end

});