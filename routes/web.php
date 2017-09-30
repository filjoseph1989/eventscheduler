<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
|
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes();
Route::name('my.login')->post('/my-login', 'Auth\LoginController@myLogin');

Route::resource('home',         'HomeController');
Route::resource('User',         'UserController');
Route::resource('Org',          'OrganizationController');
Route::resource('Calendar',     'CalendarController');
Route::resource('Attendances',  'AttendanceController');
Route::resource('Event',        'EventController', ['parameters' =>[
  'Event' => 'id'
]]);
