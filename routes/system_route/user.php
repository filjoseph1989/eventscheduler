<?php
Route::prefix('users')->group(function() {
  # Subject for re-evaluation
  Route::name('user.logout')->post('/logout', 'Auth\LoginController@userLogout');
  Route::name('user.profile')->get('/profile/{id?}', 'UserController@viewProfile');
  Route::name('user.profile.upload')->post('/profile/upload', 'UserController@uploadPhoto');

  # Include other routing in "routes\system_route\user\user-sub.php"
  require_once 'user/user-sub.php';

  # Route for organization adviser
  Route::prefix('org-adviser')->group(function() {
    Route::name('org.adviser.org-list')->get('/list_of_organizations','OrganizationAdviser\OrganizationController@index');
    Route::name('org-adviser.event.list')->get('/get/event-list/{id?}', 'OrganizationAdviser\EventController@index');
    Route::name('org-adviser.org-profile')->get('/profile/{id}', 'OrganizationAdviser\OrganizationController@show');
    Route::name('org-adviser.org-logo')->post('/change-logo', 'OrganizationAdviser\OrganizationController@uploadLogo');
    Route::name('org-adviser.org-membership')->post('/org-membership', 'OrganizationAdviser\OrganizationGroupController@store');
    Route::name('org-adviser.my.new.event')->get('/my/new/event', 'OrganizationAdviser\MyEventController@create');
    Route::name('org-adviser.my.new.event.submit')->post('/store/new', 'OrganizationAdviser\MyEventController@store');
    Route::name('org-adviser.event.new')->get('/new', 'OrganizationAdviser\EventController@create');
    Route::name('org-adviser.event.new')->post('/new', 'OrganizationAdviser\EventController@store');
    Route::name('org-adviser.approve.event')->get('/approve/event', 'OrganizationAdviser\EventController@approveEvents');
    Route::name('org-adviser.approved.event')->get('/approved/event/{id}', 'OrganizationAdviser\EventController@setApprove');
    Route::name('org-adviser.disapproved.event')->get('/disapproved/event/{id}', 'OrganizationAdviser\EventController@setDisApprove');
    Route::name('org-adviser.calendar')->get('/calendar', 'OrganizationAdviser\CalendarController@calendar');
    Route::name('org-adviser.org-edit')->get('/edit-org/{id}', 'OrganizationAdviser\OrganizationController@edit');
    Route::name('org-adviser.org-update')->post('/update-org', 'OrganizationAdviser\OrganizationController@update');
    Route::name('org-adviser.members.list')->get('/members/list', 'OrganizationAdviser\OrganizationGroupController@index');
    Route::name('org-adviser.event.show')->get('/show/{id}', 'OrganizationAdviser\EventController@show');
    Route::name('org-adviser.attendance')->get('/attendance', 'OrganizationAdviser\GenerateAttendanceController@index');
    Route::name('org-adviser.attendance.show')->get('/new/{id}/{eid}', 'OrganizationAdviser\GenerateAttendanceController@show');
    Route::name('org-adviser.attendance.store')->post('/store', 'OrganizationAdviser\GenerateAttendanceController@store');

    # Issue 44: This part can be improve by creating a method that accept id and model name
    Route::name('ajax.get.event-type')->post('/get/event-type', 'OrganizationAdviser\AdviserJsonController@getEventType');
    Route::name('ajax.get.event-category')->post('/get/event-category', 'OrganizationAdviser\AdviserJsonController@getEventCategory');
    Route::name('ajax.get.organization')->post('/get/organization', 'OrganizationAdviser\AdviserJsonController@getOrganization');
    Route::name('ajax.get.event.list')->post('/get/event', 'OrganizationAdviser\AdviserJsonController@getEvent');
    Route::name('ajax.get.events')->post('/get/events', 'OrganizationAdviser\AdviserJsonController@getEventList');
    Route::name('ajax.get.event.personal.list')->post('/get/personal/event', 'OrganizationAdviser\AdviserJsonController@getPersonalEvent');
    Route::name('ajax.update.event.personal.list')->post('/update/personal/event', 'OrganizationAdviser\AdviserJsonController@updatePersonalEvent');
    Route::name('ajax.update.event.list')->post('/update/event', 'OrganizationAdviser\AdviserJsonController@updateEvent');
  });

  # Attendance
  # Issue 47: Remove this soon
  Route::prefix('attendance')->group(function() {
    Route::name('attendance')->get('/new/{id}/{eid}', 'OrganizationHead\ManageSchedule\GenerateAttendanceController@index');
    Route::name('attendance.store')->post('/store', 'OrganizationHead\ManageSchedule\GenerateAttendanceController@store');
  });

  //   # Create event
  //   Route::prefix('event')->group(function() {
      // Route::name('event.show')->get('/show', 'OrganizationHead\Events\EventController@showEvents');
      // Route::name('event.new')->get('/new', 'OrganizationHead\Events\EventController@createNewEventForm');
      // Route::name('event.new')->post('/new', 'OrganizationHead\Events\EventController@createNewEvent');
  //     Route::name('event.get')->get('/get', 'OrganizationHead\Events\EventController@getEventOfTheMonthList');
  //     Route::name('event.gets')->post('/gets', 'OrganizationHead\Events\EventController@getEventOfTheMonth');
  //     Route::name('event.ajax.get')->post('/ajax/get', 'OrganizationHead\Events\EventController@getEvent'); # Remove me soon
  //   });
  // });

  # Route for organization head
  // Route::prefix('org-head')->group(function() {
  //   Route::name('org-head.event.get')->get('/get', 'OrganizationHead\Events\EventController@getEventOfTheMonthList');
  //   Route::name('org-head.event.get.personal')->get('/get/personal', 'OrganizationHead\Events\EventController@getPersonalEventOfTheMonthList');
  //   Route::name('org-head.event.get.ajax')->post('/ajax/get', 'OrganizationHead\Events\EventController@getEvent');
  //   Route::name('org-head.event.edit')->post('/edit', 'OrganizationHead\Events\EventController@editEvent');
  //   Route::name('org-head.org-list')->get('/org-list', 'OrganizationHead\OrgHeadAccountController@myOrganization');
  //   Route::name('org-head.calendar')->get('/calendar/{id}', 'OrganizationHead\ManageSchedule\CalendarController@myOrgCalendar');
  //   Route::name('org-head.personal-calendar')->get('/org-personal-calendar', 'OrganizationHead\ManageSchedule\CalendarController@myPersonalCalendar');
  //   Route::name('org-head.personal-calendar-post')->post('/ajax/personal-event', 'OrganizationHead\Events\EventController@getPersonalEvent');
    // Route::name('org-head.approval')->get('/event/approval', 'OrganizationHead\Events\EventController@approveEvents');

  //   # Display calendar
  //   Route::prefix('calendar')->group(function() {
  //     Route::name('university-calendar')->get('/university-calendar', 'OrganizationHead\ManageSchedule\CalendarController@universityCalendar');
  //     Route::name('all-organization-calendar')->get('/all-organization-calendar', 'OrganizationHead\ManageSchedule\CalendarController@allOrgsCalendar');
  //     Route::name('my-organization-calendar')->get('/my-organization-calendar', 'OrganizationHead\ManageSchedule\CalendarController@myOrgCalendar');
  //     Route::name('my-personal-calendar')->get('/my-personal-calendar', 'OrganizationHead\ManageSchedule\CalendarController@myPersonalCalendar');
  //   });


  # Route for organization member
  Route::prefix('org-member')->group(function() {
    // Route::name('org-member.org-list')->get('/org-list', 'OrganizationMember\OrgHeadAccountController@myOrganization');
  //   Route::name('org-member.event.get')->get('/get', 'OrganizationMember\Events\EventController@getEventOfTheMonthList');
  //   Route::name('org-member.event.get.ajax')->post('/ajax/get', 'OrganizationMember\Events\EventController@getEvent');
  //   Route::name('org-member.event.edit')->post('/edit', 'OrganizationMember\Events\EventController@editEvent');
  //   Route::name('org-member.calendar')->get('/calendar/{id}', 'OrganizationMember\ManageSchedule\CalendarController@myOrgCalendar');
  //   Route::name('org-member.personal-calendar')->get('/org-personal-calendar', 'OrganizationMember\ManageSchedule\CalendarController@myPersonalCalendar');
  //   Route::name('org-member.personal-calendar-post')->post('/ajax/personal-event', 'OrganizationMember\Events\EventController@getPersonalEvent');
  });

  # OSA account routes
//   Route::prefix('osa-personnel')->group(function() {
//     Route::name('osa-personnel.organization.list')->get('/organization/list', 'OsaPersonnel\Organization\OrganizationController@showAllOrganizationList'); # Remove me soon
//     Route::name('osa-personnel.organization.edit')->post('/organization/edit', 'OsaPersonnel\Organization\OrganizationController@osaEditOrganization');
//     Route::name('osa-personnel.organization.register')->post('/organization/register', 'OsaPersonnel\Organization\OrganizationController@adminCreate'); # remove me soon
//     Route::name('osa-personnel.event.get')->get('/get', 'OsaPersonnel\ManageEvents\EventController@getEventOfTheMonthList');
//     Route::name('osa-personnel.event.new')->post('/new', 'OsaPersonnel\ManageEvents\EventController@createNewEvent');
//     Route::name('osa-personnel.event.approval.within')->get('osa/event/approval/within', 'OsaPersonnel\ManageEvents\EventController@approveEventWithin');
//     Route::name('osa-personnel.osa-approve')->get('/event/approved/{id}/{orgg_uid}', 'OsaPersonnel\ManageEvents\EventController@approve');
//     Route::name('osa-personnel.org-list')->get('/org-list', 'OsaPersonnel\OsaAccountController@myOrganization');
//     Route::name('osa-personnel.calendar')->get('/calendar/{id}', 'OsaPersonnel\ManageSchedule\CalendarController@myOrgCalendar');
//   });
//
//   /**
//    * OSA User Account Type
//    */
//   Route::name('osa.user.list')->get('osa/list_of_users','OsaAccountController@showAllUserList');
//   Route::name('osa.org.list')->get('osa/list_of_organizations','OsaAccountController@showAllOrganizationList');
//   Route::name('osa.org.add')->get('osa/organization/add', 'OsaAccountController@showOrganizationAddForm');
//   Route::name('osa.event.get')->get('osa/event/get', 'OsaAccountController@getEventOfTheMonthList');
//   Route::name('osa.event.new')->get('osa/event/new', 'OsaAccountController@createNewEventForm');
//   Route::name('osa.event.approval')->get('osa/event/approval', 'OsaAccountController@approveEvents');
//   Route::name('osa.event.osa-approve')->get('osa/event/approved/{id}', 'OsaAccountController@approve');
//   Route::name('osa.event.osa-disapprove')->get('osa/event/disapproved/{id}/{orgg_uid}', 'OsaAccountController@disapprove');
//   Route::name('osa.event.notify')->get('osa/event/notify', 'ManageNotificationController@notify');
//
//   /**
//    * Admin User Account Type
//    */
  // Route::name('administrator.user.list')->get('administrator/users/list', 'AdminAccountController@showAllUserList');
  // Route::name('administrator.course.list')->get('administrator/course/list', 'AdminAccountController@showAllCourseList');
  // Route::name('administrator.department.list')->get('administrator/department/list', 'AdminAccountController@showAllDepartmentList');
  // Route::name('administrator.position.list')->get('administrator/position/list', 'AdminAccountController@showAllPositionList');
  // Route::name('administrator.organization.list')->get('administrator/organization/list', 'AdminAccountController@showAllOrganizationList');
});
