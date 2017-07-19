<?php
Route::name('user.logout')->post('/logout', 'Auth\LoginController@userLogout');

# User Crud
Route::name('user.list')->get('/users/list', 'UserController@showAllUserList');
Route::name('user.edit')->post('/user/edit', 'UserController@edit');
Route::name('user.delete')->post('/user/delete', 'UserController@delete');
Route::name('user.register')->post('/user/register', 'UserController@adminCreate');
Route::name('user.update.position')->post('/user/update/position', 'UserController@updatePosition');
Route::name('user.update.user_account')->post('/user/update/user_account', 'UserController@updateUserAccount');
Route::name('user.update.user_approver_status')->get('/user/update/user-approver-status/{user_id}', 'UserController@updateUserApproverStatus');
Route::name('user.get')->post('/user/get', 'UserController@gets');

# Course Crud
Route::name('course.list')->get('/course/list', 'CourseController@showAllCourseList');
Route::name('course.edit')->post('/course/edit', 'CourseController@edit');
Route::name('course.delete')->post('/course/delete', 'CourseController@delete');
Route::name('course.register')->post('/course/register', 'CourseController@courseCreate');

# Department Crud
Route::name('department.list')->get('/department/list', 'DepartmentController@showAllDepartmentList');
Route::name('department.edit')->post('/department/edit', 'DepartmentController@edit');
Route::name('department.delete')->post('/department/delete', 'DepartmentController@delete');
Route::name('department.register')->post('/department/register', 'DepartmentController@adminCreate');

# Position Crud
Route::name('position.list')->get('/position/list', 'PositionController@showAllPositionList');
Route::name('position.register')->post('/position/register', 'PositionController@positionCreate');
Route::name('position.edit')->post('/position/edit', 'PositionController@edit');
Route::name('position.delete')->post('/position/delete', 'PositionController@delete');
Route::name('position.get')->post('/position/get/positions', 'PositionController@getPositions');

# Organization Crud
Route::name('organization.list')->get('/organization/list', 'OrganizationController@showAllOrganizationList'); # Remove me soon
Route::name('organization.register')->post('/organization/register', 'OrganizationController@adminCreate'); # Remve me soon
Route::name('organization.edit')->post('/organization/edit', 'OrganizationController@edit'); # Remove me soon
Route::name('organization.delete')->post('/organization/delete', 'OrganizationController@delete');
Route::name('organization.add')->get('/organization/add', 'OrganizationController@showOrganizationAddForm');
Route::name('organization.get')->post('/organization/get', 'OrganizationController@getOrganization');
Route::name('organization.gets')->post('/organization/gets', 'OrganizationController@getOrganizationList');

# Manage Notifications
Route::name('notification.show')->get('/notification/show', 'ManageNotificationController@showNotificationPage'); //unpassed events data
Route::name('event.show')->get('notifications/events/show', 'ManageNotificationController@showEventList');
Route::name('event.notify')->post('/events/notify', 'ManageNotificationController@notify');
Route::name('email')->get('/email', 'MailController@index'); //test for email notif
