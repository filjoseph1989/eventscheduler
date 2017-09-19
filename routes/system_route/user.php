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
    Route::name('org-adviser.org-list')->get('/list-of-organization','OrganizationAdviser\OrganizationController@index');
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
    Route::name('org-adviser.members.join')->get('/members/join', 'OrganizationAdviser\OrganizationGroupController@join');
    Route::name('org-adviser.event.show')->get('/show/{id?}', 'OrganizationAdviser\EventController@show');

    ####manage schedule route
    Route::name('org-adviser.manage-schedule')->get('/manage-schedule', 'OrganizationAdviser\EventController@manageSchedule');
    Route::name('org-adviser.calendar.within')->get('/calendar/within', 'OrganizationAdviser\CalendarController@calendarWithin');
    Route::name('org-adviser.calendar')->get('/calendar/{id?}', 'OrganizationAdviser\CalendarController@calendar');

    ####generate attendance route
    Route::name('org-adviser.generate-attendance')->get('/generate-attendance/menu', 'OrganizationAdviser\GenerateAttendanceController@generateAttendanceMenu');
    Route::name('org-adviser.generate-declined-attendance-org-list')->get('/generate/declined-attendance/org-list', 'OrganizationAdviser\GenerateAttendanceController@declinedAttendanceOrgList');
    Route::name('org-adviser.generate-declined-attendance-event-list')->get('/generate/declined-attendance/event-list/{id?}', 'OrganizationAdviser\GenerateAttendanceController@generateDeclinedAttendanceEventList');
    Route::name('org-adviser.declined-attendance-member-list')->get('/generate/declined-attendance/member-list/{id}/{eid}', 'OrganizationAdviser\GenerateAttendanceController@declinedAttendanceMemberList');
    Route::name('org-adviser.generate-confirmed-attendance-org-list')->get('/generate/confirmed-attendance/org-list', 'OrganizationAdviser\GenerateAttendanceController@confirmedAttendanceOrgList');
    Route::name('org-adviser.generate-confirmed-attendance-event-list')->get('/generate/confirmed-attendance/event-list/{id?}', 'OrganizationAdviser\GenerateAttendanceController@generateConfirmedAttendanceEventList');
    Route::name('org-adviser.confirmed-attendance-member-list')->get('/generate/confirmed-attendance/member-list/{id}/{eid}', 'OrganizationAdviser\GenerateAttendanceController@confirmedAttendanceMemberList');
    Route::name('org-adviser.attendance-org-list')->get('/attendance/org-list', 'OrganizationAdviser\GenerateAttendanceController@index');
    Route::name('org-adviser.attendance.show')->get('/new/{id}/{eid}', 'OrganizationAdviser\GenerateAttendanceController@show');
    Route::name('org-adviser.attendance.store')->post('/store', 'OrganizationAdviser\GenerateAttendanceController@store');
    Route::name('org-adviser.userattendance.store')->post('user-attendance/store', 'OrganizationAdviser\UserAttendanceController@store');
    Route::name('org-adviser.official-attendance-org-list')->get('/generate/official-attendance/org-list', 'OrganizationAdviser\GenerateAttendanceController@officialAttendanceOrgList');
    Route::name('org-adviser.generate-official-attendance-event-list')->get('/generate/official-attendance/event-list/{id?}', 'OrganizationAdviser\GenerateAttendanceController@generateOfficialAttendanceEventList');
    Route::name('org-adviser.official-attendance-member-list')->get('/generate/official-attendance/member-list/{id}/{eid}', 'OrganizationAdviser\GenerateAttendanceController@officialAttendanceMemberList');
    ####manage notification route
    Route::name('org-adviser.manage-notification-menu')->get('/manage-notification-menu', 'OrganizationAdviser\EventController@manageNotificationMenu');
    Route::name('org-adviser.manage-notification')->get('/manage-notification', 'OrganizationAdviser\EventController@manageNotification');
    Route::name('org-adviser.update-notification')->post('/update-notification', 'OrganizationAdviser\EventController@updateNotification');
  });

  # Route for organization co-adviser
  Route::prefix('org-co-adviser')->group(function() {
    Route::name('org-co-adviser.org-list')->get('/list-of-organization','OrganizationCoAdviser\OrganizationController@index');
    Route::name('org-co-adviser.event.list')->get('/get/event-list/{id?}', 'OrganizationCoAdviser\EventController@index');
    Route::name('org-co-adviser.org-profile')->get('/profile/{id}', 'OrganizationCoAdviser\OrganizationController@show');
    Route::name('org-co-adviser.org-logo')->post('/change-logo', 'OrganizationCoAdviser\OrganizationController@uploadLogo');
    Route::name('org-co-adviser.org-membership')->post('/org-membership', 'OrganizationCoAdviser\OrganizationGroupController@store');
    Route::name('org-co-adviser.my.new.event')->get('/my/new/event', 'OrganizationCoAdviser\MyEventController@create');
    Route::name('org-co-adviser.my.new.event.submit')->post('/store/new', 'OrganizationCoAdviser\MyEventController@store');
    Route::name('org-co-adviser.event.new')->get('/new', 'OrganizationCoAdviser\EventController@create');
    Route::name('org-co-adviser.event.new')->post('/new', 'OrganizationCoAdviser\EventController@store');
    Route::name('org-co-adviser.approve.event')->get('/approve/event', 'OrganizationCoAdviser\EventController@approveEvents');
    Route::name('org-co-adviser.approved.event')->get('/approved/event/{id}', 'OrganizationCoAdviser\EventController@setApprove');
    Route::name('org-co-adviser.disapproved.event')->get('/disapproved/event/{id}', 'OrganizationCoAdviser\EventController@setDisApprove');
    Route::name('org-co-adviser.org-edit')->get('/edit-org/{id}', 'OrganizationCoAdviser\OrganizationController@edit');
    Route::name('org-co-adviser.org-update')->post('/update-org', 'OrganizationCoAdviser\OrganizationController@update');
    Route::name('org-co-adviser.members.list')->get('/members/list', 'OrganizationCoAdviser\OrganizationGroupController@index');
    Route::name('org-co-adviser.members.join')->get('/members/join', 'OrganizationCoAdviser\OrganizationGroupController@join');
    Route::name('org-co-adviser.event.show')->get('/show/{id?}', 'OrganizationCoAdviser\EventController@show');
    Route::name('org-co-adviser.attendance')->get('/attendance', 'OrganizationCoAdviser\GenerateAttendanceController@index');
    Route::name('org-co-adviser.attendance.show')->get('/new/{id}/{eid}', 'OrganizationCoAdviser\GenerateAttendanceController@show');
    Route::name('org-co-adviser.attendance.store')->post('/store', 'OrganizationCoAdviser\GenerateAttendanceController@store');
    Route::name('org-co-adviser.userattendance.store')->post('user-attendance/store', 'OrganizationCoAdviser\UserAttendanceController@store');
    Route::name('org-co-adviser.calendar.within')->get('/calendar/within', 'OrganizationCoAdviser\CalendarController@calendarWithin');
    Route::name('org-co-adviser.calendar')->get('/calendar/{id?}', 'OrganizationCoAdviser\CalendarController@calendar');
    Route::name('org-co-adviser.manage-schedule')->get('/manage-schedule', 'OrganizationCoAdviser\EventController@manageSchedule');
    Route::name('org-co-adviser.manage-notification-menu')->get('/manage-notification-menu', 'OrganizationCoAdviser\EventController@manageNotificationMenu');
    Route::name('org-co-adviser.manage-notification')->get('/manage-notification', 'OrganizationCoAdviser\EventController@manageNotification');
    Route::name('org-co-adviser.update-notification')->post('/update-notification', 'OrganizationCoAdviser\EventController@updateNotification');

    ####generate attendance route
    Route::name('org-co-adviser.generate-attendance')->get('/generate-attendance/menu', 'OrganizationCoAdviser\GenerateAttendanceController@generateAttendanceMenu');
    #route for generate declined attendance
    Route::name('org-co-adviser.generate-declined-attendance-org-list')->get('/generate/declined-attendance/org-list', 'OrganizationCoAdviser\GenerateAttendanceController@declinedAttendanceOrgList');
    Route::name('org-co-adviser.generate-declined-attendance-event-list')->get('/generate/declined-attendance/event-list/{id?}', 'OrganizationCoAdviser\GenerateAttendanceController@generateDeclinedAttendanceEventList');
    Route::name('org-co-adviser.declined-attendance-member-list')->get('/generate/declined-attendance/member-list/{id}/{eid}', 'OrganizationCoAdviser\GenerateAttendanceController@declinedAttendanceMemberList');
    #route for generate confirmed attendance
    Route::name('org-co-adviser.generate-confirmed-attendance-org-list')->get('/generate/confirmed-attendance/org-list', 'OrganizationCoAdviser\GenerateAttendanceController@confirmedAttendanceOrgList');
    Route::name('org-co-adviser.generate-confirmed-attendance-event-list')->get('/generate/confirmed-attendance/event-list/{id?}', 'OrganizationCoAdviser\GenerateAttendanceController@generateConfirmedAttendanceEventList');
    Route::name('org-co-adviser.confirmed-attendance-member-list')->get('/generate/confirmed-attendance/member-list/{id}/{eid}', 'OrganizationCoAdviser\GenerateAttendanceController@confirmedAttendanceMemberList');
    #route for confirm and view org members' event expected attendance
    Route::name('org-co-adviser.attendance-org-list')->get('/attendance/org-list', 'OrganizationCoAdviser\GenerateAttendanceController@index');
    Route::name('org-co-adviser.attendance.show')->get('/new/{id}/{eid}', 'OrganizationCoAdviser\GenerateAttendanceController@show');
    Route::name('org-co-adviser.attendance.store')->post('/store', 'OrganizationCoAdviser\GenerateAttendanceController@store');
    Route::name('org-co-adviser.attendance.store2')->post('/store2', 'OrganizationCoAdviser\GenerateAttendanceController@store2');
    Route::name('org-co-adviser.userattendance.store')->post('user-attendance/store', 'OrganizationCoAdviser\UserAttendanceController@store');
    #route for generate attended attendance
    Route::name('org-co-adviser.official-attendance-org-list')->get('/generate/official-attendance/org-list', 'OrganizationCoAdviser\GenerateAttendanceController@officialAttendanceOrgList');
    Route::name('org-co-adviser.generate-official-attendance-event-list')->get('/generate/official-attendance/event-list/{id?}', 'OrganizationCoAdviser\GenerateAttendanceController@generateOfficialAttendanceEventList');
    Route::name('org-co-adviser.official-attendance-member-list')->get('/generate/official-attendance/member-list/{id}/{eid}', 'OrganizationCoAdviser\GenerateAttendanceController@officialAttendanceMemberList');

  });

  # Route for organization head
  Route::prefix('org-head')->group(function() {
    Route::name('org-head.org-list')->get('/list_of_organizations','OrganizationHead\OrganizationController@index');
    Route::name('org-head.org-profile')->get('/profile/{id}', 'OrganizationHead\OrganizationController@show');
    Route::name('org-head.org-logo')->post('/change-logo', 'OrganizationHead\OrganizationController@uploadLogo');
    Route::name('org-head.org-edit')->get('/edit-org/{id}', 'OrganizationHead\OrganizationController@edit');
    Route::name('org-head.org-update')->post('/update-org', 'OrganizationHead\OrganizationController@update');
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

    ####manage schedule route
    Route::name('org-head.manage-schedule')->get('/manage-schedule', 'OrganizationHead\EventController@manageSchedule');
    Route::name('org-head.calendar.within')->get('/calendar/within', 'OrganizationHead\CalendarController@calendarWithin');
    Route::name('org-head.calendar')->get('/calendar/{id?}', 'OrganizationHead\CalendarController@calendar');
    #create within organization event route
    Route::name('org-head.event.new')->get('/new-event', 'OrganizationHead\EventController@create');
    Route::name('org-head.event.new')->post('/new-event', 'OrganizationHead\EventController@store');

    ####generate attendance route
    Route::name('org-head.generate-attendance')->get('/generate-attendance/menu', 'OrganizationHead\GenerateAttendanceController@generateAttendanceMenu');
    #route for generate declined attendance
    Route::name('org-head.generate-declined-attendance-org-list')->get('/generate/declined-attendance/org-list', 'OrganizationHead\GenerateAttendanceController@declinedAttendanceOrgList');
    Route::name('org-head.generate-declined-attendance-event-list')->get('/generate/declined-attendance/event-list/{id?}', 'OrganizationHead\GenerateAttendanceController@generateDeclinedAttendanceEventList');
    Route::name('org-head.declined-attendance-member-list')->get('/generate/declined-attendance/member-list/{id}/{eid}', 'OrganizationHead\GenerateAttendanceController@declinedAttendanceMemberList');
    #route for generate confirmed attendance
    Route::name('org-head.generate-confirmed-attendance-org-list')->get('/generate/confirmed-attendance/org-list', 'OrganizationHead\GenerateAttendanceController@confirmedAttendanceOrgList');
    Route::name('org-head.generate-confirmed-attendance-event-list')->get('/generate/confirmed-attendance/event-list/{id?}', 'OrganizationHead\GenerateAttendanceController@generateConfirmedAttendanceEventList');
    Route::name('org-head.confirmed-attendance-member-list')->get('/generate/confirmed-attendance/member-list/{id}/{eid}', 'OrganizationHead\GenerateAttendanceController@confirmedAttendanceMemberList');
    #route for confirm and view org members' event expected attendance
    Route::name('org-head.attendance-org-list')->get('/attendance/org-list', 'OrganizationHead\GenerateAttendanceController@index');
    Route::name('org-head.attendance.show')->get('/new/{id}/{eid}', 'OrganizationHead\GenerateAttendanceController@show');
    Route::name('org-head.attendance.store')->post('/store', 'OrganizationHead\GenerateAttendanceController@store');
    Route::name('org-head.attendance.store2')->post('/store2', 'OrganizationHead\GenerateAttendanceController@store2');
    Route::name('org-head.userattendance.store')->post('user-attendance/store', 'OrganizationHead\UserAttendanceController@store');
    #route for generate attended attendance
    Route::name('org-head.official-attendance-org-list')->get('/generate/official-attendance/org-list', 'OrganizationHead\GenerateAttendanceController@officialAttendanceOrgList');
    Route::name('org-head.generate-official-attendance-event-list')->get('/generate/official-attendance/event-list/{id?}', 'OrganizationHead\GenerateAttendanceController@generateOfficialAttendanceEventList');
    Route::name('org-head.official-attendance-member-list')->get('/generate/official-attendance/member-list/{id}/{eid}', 'OrganizationHead\GenerateAttendanceController@officialAttendanceMemberList');
    ####manage notification route
    Route::name('org-head.manage-notification-menu')->get('/manage-notification-menu', 'OrganizationHead\EventController@manageNotificationMenu');
    Route::name('org-head.manage-notification')->get('/manage-notification', 'OrganizationHead\EventController@manageNotification');
    Route::name('org-head.update-notification')->post('/update-notification', 'OrganizationHead\EventController@updateNotification');

  });

  # Route for organization member
  Route::prefix('org-member')->group(function() {
    Route::name('org-member.org-list')->get('/list-of-organization','OrganizationMember\OrganizationController@index');
    Route::name('org-member.event.list')->get('/get/event-list/{id?}', 'OrganizationMember\EventController@index');
    Route::name('org-member.org-profile')->get('/profile/{id}', 'OrganizationMember\OrganizationController@show');
    Route::name('org-member.org-logo')->post('/change-logo', 'OrganizationMember\OrganizationController@uploadLogo');
    Route::name('org-member.org-membership')->post('/org-membership', 'OrganizationMember\OrganizationGroupController@store');
    Route::name('org-member.my.new.event')->get('/my/new/event', 'OrganizationMember\MyEventController@create');
    Route::name('org-member.my.new.event.submit')->post('/store/new', 'OrganizationMember\MyEventController@store');
    Route::name('org-member.event.new')->get('/new', 'OrganizationMember\EventController@create');
    Route::name('org-member.event.new')->post('/new', 'OrganizationMember\EventController@store');
    Route::name('org-member.approve.event')->get('/approve/event', 'OrganizationMember\EventController@approveEvents');
    Route::name('org-member.approved.event')->get('/approved/event/{id}', 'OrganizationMember\EventController@setApprove');
    Route::name('org-member.disapproved.event')->get('/disapproved/event/{id}', 'OrganizationMember\EventController@setDisApprove');
    Route::name('org-member.org-edit')->get('/edit-org/{id}', 'OrganizationMember\OrganizationController@edit');
    Route::name('org-member.org-update')->post('/update-org', 'OrganizationMember\OrganizationController@update');
    Route::name('org-member.members.list')->get('/members/list', 'OrganizationMember\OrganizationGroupController@index');
    Route::name('org-member.members.join')->get('/members/join', 'OrganizationMember\OrganizationGroupController@join');
    Route::name('org-member.event.show')->get('/show/{id?}', 'OrganizationMember\EventController@show');
    Route::name('org-member.attendance')->get('/attendance', 'OrganizationMember\GenerateAttendanceController@index');
    Route::name('org-member.attendance.show')->get('/new/{id}/{eid}', 'OrganizationMember\GenerateAttendanceController@show');
    Route::name('org-member.attendance.store')->post('/store', 'OrganizationMember\GenerateAttendanceController@store');
    Route::name('org-member.userattendance.store')->post('user-attendance/store', 'OrganizationMember\UserAttendanceController@store');
    Route::name('org-member.calendar.within')->get('/calendar/within', 'OrganizationMember\CalendarController@calendarWithin');
    Route::name('org-member.calendar')->get('/calendar/{id?}', 'OrganizationMember\CalendarController@calendar');
    Route::name('org-member.manage-schedule')->get('/manage-schedule', 'OrganizationMember\EventController@manageSchedule');
    Route::name('org-member.manage-notification-menu')->get('/manage-notification-menu', 'OrganizationMember\EventController@manageNotificationMenu');
    Route::name('org-member.manage-notification')->get('/manage-notification', 'OrganizationMember\EventController@manageNotification');
    Route::name('org-member.update-notification')->post('/update-notification', 'OrganizationMember\EventController@updateNotification');

    ####generate attendance route
    Route::name('org-member.generate-attendance')->get('/generate-attendance/menu', 'OrganizationMember\GenerateAttendanceController@generateAttendanceMenu');
    #route for generate declined attendance
    Route::name('org-member.generate-declined-attendance-org-list')->get('/generate/declined-attendance/org-list', 'OrganizationMember\GenerateAttendanceController@declinedAttendanceOrgList');
    Route::name('org-member.generate-declined-attendance-event-list')->get('/generate/declined-attendance/event-list/{id?}', 'OrganizationMember\GenerateAttendanceController@generateDeclinedAttendanceEventList');
    Route::name('org-member.declined-attendance-member-list')->get('/generate/declined-attendance/member-list/{id}/{eid}', 'OrganizationMember\GenerateAttendanceController@declinedAttendanceMemberList');
    #route for generate confirmed attendance
    Route::name('org-member.generate-confirmed-attendance-org-list')->get('/generate/confirmed-attendance/org-list', 'OrganizationMember\GenerateAttendanceController@confirmedAttendanceOrgList');
    Route::name('org-member.generate-confirmed-attendance-event-list')->get('/generate/confirmed-attendance/event-list/{id?}', 'OrganizationMember\GenerateAttendanceController@generateConfirmedAttendanceEventList');
    Route::name('org-member.confirmed-attendance-member-list')->get('/generate/confirmed-attendance/member-list/{id}/{eid}', 'OrganizationMember\GenerateAttendanceController@confirmedAttendanceMemberList');
    #route for confirm and view org members' event expected attendance
    Route::name('org-member.attendance-org-list')->get('/attendance/org-list', 'OrganizationMember\GenerateAttendanceController@index');
    Route::name('org-member.attendance.show')->get('/new/{id}/{eid}', 'OrganizationMember\GenerateAttendanceController@show');
    Route::name('org-member.attendance.store')->post('/store', 'OrganizationMember\GenerateAttendanceController@store');
    Route::name('org-member.attendance.store2')->post('/store2', 'OrganizationMember\GenerateAttendanceController@store2');
    Route::name('org-member.userattendance.store')->post('user-attendance/store', 'OrganizationMember\UserAttendanceController@store');
    #route for generate attended attendance
    Route::name('org-member.official-attendance-org-list')->get('/generate/official-attendance/org-list', 'OrganizationMember\GenerateAttendanceController@officialAttendanceOrgList');
    Route::name('org-member.generate-official-attendance-event-list')->get('/generate/official-attendance/event-list/{id?}', 'OrganizationMember\GenerateAttendanceController@generateOfficialAttendanceEventList');
    Route::name('org-member.official-attendance-member-list')->get('/generate/official-attendance/member-list/{id}/{eid}', 'OrganizationMember\GenerateAttendanceController@officialAttendanceMemberList');

  });

  # Route for organization adviser
  Route::prefix('osa-personnel')->group(function() {
    Route::name('osa-personnel.set-approver')->get('/set-approver', 'OsaPersonnel\UserController@getUser');
    Route::name('osa-personnel.org-list')->get('/list_of_organizations','OsaPersonnel\OrganizationController@index');
    Route::name('osa-personnel.org-add')->get('/new/organizations','OsaPersonnel\OrganizationController@create');
    Route::name('osa-personnel.org-store')->post('/store/organizations','OsaPersonnel\OrganizationController@store');
    Route::name('osa-personnel.org-profile')->get('/profile/{id}', 'OsaPersonnel\OrganizationController@show');
    Route::name('osa-personnel.org-logo')->post('/change-logo', 'OsaPersonnel\OrganizationController@uploadLogo');
    Route::name('osa-personnel.org-edit')->get('/edit-org/{id}', 'OsaPersonnel\OrganizationController@edit');
    Route::name('osa-personnel.org-update')->post('/update-org', 'OsaPersonnel\OrganizationController@update');
    Route::name('osa-personnel.event.list')->get('/get/event-list/{id?}', 'OsaPersonnel\EventController@index');
    Route::name('osa-personnel.my.new.event')->get('/my/new/event', 'OsaPersonnel\MyEventController@create');
    Route::name('osa-personnel.my.new.event.submit')->post('/store/new', 'OsaPersonnel\MyEventController@store');
    Route::name('osa-personnel.approve.event')->get('/approve/event', 'OsaPersonnel\EventController@approveEvents');
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

    # Check og gigamit pani nga part
    Route::name('osa-personnel.assign-approver')->get('/assign/approver', 'OsaPersonnel\UserController@assignApprover');

    ####manage schedule route
    Route::name('osa-personnel.manage-schedule')->get('/manage-schedule', 'OsaPersonnel\EventController@manageSchedule');
    Route::name('osa-personnel.calendar.within')->get('/calendar/within', 'OsaPersonnel\CalendarController@calendarWithin');
    Route::name('osa-personnel.calendar')->get('/calendar/{id?}', 'OsaPersonnel\CalendarController@calendar');
    #create within organization event route
    Route::name('osa-personnel.event.new')->get('/new-event', 'OsaPersonnel\EventController@create');
    Route::name('osa-personnel.event.new')->post('/new-event', 'OsaPersonnel\EventController@store');

    ####generate attendance route
    Route::name('osa-personnel.generate-attendance')->get('/generate-attendance/menu', 'OsaPersonnel\GenerateAttendanceController@generateAttendanceMenu');
    #route for generate declined attendance
    Route::name('osa-personnel.generate-declined-attendance-org-list')->get('/generate/declined-attendance/org-list', 'OsaPersonnel\GenerateAttendanceController@declinedAttendanceOrgList');
    Route::name('osa-personnel.generate-declined-attendance-event-list')->get('/generate/declined-attendance/event-list/{id?}', 'OsaPersonnel\GenerateAttendanceController@generateDeclinedAttendanceEventList');
    Route::name('osa-personnel.declined-attendance-member-list')->get('/generate/declined-attendance/member-list/{id}/{eid}', 'OsaPersonnel\GenerateAttendanceController@declinedAttendanceMemberList');
    #route for generate confirmed attendance
    Route::name('osa-personnel.generate-confirmed-attendance-org-list')->get('/generate/confirmed-attendance/org-list', 'OsaPersonnel\GenerateAttendanceController@confirmedAttendanceOrgList');
    Route::name('osa-personnel.generate-confirmed-attendance-event-list')->get('/generate/confirmed-attendance/event-list/{id?}', 'OsaPersonnel\GenerateAttendanceController@generateConfirmedAttendanceEventList');
    Route::name('osa-personnel.confirmed-attendance-member-list')->get('/generate/confirmed-attendance/member-list/{id}/{eid}', 'OsaPersonnel\GenerateAttendanceController@confirmedAttendanceMemberList');
    #route for confirm and view org members' event expected attendance
    Route::name('osa-personnel.attendance-org-list')->get('/attendance/org-list', 'OsaPersonnel\GenerateAttendanceController@index');
    Route::name('osa-personnel.attendance.show')->get('/new/{id}/{eid}', 'OsaPersonnel\GenerateAttendanceController@show');
    Route::name('osa-personnel.attendance.store')->post('/store', 'OsaPersonnel\GenerateAttendanceController@store');
    Route::name('osa-personnel.attendance.store2')->post('/store2', 'OsaPersonnel\GenerateAttendanceController@store2');
    Route::name('osa-personnel.userattendance.store')->post('user-attendance/store', 'OsaPersonnel\UserAttendanceController@store');
    #route for generate attended attendance
    Route::name('osa-personnel.official-attendance-org-list')->get('/generate/official-attendance/org-list', 'OsaPersonnel\GenerateAttendanceController@officialAttendanceOrgList');
    Route::name('osa-personnel.generate-official-attendance-event-list')->get('/generate/official-attendance/event-list/{id?}', 'OsaPersonnel\GenerateAttendanceController@generateOfficialAttendanceEventList');
    Route::name('osa-personnel.official-attendance-member-list')->get('/generate/official-attendance/member-list/{id}/{eid}', 'OsaPersonnel\GenerateAttendanceController@officialAttendanceMemberList');
    ####manage notification route
    Route::name('osa-personnel.manage-notification-menu')->get('/manage-notification-menu', 'OsaPersonnel\EventController@manageNotificationMenu');
    Route::name('osa-personnel.manage-notification')->get('/manage-notification', 'OsaPersonnel\EventController@manageNotification');
    Route::name('osa-personnel.update-notification')->post('/update-notification', 'OsaPersonnel\EventController@updateNotification');
    ###manage org members / user routes
    Route::name('osa-personnel.approverstate.update')->post('approver/update', 'OsaPersonnel\UserController@setApprover');
  });

  Route::prefix('user-admin')->group(function() {
    Route::name('user-admin.set-approver')->get('/set-approver', 'UserAdmin\UserController@getUser');
    Route::name('user-admin.org-list')->get('/list_of_organizations','UserAdmin\OrganizationController@index');
    Route::name('user-admin.org-add')->get('/new/organizations','UserAdmin\OrganizationController@create');
    Route::name('user-admin.org-profile')->get('/profile/{id}', 'UserAdmin\OrganizationController@show');
    Route::name('user-admin.org-logo')->post('/change-logo', 'UserAdmin\OrganizationController@uploadLogo');
    Route::name('user-admin.org-edit')->get('/edit-org/{id}', 'UserAdmin\OrganizationController@edit');
    Route::name('user-admin.org-update')->post('/update-org', 'UserAdmin\OrganizationController@update');
    Route::name('user-admin.event.list')->get('/get/event-list/{id?}', 'UserAdmin\EventController@index');
    Route::name('user-admin.my.new.event')->get('/my/new/event', 'UserAdmin\MyEventController@create');
    Route::name('user-admin.my.new.event.submit')->post('/store/new', 'UserAdmin\MyEventController@store');
    Route::name('user-admin.approve.event')->get('/approve/event', 'UserAdmin\EventController@approveEvents');
    Route::name('user-admin.attendance')->get('/attendance', 'UserAdmin\GenerateAttendanceController@index');
    Route::name('user-admin.event.show')->get('/show/{id?}', 'UserAdmin\EventController@show');
    Route::name('user-admin.attendance.store')->post('/store', 'UserAdmin\GenerateAttendanceController@store');
    Route::name('user-admin.attendance.show')->get('/new/{id}/{eid}', 'UserAdmin\GenerateAttendanceController@show');
    Route::name('user-admin.my.new.event')->get('/my/new/event', 'UserAdmin\MyEventController@create');
    Route::name('user-admin.my.new.event.submit')->post('/store/new', 'UserAdmin\MyEventController@store');
    Route::name('user-admin.approved.event')->get('/approved/event/{id}', 'UserAdmin\EventController@setApprove');
    Route::name('user-admin.disapproved.event')->get('/disapproved/event/{id}', 'UserAdmin\EventController@setDisApprove');
    Route::name('user-admin.userattendance.store')->post('user-attendance/store', 'UserAdmin\UserAttendanceController@store');
    Route::name('user-admin.org-membership')->post('/org-membership', 'UserAdmin\OrganizationGroupController@store');
    Route::name('user-admin.members.list')->get('/members/list', 'UserAdmin\OrganizationGroupController@index');
    Route::name('user-admin.members.add')->get('/members/add', 'UserAdmin\OrganizationGroupController@create');
    Route::name('user-admin.members.search')->post('/members/search', 'UserAdmin\UserController@search');
    Route::name('user-admin.members.new')->post('/members/new', 'UserAdmin\OrganizationGroupController@storeNewMember');
    Route::name('user-admin.accept-users')->get('/members/accept', 'UserAdmin\OrganizationGroupController@acceptNewMember');
    Route::name('user-admin.account-status.update')->post('/members/activation', 'UserAdmin\UserController@setAccountStatus');

    # Check og gigamit pani nga part
    Route::name('user-admin.assign-approver')->get('/assign/approver', 'UserAdmin\UserController@assignApprover');

    ####manage schedule route
    Route::name('user-admin.manage-schedule')->get('/manage-schedule', 'UserAdmin\EventController@manageSchedule');
    Route::name('user-admin.calendar.within')->get('/calendar/within', 'UserAdmin\CalendarController@calendarWithin');
    Route::name('user-admin.calendar')->get('/calendar/{id?}', 'UserAdmin\CalendarController@calendar');
    #create within organization event route
    Route::name('user-admin.event.new')->get('/new-event', 'UserAdmin\EventController@create');
    Route::name('user-admin.event.new')->post('/new-event', 'UserAdmin\EventController@store');

    ####generate attendance route
    Route::name('user-admin.generate-attendance')->get('/generate-attendance/menu', 'UserAdmin\GenerateAttendanceController@generateAttendanceMenu');
    #route for generate declined attendance
    Route::name('user-admin.generate-declined-attendance-org-list')->get('/generate/declined-attendance/org-list', 'UserAdmin\GenerateAttendanceController@declinedAttendanceOrgList');
    Route::name('user-admin.generate-declined-attendance-event-list')->get('/generate/declined-attendance/event-list/{id?}', 'UserAdmin\GenerateAttendanceController@generateDeclinedAttendanceEventList');
    Route::name('user-admin.declined-attendance-member-list')->get('/generate/declined-attendance/member-list/{id}/{eid}', 'UserAdmin\GenerateAttendanceController@declinedAttendanceMemberList');
    #route for generate confirmed attendance
    Route::name('user-admin.generate-confirmed-attendance-org-list')->get('/generate/confirmed-attendance/org-list', 'UserAdmin\GenerateAttendanceController@confirmedAttendanceOrgList');
    Route::name('user-admin.generate-confirmed-attendance-event-list')->get('/generate/confirmed-attendance/event-list/{id?}', 'UserAdmin\GenerateAttendanceController@generateConfirmedAttendanceEventList');
    Route::name('user-admin.confirmed-attendance-member-list')->get('/generate/confirmed-attendance/member-list/{id}/{eid}', 'UserAdmin\GenerateAttendanceController@confirmedAttendanceMemberList');
    #route for confirm and view org members' event expected attendance
    Route::name('user-admin.attendance-org-list')->get('/attendance/org-list', 'UserAdmin\GenerateAttendanceController@index');
    Route::name('user-admin.attendance.show')->get('/new/{id}/{eid}', 'UserAdmin\GenerateAttendanceController@show');
    Route::name('user-admin.attendance.store')->post('/store', 'UserAdmin\GenerateAttendanceController@store');
    Route::name('user-admin.attendance.store2')->post('/store2', 'UserAdmin\GenerateAttendanceController@store2');
    Route::name('user-admin.userattendance.store')->post('user-attendance/store', 'UserAdmin\UserAttendanceController@store');
    #route for generate attended attendance
    Route::name('user-admin.official-attendance-org-list')->get('/generate/official-attendance/org-list', 'UserAdmin\GenerateAttendanceController@officialAttendanceOrgList');
    Route::name('user-admin.generate-official-attendance-event-list')->get('/generate/official-attendance/event-list/{id?}', 'UserAdmin\GenerateAttendanceController@generateOfficialAttendanceEventList');
    Route::name('user-admin.official-attendance-member-list')->get('/generate/official-attendance/member-list/{id}/{eid}', 'UserAdmin\GenerateAttendanceController@officialAttendanceMemberList');
    ####manage notification route
    Route::name('user-admin.manage-notification-menu')->get('/manage-notification-menu', 'UserAdmin\EventController@manageNotificationMenu');
    Route::name('user-admin.manage-notification')->get('/manage-notification', 'UserAdmin\EventController@manageNotification');
    Route::name('user-admin.update-notification')->post('/update-notification', 'UserAdmin\EventController@updateNotification');
    ###manage org members / user routes
    Route::name('user-admin.approverstate.update')->post('approver/update', 'UserAdmin\UserController@setApprover');

  }); 

  Route::name('event-within-organization')->get('/all-events/organization/{id}', 'WithinOrganizationEventsController@show');

});
