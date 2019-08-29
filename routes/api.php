<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function(){
	Route::post('admin-users/login', 'Auth\Admin\LoginController@login');
  Route::post('admin-users/logout', 'Auth\Admin\LoginController@logoutApi');
});


Route::group(['middleware' => 'auth:admin_api'], function(){
  // USERS
	Route::get('admin-users/current', 'Api\AdminUserController@currentUser');
	Route::get('admin-users', 'Api\AdminUserController@index');
	Route::get('admin-users/{admin}', 'Api\AdminUserController@show');
	Route::post('admin-users', 'Api\AdminUserController@store');
	Route::delete('admin-users/', 'Api\AdminUserController@destroy');
	Route::put('admin-users/{admin}', 'Api\AdminUserController@update');

  // ROLES
	Route::get('roles', 'Api\RoleController@index');
	Route::get('roles/{role}', 'Api\RoleController@show');
	Route::post('roles', 'Api\RoleController@store');
	Route::delete('roles', 'Api\RoleController@destroy');
	Route::put('roles/{role}', 'Api\RoleController@update');



  // SANDBOX - DEV ONLY
	Route::get('sandbox', 'Api\SandboxController@index');
	Route::get('sandbox/{sandbox}', 'Api\SandboxController@show');
	Route::post('sandbox', 'Api\SandboxController@store');
	Route::delete('sandbox', 'Api\SandboxController@destroy');
	Route::put('sandbox/{sandbox}', 'Api\SandboxController@update');


  // FILE UPLOAD
  Route::post('file-upload/image', 'FileController@store');

});
