<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes();

Route::name('home')->get('/home', 'HomeController@index');
Route::name('user.logout')->get('users/logout', 'Auth\LoginController@userLogout');
/*
|--------------------------------------------------------------------------
| Admin route
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function() {
  Route::name('admin.login')->get('/admin-login', 'Auth\AdminLoginController@showLoginForm');
  Route::name('admin.users.list')->get('/users/list', 'AdminController@showAllUserList');
  Route::name('admin.user.account.list')->get('/users/account/list', 'AdminController@showAllUserAccountList');
  Route::name('admin.course.list')->get('/course/list', 'AdminController@showAllCourseList');
  Route::name('admin.user.register')->get('/register', 'AdminController@showRegisterForm');
  Route::name('admin.department.list')->get('/department/list', 'AdminController@showAllDepartmentList');
  Route::name('admin.position.list')->get('/position/list', 'AdminController@showAllPositionList');
  Route::name('admin.organization.list')->get('/organization/list', 'AdminController@showAllOrganizationList');
  Route::name('admin.event.categories.list')->get('/event/categories/list', 'AdminController@showAllEvenCategoriesList');
  Route::name('admin.event.types.list')->get('/event/types/list', 'AdminController@showAllEventTypes');
  Route::name('admin.approvers.list')->get('/approvers/list', 'AdminController@showAllApprovers');
  Route::name('admin.login.submit')->post('/login', 'Auth\AdminLoginController@login');
  Route::name('admin.dashboard')->get('/', 'AdminController@index');
  Route::name('admin.logout')->get('/logout', 'Auth\LoginController@adminLogout');
});
/*
|--------------------------------------------------------------------------
| Organization routes
|--------------------------------------------------------------------------
*/
Route::prefix('organization')->group(function() {
  Route::name('organization.list')->get('/list', 'OrganizationController@index');
  Route::name('organization.add')->get('/add', 'OrganizationController@create');
});
/*
|--------------------------------------------------------------------------
| Notification route
|--------------------------------------------------------------------------
*/
Route::name('notify.via.sms')->get('/notify_via_sms', 'smsNotifierController@index');
Route::name('faceboo.notification')->get('/fb/post', 'HomeController@sendNotification');
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function() {
    Route::name('user.registered')->post('/registered', 'UsersController@create');
});


# ignore me for a moment
Route::prefix('user-accounts')->group(function() {
    Route::name('user-account.register')->get('/register', 'UsersAccountAdminController@showRegisterForm');
    Route::name('user-account.registered')->post('/registered', 'UsersAccountAdminController@create');
});

Route::prefix('course')->group(function() {
    Route::name('course.register')->get('/register', 'CourseController@showRegisterForm');
    Route::name('course.registered')->post('/registered', 'CourseController@create');
});
