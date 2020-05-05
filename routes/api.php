<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['namespace' => 'api'], function () {

    Route::post('/auth/login', 'FamilyController@login');
    Route::post('/families', 'FamilyController@store');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/user', 'FamilyController@profile');
        Route::get('/families', 'FamilyController@index');
        Route::get('/families/{id}', 'FamilyController@show');
        Route::put('/families', 'FamilyController@update');

        Route::get('/students', 'StudentController@index')->name('api.student.index');
    });

});