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
  // =======================
  // ======= GUEST =========
  // =======================
  // Student Login
  Route::get('cas.login', 'Auth\LoginController@login');
  Route::get('cas.logout', 'Auth\LoginController@logout');

  // Admin Login
  Route::post('admin.login', 'Auth\LoginController@AdminLogin');
  Route::post('admin.logout', 'Auth\LoginController@AdminLogout');

  // Get the authentified user if there is one
  Route::get('user', 'StudentController@getUser');

  // Guest Views Data
  Route::get('teams', 'TeamController@allTeam');
  Route::get('rules', 'RuleController@allRules');
  Route::get('steps', 'StepController@allSteps');
  Route::get('groups', 'GroupController@allGroups');

  // ======================
  // ======= STUDENT ======
  // ======================
  // Teams
  Route::get('student.team', 'StudentController@getTeam')->middleware('auth');
  Route::post('team.create', 'TeamController@createTeam')->middleware('auth');
  Route::post('team.edit', 'TeamController@editTeam')->middleware('auth');

  // Join / Leave a team
  Route::patch('student.team.leave', 'StudentController@leaveTeam')->middleware('auth');
  Route::post('student.team.join', 'StudentController@joinTeam')->middleware('auth');

});
