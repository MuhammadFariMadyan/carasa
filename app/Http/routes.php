<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Login and Logout
|--------------------------------------------------------------------------
|
| Provided here are routes for login and logout :
| /login (get) -> returns login form/login 
| /login (post) -> send filled (or not) login form to server, implemented with csrf token security
|/ logout --> route to destroy the session of currently logged in user
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [
	'as'=>'login',
	'uses'=>'Auth\AuthController@getlogin'
	]);
Route::group(['middleware' => 'csrf'], function()
{
	Route::post('/login', [
	'as'=>'postlogin',
	'uses'=>'Auth\AuthController@postLogin'
	]);
});
Route::get('/logout', [
	'as'=>'logout',
	'uses'=>'Auth\AuthController@getLogout'
	]);

/*
|--------------------------------------------------------------------------
| Admin Management Routes
|--------------------------------------------------------------------------
|
| 
| This route is provided for Admin Management of Carasa purposes :
| /dashboard ---> returns list of admins (read)
| /editadmin/{id} --> returns edit admin form with id parameter corresponding to a registered admin's username
| /saveadmin/ ---> saves edited of a chosen admin to be edited in the database, implemented with csrf token security on the form.
| /createadmin --> returns a form to create new admin
| /registeradmin/ ---> saves data of created admin to database, implemented with csrf token security on the form.
*/

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', [
	'as'=>'dashboard',
	'uses'=>'PageController@getDashboard'
	]);

	Route::group(['middleware' => 'admin'], function()
	{

	Route::get('/editadmin/{id}', array('as'=>'editadmin',
		function($id){
		$num = new PageController();
		return $num->editAdmin($id);
	}));
	Route::group(['middleware' => 'csrf'], function()
	{
		Route::post('/saveadmin/', [
		'as'=>'saveadmin',
		'uses'=>'PageController@saveAdmin'
		]);
		Route::post('/registeradmin/', [
		'as'=>'registeradmin',
		'uses'=>'PageController@registerAdmin'
		]);
		Route::post('/searchadmin/', [
		'as'=>'searchadmin',
		'uses'=>'PageController@searchAdmin'
		]);
	});
	Route::get('/createadmin', [
	'as'=>'createadmin',
	'uses'=>'PageController@createAdmin'
	]);
	Route::get('/deleteadmin/{id}', [
	'as'=>'deleteadmin',
	'uses'=>'PageController@deleteAdmin'
	]);
	});

	
/*
|--------------------------------------------------------------------------
| Forgot Password Routes
|--------------------------------------------------------------------------
|
| 
| This route is provided for Forgot Password of Carasa purposes :
| /password/email (get) -> route to the interface to get the email of the user who forgot his/her password 
| /password/email (post) -> route to the interface to send the email of the user who forgot his/her password to server
| /password/email (get) -> route to the interface to get password reset request of the user who forgot his/her password to server based on the token generated in password.resets table
|  /password/email (post) -> route to the interface to send password reset request of the user who forgot his/her password to server (to be read)
*/

});
Route::get('password/email', 
[
		'as'=>'getemail',
		'uses'=>'Auth\PasswordController@getEmail'
]);
Route::post('password/email', 
[
	'as'=>'postemail',
	'uses'=>'Auth\PasswordController@postEmail'
]);
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Routes that integrated with API, for testing the web.
| /login -> for login testing. returns username and hashed password of authenticated admin
| /searchadmin -> for admin searching purposes. returns admin with submitted keyword's username, name, and email.
| /retrieveadmin -> retrieve all admins in the database. returns their email, username, and name.
| /editadmin -> edit a designated admin. you can edit ther names, emails, usernames, passwords,  addresses, and mobile phone numbers
| /deleteadmin -> delete an admin with a certain username
*/

Route::post ('apicarasa/login/', 'ApiController@login');

Route::group(['middleware' => 'apiauth'], function()
{
	Route::get('apicarasa/retrieveadmin', 
	[
		'as'=>'apiretrieveadmin',
		'uses'=>'ApiController@retrieveAdmin'
	]);
	Route::post('apicarasa/searchadmin/', 
	[
		'as'=>'apisearchadmin',
		'uses'=>'ApiController@searchAdmin'
	]);
	Route::put('apicarasa/editadmin/', 
	[
		'as'=>'apieditadmin',
		'uses'=>'ApiController@editAdmin'
	]);
	Route::post('apicarasa/createadmin/', 
	[
		'as'=>'apicreateadmin',
		'uses'=>'ApiController@registerAdmin'
	]);
	Route::delete('apicarasa/deleteadmin/', 
	[
		'as'=>'apideleteadmin',
		'uses'=>'ApiController@eraseAdmin'
	]);

});