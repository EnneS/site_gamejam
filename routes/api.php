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
Route::group(['middleware' => 'web'], function() {
  // LOGIN
  Route::get('cas.login', 'Auth\LoginController@login');
  Route::get('cas.logout', 'Auth\LoginController@logout');

  // GETTERS
  Route::get('user', 'StudentController@getUser');
  Route::get('student.team', 'StudentController@getTeam');
  Route::get('teams', 'TeamController@allTeam');
  Route::get('rules', 'RuleController@allRules');
  Route::get('steps', 'StepController@allSteps');
  Route::get('groups', 'GroupController@allGroups');

  // POST
  Route::post('team.create', 'TeamController@createTeam');

  // PATCH
  Route::patch('student.team.leave', 'StudentController@leaveTeam');
  Route::post('student.team.join', 'StudentController@joinTeam');
  Route::post('team.edit', 'TeamController@editTeam');

});
