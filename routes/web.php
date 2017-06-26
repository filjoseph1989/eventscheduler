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
    # users
    Route::name('admin.user.list')->get('/users/list', 'AdminController@showAllUserList');
    Route::name('admin.user.account.list')->get('/users/account/list', 'AdminController@showAllUserAccountList');
    Route::name('admin.user.register')->get('/register', 'AdminController@showRegisterForm');
    Route::name('admin.user.organization.list')->get('/organization/list', 'AdminController@showAllOrganizationList');

    # Events
    Route::name('admin.event.categories.list')->get('/event/categories/list', 'AdminController@showAllEvenCategoriesList');
    Route::name('admin.event.types.list')->get('/event/types/list', 'AdminController@showAllEventTypes');

    # Others
    Route::name('admin.course.list')->get('/course/list', 'AdminController@showAllCourseList');
    Route::name('admin.department.list')->get('/department/list', 'AdminController@showAllDepartmentList');
    Route::name('admin.position.list')->get('/position/list', 'AdminController@showAllPositionList');
    Route::name('admin.approvers.list')->get('/approvers/list', 'AdminController@showAllApprovers');

    # Authentication
    Route::name('admin.login')->get('/admin-login', 'Auth\AdminLoginController@showLoginForm');
    Route::name('admin.login.submit')->post('/login', 'Auth\AdminLoginController@login');
    Route::name('admin.logout')->get('/logout', 'Auth\LoginController@adminLogout');

    Route::name('admin.password.request')->get('/forgot/password', 'Auth\AdminForgotPasswordController@showAdminLinkRequestForm');
    Route::name('admin.password.email')->post('/forgot/password/link', 'Auth\AdminForgotPasswordController@sendResetLinkEmail');
    Route::name('admin.password.reset')->get('/forgot/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm');
    Route::name('admin.password.set')->post('/forgot/password/reset', 'Auth\AdminResetPasswordController@reset');


    # Dashboard
    Route::name('admin.dashboard')->get('/', 'AdminController@index');
});
/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function() {
    Route::name('user.registered')->post('/registered', 'UsersController@create');
    Route::name('user.account.register')->get('/register', 'UsersAccountAdminController@showRegisterForm');
    Route::name('user.account.registered')->post('/registered', 'UsersAccountAdminController@create');
    Route::name('user.course.register')->get('/course/register', 'CourseController@showRegisterForm');
    Route::name('user.course.registered')->post('/course/registered', 'CourseController@create');
    Route::name('user.organization.list')->get('/organization/list', 'OrganizationController@index');
    Route::name('user.organization.add')->get('/organization/add', 'OrganizationController@create');
    Route::name('user.logout')->get('/logout', 'Auth\LoginController@userLogout');
});
/*
|--------------------------------------------------------------------------
| Notification route
|--------------------------------------------------------------------------
*/
Route::name('notify.via.sms')->get('/notify_via_sms', 'smsNotifierController@index');
Route::name('faceboo.notification')->get('/fb/post', 'HomeController@sendNotification');
