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


/* 
            HTTP Syayus codes... from https://en.wikipedia.org/wiki/List_of_HTTP_status_codes  

    status code => meaning
    201 => Created
    403 => forbidden




*/

// didn't even touch this :v

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// public routes
// all should be in protected

Route::get('projects', 'App\Http\Controllers\ProjectController@index');
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('logIn', 'App\Http\Controllers\AuthController@logIn');

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('recentProjects', 'App\Http\Controllers\ProjectController@recentProjects');
    Route::get('flutterRecentProjects', 'App\Http\Controllers\ProjectController@flutterRecentProjects');
    Route::get('logOut', 'App\Http\Controllers\AuthController@logOut');
    Route::post('phases/findPhasesByProjectId', 'App\Http\Controllers\PhaseController@findPhasesByProjectId');
    Route::post('tasks/findPTasksByPhaseId', 'App\Http\Controllers\TaskController@findPTasksByPhaseId');
    Route::post('tasks/changeStatus', 'App\Http\Controllers\TaskController@changeStatus');


  
    Route::get('projects/findByName', 'App\Http\Controllers\ProjectController@findByName');
    Route::post('projects/store', 'App\Http\Controllers\ProjectController@store');
    Route::get('projects/show', 'App\Http\Controllers\ProjectController@show');
    Route::post('projects/update', 'App\Http\Controllers\ProjectController@update');
    Route::post('projects/delete', 'App\Http\Controllers\ProjectController@delete');

    Route::delete('projects/destroy', 'App\Http\Controllers\ProjectController@destroy');

    Route::get('phases', 'App\Http\Controllers\PhaseController@index');
    Route::get('phases/findByName', 'App\Http\Controllers\PhaseController@findByName');
    Route::post('phases/store', 'App\Http\Controllers\PhaseController@store');
    Route::get('phases/show', 'App\Http\Controllers\PhaseController@show');
    Route::post('phases/update', 'App\Http\Controllers\PhaseController@update');
    Route::delete('phases/destroy', 'App\Http\Controllers\PhaseController@destroy');



    
    Route::get('phases/findByProjectId/{id}', 'App\Http\Controllers\PhaseController@findByProjectId');
    Route::get('phases/AllDoneByProjectId/{id}', 'App\Http\Controllers\PhaseController@AllDoneByProjectId');
    Route::get('tasks/findByPhaseId/{id}', 'App\Http\Controllers\TaskController@findByPhaseId');
    Route::post('tasks/store', 'App\Http\Controllers\TaskController@store');
    Route::get('users/signIn/{email}/{password}', 'App\Http\Controllers\UserController@signIn');

    Route::get('users','App\Http\Controllers\UserController@index');

});




// Route::apiResource('projects', ProjectController::class);



// Route::apiResource('phases', PhaseController::class);

// Route::apiResource('Roles', RoleController::class);

// Route::apiResource('tasks', TaskController::class);

// Route::apiResource('sub_tasks', SubTaskController::class);

// Route::apiResource('users', UserController::class); 