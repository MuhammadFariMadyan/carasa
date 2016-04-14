<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PageController;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [
	'as'=>'login',
	'uses'=>'Auth\AuthController@getlogin'
	]);
Route::post('/login', [
	'as'=>'postlogin',
	'uses'=>'Auth\AuthController@postLogin'
	]);
Route::get('/logout', [
	'as'=>'logout',
	'uses'=>'Auth\AuthController@getLogout'
	]);
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', [
	'as'=>'dashboard',
	'uses'=>'PageController@getDashboard'
	]);

	Route::get('/editadmin/{id}',
	function($id){
		$num = new PageController();
		return $num->editAdmin($id);
	});
	Route::post('/saveadmin/', [
	'as'=>'saveadmin',
	'uses'=>'PageController@saveAdmin'
	]);
	Route::get('/createadmin', [
	'as'=>'createadmin',
	'uses'=>'PageController@createAdmin'
	]);
	Route::post('/registeradmin/', [
	'as'=>'registeradmin',
	'uses'=>'PageController@registerAdmin'
	]);
	Route::get('/deleteadmin/{id}', [
	'as'=>'deleteadmin',
	'uses'=>'PageController@deleteAdmin'
	]);
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

