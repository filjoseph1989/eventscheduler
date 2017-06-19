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

Route::prefix('admin')->group(function() {
  Route::name('admin.login')->get('/login', 'Auth\AdminLoginController@showLoginForm');
  Route::name('admin.login.submit')->post('/login', 'Auth\AdminLoginController@login');
  Route::name('admin.dashboard')->get('/', 'AdminController@index');
});

Route::name('notify.via.sms')->get('/notify_via_sms', 'smsNotifierController@index');

Route::prefix('organization')->group(function() {
  Route::name('organization.list')->get('/list', 'OrganizationController@index');
});
