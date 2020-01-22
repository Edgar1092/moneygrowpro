<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('files/download/{file}','FileController@download');
Route::get('files/show/{file}','FileController@download');


Route::group([
    'namespace' =>  'Auth',
    'prefix'    =>  'auth'
], function(){
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::post('register', 'LoginController@signup');
    Route::group(['middleware' => 'auth:api'], function()
    {

    });
});


    /** File routes */

Route::group([
    'middleware'        =>  'auth:api'
], function(){
    Route::resource('countries','CountryController')->only(['index','show']);
    Route::resource('payment_methods','PaymentMethodController')->only(['index','show']);
    Route::resource('statuses','StatusController')->only(['index','show']);
    Route::resource('task_types','TaskTypeController')->only(['index','show']);

    Route::resource('offices','OfficeController');
    Route::resource('services','ServiceController');

    Route::resource('users/goals','UserGoalController');
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');
    Route::resource('clients','ClientController');
    Route::get('passengers/export/{id}','PassengerController@export');
    Route::resource('passengers','PassengerController');
    Route::resource('credit_cards','CreditCardController');
    Route::resource('tasks','TaskController');
    Route::get('payments/export/{id}','PaymentController@export');
    Route::resource('payments','PaymentController');
    Route::resource('collaborators','CollaboratorController');
    Route::get('vacation_records/events','VacationRecordController@events_calendar');
    Route::resource('vacation_records','VacationRecordController');

    /** Prospect routes */
    Route::group([
        'prefix'        => 'prospects',
    ], function () {
        Route::post('convert_to_client/{client}', 'ClientController@converProspectToClient');
    });
    Route::resource('prospects','ClientController');
    Route::resource('notifications','NotificationController');


    /** Quotation routes */
    Route::group([
        'prefix'        => 'quotations',
    ], function () {
        Route::post('approve/{id}','QuotationController@approve');
        Route::post('reject/{id}','QuotationController@reject');
        Route::post('sync_passengers/{id}','QuotationController@syncPassengersQuotation');
    });
    Route::resource('quotations','QuotationController');
    Route::resource('propoals','PropoalController');
    Route::resource('propoal_notes','PropoalNotesController');
    Route::resource('quotation_notes','QuotationNotesController');
    Route::get('quotations/balance/{id}','QuotationController@balance');
    Route::get('quotations/pdf/{id}', 'QuotationController@pdf');
    Route::get('currencies', 'CurrencyController@index');
    Route::get('blood_types', 'BloodTypeController@index');


    /** File routes */
    Route::group([
        'prefix'        => 'files'
    ], function () {
        Route::post('/','FileController@store');
        Route::delete('/{file}','FileController@destroy');
    });

    Route::group([
        'prefix'        => 'reports',
    ], function () {
        Route::get('client_quotations', 'ReportController@client_quotations');
        Route::get('sales', 'ReportController@sales');

        Route::get('effectiveness', 'ReportController@effectiveness');

    });

    Route::group([
        'prefix'         =>  'dashboard'
    ], function(){
        Route::get('tasks_opens','DashboardController@tasksOpens');
        Route::get('approved_sales_month','DashboardController@approvedSalesMonth');
        Route::get('graph_sales_year','DashboardController@graphSalesYear');
        Route::get('propoals_graphs', 'DashboardController@propoals_graphs');
        Route::get('goals_graphs', 'DashboardController@goals_graphs');

    });

});



