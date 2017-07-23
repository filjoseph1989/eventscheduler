<?php
Route::prefix('admin')->group(function() {
  # Users
  Route::name('admin.user.list')->get('/users/list', 'AdminController@showAllUserList');
  Route::name('admin.user.add')->get('/users/add', 'AdminUserController@showUserAddForm');
  Route::name('admin.user.set.status')->post('/users/set/status', 'AdminUserController@setStatus');
  Route::name('admin.user.register')->post('/user/register', 'UserController@adminCreate');
  Route::name('admin.user.edit')->post('/user/edit', 'UserController@edit');
  Route::name('admin.user.get')->post('/user/get', 'UserController@getUserData');
  Route::name('admin.user.gets')->get('/user/gets', 'UserController@gets');
  Route::name('admin.user.delete')->post('/user/delete', 'UserController@delete');

  # User Accounts
  Route::name('admin.user.account.list')->get('/user-account/list', 'AdminController@showAllUserAccountList');
  Route::name('admin.user.account.add')->get('/user-account/add', 'UserAccountController@showUserAccountAddForm');
  Route::name('admin.user-account.register')->post('/user-account/register', 'UserAccountController@useAccountCreate');
  Route::name('admin.user-account.edit')->post('/user-account/edit', 'UserAccountController@edit');
  Route::name('admin.user-account.delete')->post('/user-account/delete', 'UserAccountController@delete');

  # Course
  Route::name('admin.course.list')->get('/course/list', 'AdminController@showAllCourseList');
  Route::name('admin.course.add')->get('/course/add', 'CourseController@showCourseAddForm');
  Route::name('admin.course.register')->post('/course/register', 'CourseController@courseCreate');
  Route::name('admin.course.edit')->post('/course/edit', 'CourseController@edit');
  Route::name('admin.course.delete')->post('/course/delete', 'CourseController@delete');

  # Department
  Route::name('admin.department.list')->get('/department/list', 'AdminController@showAllDepartmentList');
  Route::name('admin.department.add')->get('/department/add', 'DepartmentController@showDepartmentAddForm');
  Route::name('admin.department.register')->post('/department/register', 'DepartmentController@adminCreate');
  Route::name('admin.department.edit')->post('/department/edit', 'DepartmentController@edit');
  Route::name('admin.department.delete')->post('/department/delete', 'DepartmentController@delete');

  # Position
  Route::name('admin.position.list')->get('/position/list', 'AdminController@showAllPositionList');
  Route::name('admin.position.add')->get('/position/add', 'PositionController@showPositionAddForm');
  Route::name('admin.position.register')->post('/position/register', 'PositionController@positionCreate');
  Route::name('admin.position.edit')->post('/position/edit', 'PositionController@edit');
  Route::name('admin.position.delete')->post('/position/delete', 'PositionController@delete');

  # Organization
  Route::name('admin.organization.list')->get('/organization/list', 'AdminController@showAllOrganizationList');
  Route::name('admin.organization.add')->get('/organization/add', 'OrganizationController@showOrganizationAddForm');
  Route::name('admin.organization.register')->post('/organization/register', 'OrganizationController@adminCreate');
  Route::name('admin.organization.edit')->post('/organization/edit', 'OrganizationController@edit');
  Route::name('admin.organization.delete')->post('/organization/delete', 'OrganizationController@delete');

  #event-category
  Route::name('admin.event-category.list')->get('/event-category/list', 'AdminController@showAllEvenCategoriesList');
  Route::name('admin.event-category.register')->post('/event-category/register', 'EventCategoryController@adminCreate');
  Route::name('admin.event-category.edit')->post('/event-category/edit', 'EventCategoryController@edit');
  Route::name('admin.event-category.delete')->post('/event-category/delete', 'EventCategoryController@delete');

  #event-type
  Route::name('admin.event-type.list')->get('/event-type/list', 'AdminController@showAllEventTypeList');
  Route::name('admin.event-type.register')->post('/event-type/register', 'EventTypeController@adminCreate');
  Route::name('admin.event-type.edit')->post('/event-type/edit', 'EventTypeController@edit');
  Route::name('admin.event-type.delete')->post('/event-type/delete', 'EventTypeController@delete');

  #approvers
  Route::name('admin.approvers.list')->get('/approvers/list', 'AdminController@showAllApprovers');

  # Authentication
  Route::name('admin.login')->get('/admin-login', 'Auth\AdminLoginController@showLoginForm');
  Route::name('admin.login.submit')->post('/login', 'Auth\AdminLoginController@login');
  Route::name('admin.logout')->get('/logout', 'Auth\AdminLoginController@adminLogout');

  # Password reset for admin
  Route::name('admin.password.request')->get('/forgot/password', 'Auth\AdminForgotPasswordController@showAdminLinkRequestForm');
  Route::name('admin.password.email')->post('/forgot/password/link', 'Auth\AdminForgotPasswordController@sendResetLinkEmail');
  Route::name('admin.password.reset')->get('/forgot/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm');
  Route::name('admin.password.set')->post('/forgot/password/reset', 'Auth\AdminResetPasswordController@reset');

  # Dashboard
  Route::name('admin.dashboard')->get('/', 'AdminController@index');
});