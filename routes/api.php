<?php



/**
 * Routes
 */















/**
 * Boilerplate
 */
Route::group(['prefix' => 'auth'], function () {
    Route::post('admin-users/login', 'Auth\Admin\LoginController@login');
    Route::post('admin-users/logout', 'Auth\Admin\LoginController@logoutApi');
});


Route::group(['middleware' => 'auth:admin_api'], function () {
    // USERS
    Route::get('admin-users/current', 'Api\AdminUserController@currentUser');
    Route::get('admin-users', 'Api\AdminUserController@index');
    Route::get('admin-users/{user}', 'Api\AdminUserController@show');
    Route::post('admin-users', 'Api\AdminUserController@store');
    Route::delete('admin-users/', 'Api\AdminUserController@destroy');
    Route::put('admin-users/{user}', 'Api\AdminUserController@update');

    // ROLES
    Route::get('roles', 'Api\RoleController@index');
    Route::get('roles/{role}', 'Api\RoleController@show');
    Route::post('roles', 'Api\RoleController@store');
    Route::delete('roles', 'Api\RoleController@destroy');
    Route::put('roles/{role}', 'Api\RoleController@update');

    // PERMISSIONS
    Route::get('permissions', 'Api\PermissionController@index');
    Route::post('permissions', 'Api\PermissionController@store');

    // PAGES
    Route::get('pages', 'Api\PageController@index');
    Route::get('pages/{page}', 'Api\PageController@show');
    Route::post('pages', 'Api\PageController@store');
    Route::delete('pages', 'Api\PageController@destroy');
    Route::put('pages/{page}', 'Api\PageController@update');

    // SANDBOX - DEV ONLY
    Route::get('sandbox', 'Api\SandboxController@index');
    Route::get('sandbox/{sandbox}', 'Api\SandboxController@show');
    Route::post('sandbox', 'Api\SandboxController@store');
    Route::delete('sandbox', 'Api\SandboxController@destroy');
    Route::put('sandbox/{sandbox}', 'Api\SandboxController@update');


    // FILE UPLOAD
    Route::post('file-upload/image', 'FileController@store');
});
