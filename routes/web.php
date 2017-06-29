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
| Users Routes
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function() {
    Route::name('user.registered')->post('/registered', 'UserController@create');

    Route::name('user.account.register')->get('/register', 'UsersAccountAdminController@showRegisterForm');
    Route::name('user.account.registered')->post('/account/registered', 'UsersAccountAdminController@create');

    Route::name('user.course.register')->get('/course/register', 'CourseController@showRegisterForm');
    Route::name('user.course.registered')->post('/course/registered', 'CourseController@create');

    Route::name('user.department.register')->get('/department/register', 'DepartmentController@showRegisterForm');
    Route::name('user.department.registered')->post('/department/registered', 'DepartmentController@create');

    Route::name('user.position.register')->get('/position/register', 'PositionController@showRegisterForm');
    Route::name('user.position.registered')->post('/position/registered', 'PositionController@create');

    Route::name('user.organization.register')->get('/organization/register', 'OrganizationController@showRegisterForm');
    Route::name('user.organization.registered')->post('/organization/registered', 'OrganizationController@create');

    Route::name('user.event-category.register')->get('/event-category/register', 'EventCategoryController@showRegisterForm');
    Route::name('user.event-category.registered')->post('/event-category/registered', 'EventCategoryController@create');

    Route::name('user.logout')->get('/logout', 'Auth\LoginController@userLogout');
});
/*
|--------------------------------------------------------------------------
| Admin route
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function() {
    # Users
    Route::name('admin.user.list')->get('/users/list', 'AdminController@showAllUserList');
    Route::name('admin.user.register')->post('/user/register', 'UserController@adminCreate');
    Route::name('admin.user.edit')->post('/user/edit', 'UserController@edit');
    Route::name('admin.user.get')->post('/user/get', 'UserController@getUser');

    # User Accounts
    Route::name('admin.user.account.list')->get('/user-account/list', 'AdminController@showAllUserAccountList');
    Route::name('admin.user-account.register')->post('/user-account/register', 'UserAccountController@adminCreate');
    Route::name('admin.user-account.edit')->post('/user-account/edit', 'UserAccountController@edit');

    # Events
    Route::name('admin.event.categories.list')->get('/event/categories/list', 'AdminController@showAllEvenCategoriesList');
    Route::name('admin.event.types.list')->get('/event/types/list', 'AdminController@showAllEventTypes');

    # Course
    Route::name('admin.course.list')->get('/course/list', 'AdminController@showAllCourseList');
    Route::name('admin.course.register')->post('/course/register', 'CourseController@adminCreate');
    Route::name('admin.course.edit')->post('/course/edit', 'CourseController@edit');

    # Department
    Route::name('admin.department.list')->get('/department/list', 'AdminController@showAllDepartmentList');
    Route::name('admin.department.register')->post('/department/register', 'DepartmentController@adminCreate');

    Route::name('admin.position.list')->get('/position/list', 'AdminController@showAllPositionList');
    Route::name('admin.organization.list')->get('/organization/list', 'AdminController@showAllOrganizationList');
    Route::name('admin.approvers.list')->get('/approvers/list', 'AdminController@showAllApprovers');

    # Authentication
    Route::name('admin.login')->get('/admin-login', 'Auth\AdminLoginController@showLoginForm');
    Route::name('admin.login.submit')->post('/login', 'Auth\AdminLoginController@login');
    Route::name('admin.logout')->get('/logout', 'Auth\LoginController@adminLogout');

    # Password reset for admin
    Route::name('admin.password.request')->get('/forgot/password', 'Auth\AdminForgotPasswordController@showAdminLinkRequestForm');
    Route::name('admin.password.email')->post('/forgot/password/link', 'Auth\AdminForgotPasswordController@sendResetLinkEmail');
    Route::name('admin.password.reset')->get('/forgot/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm');
    Route::name('admin.password.set')->post('/forgot/password/reset', 'Auth\AdminResetPasswordController@reset');

    # Dashboard
    Route::name('admin.dashboard')->get('/', 'AdminController@index');
});
/*
|--------------------------------------------------------------------------
| Notification route
|--------------------------------------------------------------------------
*/
Route::name('notify.via.sms')->get('/notify_via_sms', 'smsNotifierController@index');
Route::name('faceboo.notification')->get('/fb/post', 'HomeController@sendNotification');
