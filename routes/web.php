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
  Route::name('admin.user.register')->get('/register', 'AdminController@showRegisterForm');
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
