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
/*
|--------------------------------------------------------------------------
| Admin route
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function() {
  Route::name('admin.login')->get('/admin-login', 'Auth\AdminLoginController@showLoginForm');
  Route::name('admin.users.list')->get('/users/list', 'AdminController@showAll');
  Route::name('admin.user.account.list')->get('/users/account/list', 'UsersAccountAdminController@showAll');
  Route::name('admin.user.register')->get('/register', 'AdminController@showRegisterForm');
  Route::name('admin.course.list')->get('/course/list', 'CourseController@showAll');

  Route::name('admin.department.list')->get('/department/list', 'DepartmentController@showAll');
  Route::name('admin.position.list')->get('/position/list', 'PositionController@showAll');
  Route::name('admin.organization.list')->get('/organization/list', 'AdminController@showAllOrganization');
  Route::name('admin.event.categories.list')->get('/event/categories/list', 'EventCategoriesController@showAll');
  Route::name('admin.event.types.list')->get('/event/types/list', 'EventCategoriesController@showAll');

  Route::name('admin.login.submit')->post('/login', 'Auth\AdminLoginController@login');
  Route::name('admin.dashboard')->get('/', 'AdminController@index');
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
    Route::name('user.register')->get('/register', 'UsersController@showRegisterForm');
});

Route::prefix('user-accounts')->group(function() {
    Route::name('user-account.register')->get('/register', 'UsersAccountAdminController@showRegisterForm');
});

Route::prefix('course')->group(function() {
    Route::name('course.register')->get('/register', 'CourseController@showRegisterForm');
});
