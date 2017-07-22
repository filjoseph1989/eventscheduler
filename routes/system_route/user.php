<?php
Route::prefix('users')->group(function() {
  # Subject for re-evaluation
  require_once 'user/user-sub.php';

  # Attendance
  Route::prefix('attendance')->group(function() {
    Route::name('attendance')->get('/new/{id}/{eid}', 'OrganizationHead\ManageSchedule\GenerateAttendanceController@index');
    Route::name('attendance.store')->post('/store', 'OrganizationHead\ManageSchedule\GenerateAttendanceController@store');
  });

  # Route for organization adviser
  Route::prefix('org-adviser')->group(function() {
    Route::name('org.adviser.org-list')->get('/list_of_organizations','OrganizationAdviser\Organization\OrganizationController@showAllOrganizationList');
    Route::name('org-adviser.my-org-list')->get('/org-list', 'OrganizationAdviser\OrgAdviserAccountController@myOrganization');
    Route::name('org-adviser.calendar')->get('/calendar/{id}', 'OrganizationAdviser\ManageSchedule\CalendarController@myOrgCalendar');
    Route::name('org-adviser.org-profile')->get('/profile/{id}', 'OrganizationAdviser\Organization\OrganizationController@orgProfile');
    Route::name('org-adviser.personal-calendar')->get('/personal-calendar', 'OrganizationAdviser\OrgAdviserAccountController@myPersonalCalendar');
    Route::name('org-adviser.personal-calendar-post')->post('/ajax/personal-event', 'OrganizationAdviser\Events\EventController@getPersonalEvent');
    Route::name('org-adviser.event.get')->get('/get', 'OrganizationAdviser\Events\EventController@getEventList');
    Route::name('org-adviser.event.public')->get('/get/public', 'OrganizationAdviser\Events\EventController@getEventListPublic');
    Route::name('org-adviser.event.within')->get('/get/within', 'OrganizationAdviser\Events\EventController@getEventListWithin');
    Route::name('org-adviser.event.among')->get('/get/among', 'OrganizationAdviser\Events\EventController@getEventListAmong');
    Route::name('org-adviser.event.own')->get('/get/own', 'OrganizationAdviser\Events\EventController@getEventListOwn');
    Route::name('org-adviser.event.new')->get('/new', 'OrganizationAdviser\Events\EventController@createNewEventForm');
    Route::name('org-adviser.event.new')->post('/new', 'OrganizationAdviser\Events\EventController@createNewEvent');
    Route::name('event.gets')->post('/event/gets', 'OrganizationAdviser\Events\EventController@getEventOfTheMonth');
  });

  # Route for organization head
  Route::prefix('org-head')->group(function() {
    Route::name('org-head.event.get')->get('/get', 'OrganizationHead\Events\EventController@getEventOfTheMonthList');
    Route::name('org-head.event.get.personal')->get('/get/personal', 'OrganizationHead\Events\EventController@getPersonalEventOfTheMonthList');
    Route::name('org-head.event.get.ajax')->post('/ajax/get', 'OrganizationHead\Events\EventController@getEvent');
    Route::name('org-head.event.edit')->post('/edit', 'OrganizationHead\Events\EventController@editEvent');
    Route::name('org-head.org-list')->get('/org-list', 'OrganizationHead\OrgHeadAccountController@myOrganization');
    Route::name('org-head.calendar')->get('/calendar/{id}', 'OrganizationHead\ManageSchedule\CalendarController@myOrgCalendar');
    Route::name('org-head.personal-calendar')->get('/org-personal-calendar', 'OrganizationHead\ManageSchedule\CalendarController@myPersonalCalendar');
    Route::name('org-head.personal-calendar-post')->post('/ajax/personal-event', 'OrganizationHead\Events\EventController@getPersonalEvent');
    Route::name('org-head.approval')->get('/event/approval', 'OrganizationHead\Events\EventController@approveEvents');

    # Display calendar
    Route::prefix('calendar')->group(function() {
      Route::name('university-calendar')->get('/university-calendar', 'OrganizationHead\ManageSchedule\CalendarController@universityCalendar');
      Route::name('all-organization-calendar')->get('/all-organization-calendar', 'OrganizationHead\ManageSchedule\CalendarController@allOrgsCalendar');
      Route::name('my-organization-calendar')->get('/my-organization-calendar', 'OrganizationHead\ManageSchedule\CalendarController@myOrgCalendar');
      Route::name('my-personal-calendar')->get('/my-personal-calendar', 'OrganizationHead\ManageSchedule\CalendarController@myPersonalCalendar');
    });

    # Create event
    Route::prefix('event')->group(function() {
      Route::name('event.show')->get('/show', 'OrganizationHead\Events\EventController@showEvents');
      Route::name('event.new')->get('/new', 'OrganizationHead\Events\EventController@createNewEventForm');
      Route::name('event.new')->post('/new', 'OrganizationHead\Events\EventController@createNewEvent');
      Route::name('event.get')->get('/get', 'OrganizationHead\Events\EventController@getEventOfTheMonthList');
      Route::name('event.gets')->post('/gets', 'OrganizationHead\Events\EventController@getEventOfTheMonth');
      Route::name('event.ajax.get')->post('/ajax/get', 'OrganizationHead\Events\EventController@getEvent'); # Remove me soon
    });
  });

  # Route for organization member
  Route::prefix('org-member')->group(function() {
    Route::name('org-member.event.get')->get('/get', 'OrganizationMember\Events\EventController@getEventOfTheMonthList');
    Route::name('org-member.event.get.ajax')->post('/ajax/get', 'OrganizationMember\Events\EventController@getEvent');
    Route::name('org-member.event.edit')->post('/edit', 'OrganizationMember\Events\EventController@editEvent');
    Route::name('org-member.org-list')->get('/org-list', 'OrganizationMember\OrgHeadAccountController@myOrganization');
    Route::name('org-member.calendar')->get('/calendar/{id}', 'OrganizationMember\ManageSchedule\CalendarController@myOrgCalendar');
    Route::name('org-member.personal-calendar')->get('/org-personal-calendar', 'OrganizationMember\ManageSchedule\CalendarController@myPersonalCalendar');
    Route::name('org-member.personal-calendar-post')->post('/ajax/personal-event', 'OrganizationMember\Events\EventController@getPersonalEvent');
  });

  # OSA account routes
  Route::prefix('osa-personnel')->group(function() {
    Route::name('osa-personnel.organization.list')->get('/organization/list', 'OsaPersonnel\Organization\OrganizationController@showAllOrganizationList'); # Remove me soon
    Route::name('osa-personnel.organization.edit')->post('/organization/edit', 'OsaPersonnel\Organization\OrganizationController@osaEditOrganization');
    Route::name('osa-personnel.organization.register')->post('/organization/register', 'OsaPersonnel\Organization\OrganizationController@adminCreate'); # remove me soon
    Route::name('osa-personnel.event.get')->get('/get', 'OsaPersonnel\ManageEvents\EventController@getEventOfTheMonthList');
    Route::name('osa-personnel.event.new')->post('/new', 'OsaPersonnel\ManageEvents\EventController@createNewEvent');
    Route::name('osa-personnel.event.approval.within')->get('osa/event/approval/within', 'OsaPersonnel\ManageEvents\EventController@approveEventWithin');
    Route::name('osa-personnel.osa-approve')->get('/event/approved/{id}/{orgg_uid}', 'OsaPersonnel\ManageEvents\EventController@approve');
    Route::name('osa-personnel.org-list')->get('/org-list', 'OsaPersonnel\OsaAccountController@myOrganization');
    Route::name('osa-personnel.calendar')->get('/calendar/{id}', 'OsaPersonnel\ManageSchedule\CalendarController@myOrgCalendar');
  });

  /**
   * OSA User Account Type
   */
  Route::name('osa.user.list')->get('osa/list_of_users','OsaAccountController@showAllUserList');
  Route::name('osa.org.list')->get('osa/list_of_organizations','OsaAccountController@showAllOrganizationList');
  Route::name('osa.org.add')->get('osa/organization/add', 'OsaAccountController@showOrganizationAddForm');
  Route::name('osa.event.get')->get('osa/event/get', 'OsaAccountController@getEventOfTheMonthList');
  Route::name('osa.event.new')->get('osa/event/new', 'OsaAccountController@createNewEventForm');
  Route::name('osa.event.approval')->get('osa/event/approval', 'OsaAccountController@approveEvents');
  Route::name('osa.event.osa-approve')->get('osa/event/approved/{id}', 'OsaAccountController@approve');
  Route::name('osa.event.osa-disapprove')->get('osa/event/disapproved/{id}/{orgg_uid}', 'OsaAccountController@disapprove');
  Route::name('osa.event.notify')->get('osa/event/notify', 'ManageNotificationController@notify');

  /**
   * Admin User Account Type
   */
  Route::name('administrator.user.list')->get('administrator/users/list', 'AdminAccountController@showAllUserList');
  Route::name('administrator.course.list')->get('administrator/course/list', 'AdminAccountController@showAllCourseList');
  Route::name('administrator.department.list')->get('administrator/department/list', 'AdminAccountController@showAllDepartmentList');
  Route::name('administrator.position.list')->get('administrator/position/list', 'AdminAccountController@showAllPositionList');
  Route::name('administrator.organization.list')->get('administrator/organization/list', 'AdminAccountController@showAllOrganizationList');
});
