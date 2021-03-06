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

  // Get the authentified user if there is one
  Route::get('user', 'StudentController@getUser');

  // Guest Views Data
  Route::get('teams', 'TeamController@allTeam');
  Route::get('rules', 'RuleController@allRules');
  Route::get('steps', 'StepController@allSteps');
  Route::get('groups', 'GroupController@allGroups');
  Route::get('halloffame', 'HallOfFameController@getYears');

  // ======================
  // ======= STUDENT ======
  // ======================
  // Notifications
  Route::get('student.notifications', 'NotificationController@getNotifications')->middleware('student');

  // Teams
  Route::get('student.team', 'StudentController@getTeam')->middleware('student');
  Route::post('team.create', 'TeamController@createTeam')->middleware('student');
  Route::post('team.edit', 'TeamController@editTeam')->middleware('student');

  // Join / Leave a team
  Route::post('student.team.leave', 'StudentController@leaveTeam')->middleware('student');
  Route::post('student.team.join', 'StudentController@joinTeam')->middleware('student');
  Route::post('student.team.acceptRequest', 'TeamController@acceptRequest')->middleware('student');
  Route::post('student.team.declineRequest', 'TeamController@declineRequest')->middleware('student');


  // ======================
  // ======= ADMIN ========
  // ======================
  Route::post('admin.uploadBareme', 'AdminController@uploadBareme');

  Route::get('admin.notifications', 'AdminController@getNotifications');
  Route::post('admin.notification.create', 'AdminController@createNotification');
  Route::post('admin.notification.delete', 'AdminController@deleteNotification');

  Route::get('admin.students', 'AdminController@getStudents');
  Route::get('admin.students.generate', 'AdminController@readStudentList');
  Route::post('admin.student.delete', 'AdminController@deleteStudent');
  Route::post('admin.student.create', 'AdminController@createStudent');

  Route::get('admin.configuration', 'AdminController@getConfiguration');
  Route::post('admin.configuration.update', 'AdminController@updateConfiguration');

  Route::get('admin.admins', 'AdminController@getAdmins');
  Route::post('admin.admin.delete', 'AdminController@deleteAdmin');
  Route::post('admin.admin.create', 'AdminController@createAdmin');

  Route::get('admin.teams', 'AdminController@getTeams');
  Route::post('admin.teams.delete', 'AdminController@deleteTeams');
  Route::post('admin.team.delete', 'AdminController@deleteTeam');
  Route::get('admin.getTeam', 'AdminController@getTeam');
  Route::post('admin.team.update', 'AdminController@updateTeam');

  Route::get('admin.groups', 'AdminController@getGroups');
  Route::get('admin.groups.generate', 'AdminController@generateGroups');
  Route::post('admin.groups.delete', 'AdminController@deleteGroups');

  Route::get('admin.steps', 'AdminController@getSteps');
  Route::get('admin.getStep', 'AdminController@getStep');
  Route::post('admin.step.create', 'AdminController@createStep');
  Route::post('admin.step.delete', 'AdminController@deleteStep');
  Route::post('admin.step.update', 'AdminController@updateStep');

  Route::get('admin.rules', 'AdminController@getRules');
  Route::get('admin.getRule', 'AdminController@getRule');
  Route::post('admin.rule.create', 'AdminController@createRule');
  Route::post('admin.rule.delete', 'AdminController@deleteRule');
  Route::post('admin.rule.update', 'AdminController@updateRule');


});
