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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('projects/findByName/{name}', 'App\Http\Controllers\ProjectController@findByName');
Route::get('phases/findByProjectId/{id}', 'App\Http\Controllers\PhaseController@findByProjectId');
Route::get('phases/AllDoneByProjectId/{id}', 'App\Http\Controllers\PhaseController@AllDoneByProjectId');
Route::get('tasks/findByPhaseId/{id}', 'App\Http\Controllers\TaskController@findByPhaseId');





Route::apiResource('projects', ProjectController::class);



Route::apiResource('phases', PhaseController::class);

Route::apiResource('Roles', RoleController::class);

Route::apiResource('tasks', TaskController::class);

Route::apiResource('sub_tasks', SubTaskController::class);

Route::apiResource('users', UserController::class); 