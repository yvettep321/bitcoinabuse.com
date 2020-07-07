<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::middleware(['auth:api'])->group(function() {

    Route::get('/abuse-types', 'ApiController@abuseTypes');

    Route::get('/reports/distinct', 'ApiController@getDistinctReports');

    Route::match(['get', 'post'], '/reports/create', 'ApiController@store');

    Route::get('/reports/check', 'ApiController@check');

    Route::get('/download/{time}', 'ApiController@download');
});

Route::middleware(['auth:api', 'can:download-full'])->group(function() {

    Route::get('/download/{time}/full', 'ApiController@downloadFull');

});
