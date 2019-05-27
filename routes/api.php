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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthAppController@login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthAppController@logout');
        Route::get('user', 'AuthAppController@user');
        Route::get('projects/leader','ResourcesAppController@own_leader_projects'); //proyectos donde eres el primer lider
        Route::get('projects/second-leader','ResourcesAppController@own_second_leader_projects');// proyectos donde eres el segundo
        Route::get('projects/researcher','ResourcesAppController@own_research_projects');//proyectos donde eres investigador
        Route::post('notification','ResourcesAppController@get_fragment');

    });
});