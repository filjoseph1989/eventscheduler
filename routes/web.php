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

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

#revalidation of back history
Route::group(['middleware' => 'revalidate'], function()
{
  /*
  |--------------------------------------------------------------------------
  | Admin Dashboard Routes
  |--------------------------------------------------------------------------
  */
  require_once "system_route/admin.php";

  /*
  |--------------------------------------------------------------------------
  | Users Dashboard Routes
  |--------------------------------------------------------------------------
  */
  require_once "system_route/user.php";

  /*
  |--------------------------------------------------------------------------
  | Redirect to home page
  |--------------------------------------------------------------------------
  */
  Route::name('home')->get('/home', 'HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Notification route
|
| ! Deprecated
|--------------------------------------------------------------------------
*/
Route::name('notify.via.sms')->get('/notify_via_sms', 'smsNotifierController@index');
Route::name('faceboo.notification')->get('/fb/post', 'HomeController@sendNotification');
Route::name('simulate')->get('/simulate', 'EventController@simulate');
