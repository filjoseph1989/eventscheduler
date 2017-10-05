<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
|
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes();
Route::name('my.login')->post('/my-login', 'Auth\LoginController@myLogin');

Route::resource('home',         'HomeController');
Route::resource('User',         'UserController');
Route::resource('Org',          'OrganizationController');
Route::resource('Calendar',     'CalendarController');
Route::resource('Attendances',  'AttendanceController');
Route::resource('Approve',      'ApproveEventController');
Route::resource('Event',        'EventController', ['parameters' =>[
  'Event' => 'id'
]]);
Route::resource('Attendances',        'AttendanceController', ['parameters' =>[
  'Attendance' => 'id'
]]);

# Used for modal request
Route::prefix('modals')->group(function() {
  Route::name('modal.getUser')->post('/get/user','ModalController@getUser');
  Route::name('modal.getCourse')->post('/get/course','ModalController@getCourse');
  Route::name('modal.getPosition')->post('/get/position','ModalController@getPosition');
  Route::name('modal.getOrganization')->post('/get/organization','ModalController@getOrganization');
  Route::name('modal.getAttendace')->post('/get/attendance','getAttendance@getAttendance');
});
