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

Route::group(['middleware'=>['auth']], function() {
    Route::resource('home',         'HomeController');
    Route::resource('User',         'UserController');
    Route::resource('Org',          'OrganizationController');
    Route::resource('Calendar',     'CalendarController');
    Route::resource('Attendances',  'AttendanceController');
    Route::resource('Approve',      'ApproveEventController');
    Route::resource('Profile',      'UserProfileController');
    Route::resource('Request',      'EventRequestApprovalController');
    Route::resource('Advertise',    'EventAdvertiseController');
    Route::resource('Event',        'EventController', ['parameters' =>[
      'Event' => 'id'
    ]]);
    Route::resource('EventNotification', 'EventNotificationController', ['parameters' =>[
      'Event' => 'id'
    ]]);
    Route::resource('PersonalEvent',        'PersonalEventController', ['parameters' =>[
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
      Route::name('official.attendance')->get('/get/official/attendees/{id}','AttendanceViewController@getOfficialAttendance');
      Route::name('expected.attendance')->get('/get/expected/attendees/{id}','AttendanceViewController@getExpectedAttendance');
      Route::name('confirmed.attendance')->get('/get/confirmed/attendees/{id}','AttendanceViewController@getConfirmedAttendance');
      Route::name('declined.attendance')->get('/get/declined/attendees/{id}','AttendanceViewController@getDeclinedAttendance');
      Route::post('/update','AttendanceViewController@update');
      Route::name('attendance.showWithinEachOrg')->get('get/within-an-organization/attendance/{id}', 'AttendanceController@showWithinEachOrg');
    });

    # additional routes for registering organization-member user type
    Route::prefix('User')->group(function() {
      Route::name('User.existing.assignPosition')->get('/existing-user/assign-position', 'UserController@assignPositionToExistingUser');
      Route::name('User.changePassword')->post('/change-password', 'UserController@changePassword');
      Route::name('user.profile.upload')->post('/upload-profilepic', 'UserController@uploadProfilePic');
      Route::name('user.org-members')->get('/org-member/{orgId}', 'UserController@orgMembers');
    });

    # additional routes for events user type
    Route::prefix('event')->group(function() {
      Route::name('event.showOrgEvents')->get('/org-events/{kind}/{orgId}', 'EventController@showOrgEvents');
      Route::name('event.dlv')->get('/local-events/{id}', 'EventController@dlv');
      Route::name('event.advertise')->post('/AdvertiseEvent', 'EventAdvertiseController@updateEvent');
      Route::name('event.conflicts')->get('/Event/Conflict', 'EventController@showListOfEventConflict');
    });

    # Upload photo
    Route::prefix('upload')->group(function() {
      Route::name('facebook.photo')->post('/facabook/photo', 'UploadPhotoController@uploadFacebookPhoto');
      Route::name('twitter.photo')->post('/twitter/photo', 'UploadPhotoController@uploadTwitterPhoto');
      Route::name('email.photo')->post('/email/photo', 'UploadPhotoController@uploadEmailPhoto');
    });

    Route::post('/EventChecker', 'EventCheckerController@getDate');
    Route::post('/PersonalEventChecker', 'EventCheckerController@getPersonalDate');
    Route::post('/EventChecker/checkuser', 'EventCheckerController@checkEventCreator');
    Route::post('/EventGetter', 'EventGetterController@getEvent');
});
