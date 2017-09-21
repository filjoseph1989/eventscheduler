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

#revalidation of back history
Route::group(['middleware' => 'revalidate'], function() {
  /*
  |--------------------------------------------------------------------------
  | Authentication route
  |--------------------------------------------------------------------------
  */
  Auth::routes();
  Route::name('change.password')->post('/change/password', 'Auth\ChangePassword@changePassword');
  /*
  |--------------------------------------------------------------------------
  | Admin Dashboard Routes
  |--------------------------------------------------------------------------
  */
  require_once "system_route/admin.php";
  
  /*
  |--------------------------------------------------------------------------
  | Ajax request
  |--------------------------------------------------------------------------
  */
  # Ajax Request
  # Issue 44: This part can be improve by creating a method that accept id and model name
  Route::name('ajax.get.event-type')->post('/get/event-type', 'JsonController@getEventType');
  Route::name('ajax.get.event-category')->post('/get/event-category', 'JsonController@getEventCategory');
  Route::name('ajax.get.organization')->post('/get/organization', 'JsonController@getOrganization');
  Route::name('ajax.get.event.list')->post('/get/event', 'JsonController@getEvent');
  Route::name('ajax.get.events')->post('/get/events', 'JsonController@getEventList');
  Route::name('ajax.get.event.personal.list')->post('/get/personal/event', 'JsonController@getPersonalEvent');
  Route::name('ajax.update.event.personal.list')->post('/update/personal/event', 'JsonController@updatePersonalEvent');
  Route::name('ajax.update.event.list')->post('/update/event', 'JsonController@updateEvent');
  Route::name('ajax.get.event.approvers')->post('/get/approver', 'JsonController@getApprover');
  Route::name('ajax.update.organization')->post('/update/organization', 'JsonOrganizationController@update');

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

  /*
  |--------------------------------------------------------------------------
  | Refreshes artisan
  |--------------------------------------------------------------------------
  */
  Route::get('test','TestController@test');
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
