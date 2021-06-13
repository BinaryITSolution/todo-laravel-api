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

Route::get('validate_token',function (){
    return ['message'=> 'true'];
})->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','Api\Auth\AuthController@register');
Route::post('login','Api\Auth\AuthController@login');

Route::group(['prefix' => 'users'],function (){
    Route::group(['middleware' =>'auth:api'],function (){

        Route::get('detail/{id}','Api\Profile\UserProfileController@getUserDetail');
        Route::post('edit/user','Api\Profile\UserProfileController@edit');

    });
});

/*
 * api endpoint auth
 */

Route::group(['prefix' => 'task'],function (){
    Route::group(['middleware' =>'auth:api'],function (){
        Route::get('all_task','Api\Task\TaskController@allTask');
        Route::get('get_all_task','Api\Task\TaskController@getAllTask');
        Route::get('get_task_by_id/{id}','Api\Task\TaskController@getTaskById');
        Route::post('add_task','Api\Task\TaskController@store');
        Route::post('update_task','Api\Task\TaskController@update');
        Route::post('delete_task','Api\Task\TaskController@destroy');
    });
});

/*
 * api endpoint without auth
 */

Route::group(['prefix' => 'no_auth'],function (){
    Route::get('all_task','Api\Task\TaskController@allTask');
    Route::get('get_all_task','Api\Task\TaskController@getAllTask');
    Route::get('get_task/{id}','Api\Task\TaskController@getTask');
    Route::get('get_task_by_id/{id}','Api\Task\TaskController@getTaskById');
    Route::post('add_task','Api\Task\TaskController@store');
    Route::post('update_task','Api\Task\TaskController@update');
    Route::post('delete_task','Api\Task\TaskController@destroy');
    Route::get('search/{query}','Api\Task\TaskController@searchTask');
});
