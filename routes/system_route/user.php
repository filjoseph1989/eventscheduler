<?php
Route::prefix('users')->group(function() {
  # Subject for re-evaluation
  Route::name('user.logout')->post('/logout', 'Auth\LoginController@userLogout');
  Route::name('user.profile')->get('/profile/{id?}', 'UserController@viewProfile');
  Route::name('user.profile.upload')->post('/profile/upload', 'UserController@uploadPhoto');

  # Ajax Request
  # Issue 44: This part can be improve by creating a method that accept id and model name
  Route::name('ajax.get.event-type')->post('/get/event-type', 'JsonController@getEventType');
  Route::name('ajax.get.event-category')->post('/get/event-category', 'JsonController@getEventCategory');
  Route::name('ajax.get.organization')->post('/get/organization', 'JsonController@getOrganization');
  Route::name('ajax.get.event.list')->post('/get/event', 'JsonController@getEvent');
  Route::name('ajax.get.events')->post('/get/events', 'JsonController@getEventList');
  Route::name('ajax.get.event.personal.list')->post('/get/personal/event', 'JsonController@getPersonalEvent');
  Route::name('ajax.update.event.personal.list')->post('/update/personal/event', 'JsonController@updatePersonalEvent');
  Route::name('ajax.update.event.list')->post('/update/event', 'JsonController@updateEvent');
  Route::name('ajax.get.event.approvers')->post('/get/approver', 'JsonController@getApprover'); 

  # Include other routing in "routes\system_route\user\user-sub.php"
  require_once 'user/user-sub.php'; 

  # Route for organization adviser
  Route::prefix('org-adviser')->group(function() {
    Route::name('org.adviser.org-list')->get('/','OrganizationAdviser\OrganizationController@index');
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
    Route::name('org-adviser.org-edit')->get('/edit-org/{id}', 'OrganizationAdviser\OrganizationController@edit');
    Route::name('org-adviser.org-update')->post('/update-org', 'OrganizationAdviser\OrganizationController@update');
    Route::name('org-adviser.members.list')->get('/members/list', 'OrganizationAdviser\OrganizationGroupController@index');
    Route::name('org-adviser.event.show')->get('/show/{id?}', 'OrganizationAdviser\EventController@show');
    Route::name('org-adviser.attendance')->get('/attendance', 'OrganizationAdviser\GenerateAttendanceController@index');
    Route::name('org-adviser.attendance.show')->get('/new/{id}/{eid}', 'OrganizationAdviser\GenerateAttendanceController@show');
    Route::name('org-adviser.attendance.store')->post('/store', 'OrganizationAdviser\GenerateAttendanceController@store');
    Route::name('org-adviser.userattendance.store')->post('user-attendance/store', 'OrganizationAdviser\UserAttendanceController@store');
    Route::name('org-adviser.calendar.within')->get('/calendar/within', 'OrganizationAdviser\CalendarController@calendarWithin');
    Route::name('org-adviser.calendar')->get('/calendar/{id?}', 'OrganizationAdviser\CalendarController@calendar');
  }); 

  # Route for organization head
  Route::prefix('org-head')->group(function() {
    Route::name('org-head.org-list')->get('/list_of_organizations','OrganizationHead\OrganizationController@index');
    Route::name('org-head.org-profile')->get('/profile/{id}', 'OrganizationHead\OrganizationController@show');
    Route::name('org-head.org-logo')->post('/change-logo', 'OrganizationHead\OrganizationController@uploadLogo');
    Route::name('org-head.org-edit')->get('/edit-org/{id}', 'OrganizationHead\OrganizationController@edit');
    Route::name('org-head.org-update')->post('/update-org', 'OrganizationHead\OrganizationController@update');
    Route::name('org-head.event.new')->get('/new', 'OrganizationHead\EventController@create');
    Route::name('org-head.event.new')->post('/new', 'OrganizationHead\EventController@store');
    Route::name('org-head.event.list')->get('/get/event-list/{id?}', 'OrganizationHead\EventController@index');
    Route::name('org-head.my.new.event')->get('/my/new/event', 'OrganizationHead\MyEventController@create');
    Route::name('org-head.my.new.event.submit')->post('/store/new', 'OrganizationHead\MyEventController@store');
    Route::name('org-head.approve.event')->get('/approve/event', 'OrganizationHead\EventController@approveEvents');
    Route::name('org-head.attendance')->get('/attendance', 'OrganizationHead\GenerateAttendanceController@index');
    Route::name('org-head.event.show')->get('/show/{id?}', 'OrganizationHead\EventController@show');
    Route::name('org-head.attendance.store')->post('/store', 'OrganizationHead\GenerateAttendanceController@store');
    Route::name('org-head.attendance.show')->get('/new/{id}/{eid}', 'OrganizationHead\GenerateAttendanceController@show');
    Route::name('org-head.my.new.event')->get('/my/new/event', 'OrganizationHead\MyEventController@create');
    Route::name('org-head.my.new.event.submit')->post('/store/new', 'OrganizationHead\MyEventController@store');
    Route::name('org-head.approved.event')->get('/approved/event/{id}', 'OrganizationHead\EventController@setApprove');
    Route::name('org-head.disapproved.event')->get('/disapproved/event/{id}', 'OrganizationHead\EventController@setDisApprove');
    Route::name('org-head.userattendance.store')->post('user-attendance/store', 'OrganizationHead\UserAttendanceController@store');
    Route::name('org-head.org-membership')->post('/org-membership', 'OrganizationHead\OrganizationGroupController@store');
    Route::name('org-head.members.list')->get('/members/list', 'OrganizationHead\OrganizationGroupController@index');
    Route::name('org-head.members.add')->get('/members/add', 'OrganizationHead\OrganizationGroupController@create');
    Route::name('org-head.members.search')->post('/members/search', 'OrganizationHead\UserController@search');
    Route::name('org-head.members.new')->post('/members/new', 'OrganizationHead\OrganizationGroupController@storeNewMember');
    Route::name('org-head.members.accept')->post('/members/accept', 'OrganizationHead\OrganizationGroupController@acceptNewMember');
    Route::name('org-head.calendar.within')->get('/calendar/within', 'OrganizationHead\CalendarController@calendarWithin');
    Route::name('org-head.calendar')->get('/calendar/{id?}', 'OrganizationHead\CalendarController@calendar');
  });

  # Route for organization member
  Route::prefix('org-member')->group(function() {
    Route::name('org-member.org-list')->get('/list_of_organizations','OrganizationMember\OrganizationController@index');
    Route::name('org-member.my.new.event')->get('/my/new/event', 'OrganizationMember\MyEventController@create');
    Route::name('org-member.my.new.event.submit')->post('/store/new', 'OrganizationMember\MyEventController@store');
    Route::name('org-member.event.list')->get('/get/event-list/{id?}', 'OrganizationMember\EventController@index');
    Route::name('org-member.approve.event')->get('/approve/event', 'OrganizationMember\EventController@approveEvents');
    Route::name('org-member.calendar')->get('/calendar', 'OrganizationMember\CalendarController@calendar');
    Route::name('org-member.members.list')->get('/members/list', 'OrganizationMember\OrganizationGroupController@index');
    Route::name('org-member.attendance')->get('/attendance', 'OrganizationMember\GenerateAttendanceController@index');
    Route::name('org-member.event.show')->get('/show/{id?}', 'OrganizationMember\EventController@show');
    Route::name('org-member.attendance.store')->post('/store', 'OrganizationMember\GenerateAttendanceController@store');
    Route::name('org-member.org-profile')->get('/profile/{id}', 'OrganizationMember\OrganizationController@show');
    Route::name('org-member.org-edit')->get('/edit-org/{id}', 'OrganizationMember\OrganizationController@edit');
    Route::name('org-member.org-logo')->post('/change-logo', 'OrganizationMember\OrganizationController@uploadLogo');
    Route::name('org-member.org-membership')->post('/org-membership', 'OrganizationMember\OrganizationGroupController@store'); 
  });

  Route::prefix('osa-personnel')->group(function() {
    Route::name('osa-personnel.org-list')->get('/list_of_organizations','OsaPersonnel\OrganizationController@index');
    Route::name('osa-personnel.org-profile')->get('/profile/{id}', 'OsaPersonnel\OrganizationController@show');
    Route::name('osa-personnel.org-logo')->post('/change-logo', 'OsaPersonnel\OrganizationController@uploadLogo');
    Route::name('osa-personnel.org-edit')->get('/edit-org/{id}', 'OsaPersonnel\OrganizationController@edit');
    Route::name('osa-personnel.org-update')->post('/update-org', 'OsaPersonnel\OrganizationController@update');
    Route::name('osa-personnel.event.new')->get('/new', 'OsaPersonnel\EventController@create');
    Route::name('osa-personnel.event.new')->post('/new', 'OsaPersonnel\EventController@store');
    Route::name('osa-personnel.event.list')->get('/get/event-list/{id?}', 'OsaPersonnel\EventController@index');
    Route::name('osa-personnel.my.new.event')->get('/my/new/event', 'OsaPersonnel\MyEventController@create');
    Route::name('osa-personnel.my.new.event.submit')->post('/store/new', 'OsaPersonnel\MyEventController@store');
    Route::name('osa-personnel.approve.event')->get('/approve/event', 'OsaPersonnel\EventController@approveEvents');
    Route::name('osa-personnel.calendar')->get('/calendar', 'OsaPersonnel\CalendarController@calendar');
    Route::name('osa-personnel.attendance')->get('/attendance', 'OsaPersonnel\GenerateAttendanceController@index');
    Route::name('osa-personnel.event.show')->get('/show/{id?}', 'OsaPersonnel\EventController@show');
    Route::name('osa-personnel.attendance.store')->post('/store', 'OsaPersonnel\GenerateAttendanceController@store');
    Route::name('osa-personnel.attendance.show')->get('/new/{id}/{eid}', 'OsaPersonnel\GenerateAttendanceController@show');
    Route::name('osa-personnel.my.new.event')->get('/my/new/event', 'OsaPersonnel\MyEventController@create');
    Route::name('osa-personnel.my.new.event.submit')->post('/store/new', 'OsaPersonnel\MyEventController@store');
    Route::name('osa-personnel.approved.event')->get('/approved/event/{id}', 'OsaPersonnel\EventController@setApprove');
    Route::name('osa-personnel.disapproved.event')->get('/disapproved/event/{id}', 'OsaPersonnel\EventController@setDisApprove');
    Route::name('osa-personnel.userattendance.store')->post('user-attendance/store', 'OsaPersonnel\UserAttendanceController@store');
    Route::name('osa-personnel.org-membership')->post('/org-membership', 'OsaPersonnel\OrganizationGroupController@store');
    Route::name('osa-personnel.members.list')->get('/members/list', 'OsaPersonnel\OrganizationGroupController@index');
    Route::name('osa-personnel.members.add')->get('/members/add', 'OsaPersonnel\OrganizationGroupController@create');
    Route::name('osa-personnel.members.search')->post('/members/search', 'OsaPersonnel\UserController@search');
    Route::name('osa-personnel.members.new')->post('/members/new', 'OsaPersonnel\OrganizationGroupController@storeNewMember');
    Route::name('osa-personnel.members.accept')->post('/members/accept', 'OsaPersonnel\OrganizationGroupController@acceptNewMember');
  });

});
