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
    Route::get('travel/viewtravel/{id}', 'App\Http\Controllers\TravelController@view_traveldetailsdivchief')->name('travel.viewtravel');

    Route::get('travel/viewtravelcenro/{id}', 'App\Http\Controllers\TravelController@view_traveldetailscenro')->name('travel.viewtravelcenro');

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
    /****************************************************************************************************************/

     /********************************************************************************************************************************/
    
    //PENRO Middleware start
    Route::group(['middleware' => 'penro'], function () {
        Route::get('travel/penroindex', 'App\Http\Controllers\TravelApproverPenroController@penro_index')->name('travel.penroindex');
        Route::get('travel/penroedit/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_edit')->name('travel.penroeditto');

        // route sa pag disapprove if na approve na ang Travel Order sa Div Chief
        Route::get('travel/penroeditdisapprove/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_disapprove')->name('travel.penrodisapprove');
        Route::patch('travel/penroeditdisapprove/disapproveto/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_disapprove_travel');
        // end

        // route sa pag approve if gi cancel sa Div Chief and Travel Order 
        Route::get('travel/penrotravelapprove/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_approvefromcancelled')->name('travel.penroapprovetravel');
        Route::post('travel/penrotravelapprove/updateto/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_update_travel');
        // end

        Route::get('travel/penroapproved', 'App\Http\Controllers\TravelApproverPenroController@penro_approvedindex')->name('travel.penroapproved');
        Route::get('travel/penrocancelled', 'App\Http\Controllers\TravelApproverPenroController@penro_cancelledindex')->name('travel.penrocancelled');
        Route::get('travel/penrocompleted', 'App\Http\Controllers\TravelApproverPenroController@penro_completedindex')->name('travel.penrocompleted');
        Route::post('travel/penroedit/updateto/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_update_travel');
        Route::patch('travel/penroedit/disapproveto/{id}', 'App\Http\Controllers\TravelApproverPenroController@penro_disapprove_travel');
    });
    //PENRO Middleware end
    /****************************************************************************************************************/


    //ARED MS Middleware start
    Route::group(['middleware' => 'aredms'], function () {
        Route::get('travel/aredmsindex', 'App\Http\Controllers\TravelApproverAredmsController@aredms_index')->name('travel.aredmsindex');
        Route::get('travel/aredmsedit/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_edit')->name('travel.aredmseditto');

        // route sa pag disapprove if na approve na ang Travel Order sa Div Chief
        Route::get('travel/aredmseditdisapprove/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_disapprove')->name('travel.aredmsdisapprove');
        Route::patch('travel/aredmseditdisapprove/disapproveto/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_disapprove_travel');
        // end

        // route sa pag approve if gi cancel sa Div Chief and Travel Order 
        Route::get('travel/aredmstravelapprove/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_approvefromcancelled')->name('travel.aredmsapprovetravel');
        Route::post('travel/aredmstravelapprove/updateto/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_update_travel');
        // end

        Route::get('travel/aredmsapproved', 'App\Http\Controllers\TravelApproverAredmsController@aredms_approvedindex')->name('travel.aredmsapproved');
        Route::get('travel/aredmscancelled', 'App\Http\Controllers\TravelApproverAredmsController@aredms_cancelledindex')->name('travel.aredmscancelled');
        Route::get('travel/aredmscompleted', 'App\Http\Controllers\TravelApproverAredmsController@aredms_completedindex')->name('travel.aredmscompleted');
        Route::post('travel/aredmsedit/updateto/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_update_travel');
        Route::patch('travel/aredmsedit/disapproveto/{id}', 'App\Http\Controllers\TravelApproverAredmsController@aredms_disapprove_travel');
    });
    //ARED MS Middleware end

    //ARED TS Middleware start
    Route::group(['middleware' => 'aredts'], function () {
        Route::get('travel/aredtsindex', 'App\Http\Controllers\TravelApproverAredtsController@aredts_index')->name('travel.aredtsindex');
        Route::get('travel/aredtsedit/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_edit')->name('travel.aredtseditto');

        // route sa pag disapprove if na approve na ang Travel Order sa Div Chief
        Route::get('travel/aredtseditdisapprove/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_disapprove')->name('travel.aredtsdisapprove');
        Route::patch('travel/aredtseditdisapprove/disapproveto/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_disapprove_travel');
        // end

        // route sa pag approve if gi cancel sa Div Chief and Travel Order 
        Route::get('travel/aredtstravelapprove/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_approvefromcancelled')->name('travel.aredtsapprovetravel');
        Route::post('travel/aredtstravelapprove/updateto/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_update_travel');
        // end

        Route::get('travel/aredtsapproved', 'App\Http\Controllers\TravelApproverAredtsController@aredts_approvedindex')->name('travel.aredtsapproved');
        Route::get('travel/aredtscancelled', 'App\Http\Controllers\TravelApproverAredtsController@aredts_cancelledindex')->name('travel.aredtscancelled');
        Route::get('travel/aredtscompleted', 'App\Http\Controllers\TravelApproverAredtsController@aredts_completedindex')->name('travel.aredtscompleted');
        Route::post('travel/aredtsedit/updateto/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_update_travel');
        Route::patch('travel/aredtsedit/disapproveto/{id}', 'App\Http\Controllers\TravelApproverAredtsController@aredts_disapprove_travel');
    });
    //ARED TS Middleware end

    //ORED Middleware start
    Route::group(['middleware' => 'aredms'], function () {
        Route::get('travel/oredindex', 'App\Http\Controllers\TravelApproverOredController@ored_index')->name('travel.oredindex');
        Route::get('travel/orededit/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_edit')->name('travel.orededitto');

        // route sa pag disapprove if na approve na ang Travel Order sa Div Chief
        Route::get('travel/orededitdisapprove/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_disapprove')->name('travel.oreddisapprove');
        Route::patch('travel/orededitdisapprove/disapproveto/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_disapprove_travel');
        // end

        // route sa pag approve if gi cancel sa Div Chief and Travel Order 
        Route::get('travel/oredtravelapprove/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_approvefromcancelled')->name('travel.oredapprovetravel');
        Route::post('travel/oredtravelapprove/updateto/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_update_travel');
        // end

        Route::get('travel/oredapproved', 'App\Http\Controllers\TravelApproverOredController@ored_approvedindex')->name('travel.oredapproved');
        Route::get('travel/oredcancelled', 'App\Http\Controllers\TravelApproverOredController@ored_cancelledindex')->name('travel.oredcancelled');
        Route::get('travel/oredcompleted', 'App\Http\Controllers\TravelApproverOredController@ored_completedindex')->name('travel.oredcompleted');
        Route::post('travel/orededit/updateto/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_update_travel');
        Route::patch('travel/orededit/disapproveto/{id}', 'App\Http\Controllers\TravelApproverOredController@ored_disapprove_travel');
    });
    //ORED Middleware end

});