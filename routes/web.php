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

Route::group(['middleware'=>['auth']], function(){
    Route::resource('home',         'HomeController');
    Route::resource('User',         'UserController');
    Route::resource('Org',          'OrganizationController');
    Route::resource('Calendar',     'CalendarController');
    Route::resource('Attendances',  'AttendanceController');
    Route::resource('Approve',      'ApproveEventController');
    Route::resource('Event',        'EventController', ['parameters' =>[
      'Event' => 'id'
    ]]);
    Route::resource('Attendances', 'AttendanceController', ['parameters' =>[
      'Attendance' => 'id'
    ]]);
    
    # Used for modal request
    Route::prefix('modals')->group(function() {
      Route::name('modal.getUser')->post('/get/user','ModalController@getUser');
      Route::name('modal.getCourse')->post('/get/course','ModalController@getCourse');
      Route::name('modal.getPosition')->post('/get/position','ModalController@getPosition');
      Route::name('modal.getOrganization')->post('/get/organization','ModalController@getOrganization');
      Route::name('modal.getAttendance')->post('/get/attendance','ModalController@getAttendance'); 
    });
    
    # Used for attendances
    Route::prefix('attendance')->group(function() {
      Route::name('attendance.official')->post('/get/official/attendance','AttendanceController@getOfficialAttendance');
      Route::name('attendance.expected')->post('/get/expected/attendance','AttendanceController@getExpectedAttendance');
      Route::name('attendance.confirmed')->post('/get/confirmed/attendance','AttendanceController@getConfirmedAttendance');
      Route::name('attendance.declined')->post('/get/declined/attendance','AttendanceController@getDeclinedAttendance');
      // Route::name('attendance.within')->post('/get/attendance','AttendanceController@getUserOrgs');  (<-edit)
      //for later when authenitcation is complete(for within orgs of a user)
    });
});

