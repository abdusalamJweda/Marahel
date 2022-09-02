<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Project;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

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

// didn't even touch this :v

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// messeging --test
Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index']);
Route::get('/messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);


//


// public routes
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('logIn', 'App\Http\Controllers\AuthController@logIn');
Route::get('users','App\Http\Controllers\UserController@index');

// protected routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('getUserId', [App\Http\Controllers\UserController::class, 'getUserId']);
    Route::prefix('chat')->group(function () {
        Route::post('/getChatList', [App\Http\Controllers\ChatsController::class, 'getChatList']);
        Route::post('/getChat', [App\Http\Controllers\ChatsController::class, 'getChat']);
    
        Route::post('/send-message', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
    
    });
    Route::prefix('notification')->group(function () {
        Route::get('/getNotifications', [App\Http\Controllers\NotificationController::class, 'getNotifications']);
        
        Route::post('/sendNotification', [App\Http\Controllers\NotificationController::class, 'sendNotification']);
    });

    Route::get('recentProjects', 'App\Http\Controllers\ProjectController@recentProjects');
    Route::get('flutterRecentProjects', 'App\Http\Controllers\ProjectController@flutterRecentProjects');
    Route::get('logOut', 'App\Http\Controllers\AuthController@logOut');
   
    Route::group(['prefix'=>'tasks'], function(){
        Route::get('/', 'App\Http\Controllers\TaskController@index');
        Route::post('findPTasksByPhaseId', 'App\Http\Controllers\TaskController@findPTasksByPhaseId');
        Route::post('changeStatus', 'App\Http\Controllers\TaskController@changeStatus');
        Route::post('store', 'App\Http\Controllers\TaskController@store');
        Route::post('update', 'App\Http\Controllers\TaskController@update');
        Route::delete('delete', 'App\Http\Controllers\TaskController@delete');


    });
    Route::group(['prefix' => 'projects'], function(){
        Route::get('/', 'App\Http\Controllers\ProjectController@index');
        Route::get('findByName', 'App\Http\Controllers\ProjectController@findByName');
        Route::post('store', 'App\Http\Controllers\ProjectController@store');
        Route::post('show', 'App\Http\Controllers\ProjectController@show');
        Route::post('update', 'App\Http\Controllers\ProjectController@update');
        Route::post('delete', 'App\Http\Controllers\ProjectController@delete');
        Route::delete('destroy', 'App\Http\Controllers\ProjectController@destroy');

    });
    Route::group(['prefix' => 'phases'], function(){
        Route::get('/', 'App\Http\Controllers\PhaseController@index');
        Route::get('findByName', 'App\Http\Controllers\PhaseController@findByName');
        Route::post('store', 'App\Http\Controllers\PhaseController@store');
        Route::get('show', 'App\Http\Controllers\PhaseController@show');
        Route::post('update', 'App\Http\Controllers\PhaseController@update');
        Route::delete('destroy', 'App\Http\Controllers\PhaseController@destroy');
        Route::post('findPhasesByProjectId', 'App\Http\Controllers\PhaseController@findPhasesByProjectId');

    });
    Route::group(['prefix' => 'teams'], function(){
        Route::get('/', 'App\Http\Controllers\TeamsController@index');
        Route::get('/members', 'App\Http\Controllers\TeamsController@getTeamMembers');
        Route::post('store', 'App\Http\Controllers\TeamsController@store');
        Route::delete('delete', 'App\Http\Controllers\TeamsController@delete');
        Route::delete('deleteMember', 'App\Http\Controllers\TeamsController@deleteMember');
        Route::delete('addMember', 'App\Http\Controllers\TeamsController@addMember');

    });

});
