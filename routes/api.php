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

Route::get('/appointments/retrieve', 'AppointmentController@appointments');
Route::post('/appointments/update', 'AppointmentController@update');

Route::post('/submit/request', 'RequestController@request');

Route::get('/requests/retrieve', 'RequestController@get');
Route::get('/requests/retrieve/approved', 'RequestController@approved');
Route::post('/requests/approve', 'RequestController@approve');
Route::post('/requests/reject', 'RequestController@reject');
Route::post('/requests/convert', 'AppointmentController@convert');
