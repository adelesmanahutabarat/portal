<?php

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/

// Employee
Route::group(['namespace' => '\Modules\Master\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    $module_name = 'employees';
    $controller_name = 'EmployeeController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/detail", ['as' => "$module_name.detail", 'uses' => "$controller_name@detail"]);
    Route::get("$module_name/detail_list", ['as' => "$module_name.detail_list", 'uses' => "$controller_name@detail_list"]);
    Route::resource("$module_name", "$controller_name");
});

// Bank
Route::group(['namespace' => '\Modules\Master\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    $module_name = 'banks';
    $controller_name = 'BankController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/detail", ['as' => "$module_name.detail", 'uses' => "$controller_name@detail"]);
    Route::get("$module_name/detail_list", ['as' => "$module_name.detail_list", 'uses' => "$controller_name@detail_list"]);
    Route::resource("$module_name", "$controller_name");
});

// Bank Account
Route::group(['namespace' => '\Modules\Master\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    $module_name = 'bankaccounts';
    $controller_name = 'BankAccountController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/detail", ['as' => "$module_name.detail", 'uses' => "$controller_name@detail"]);
    Route::get("$module_name/detail_list", ['as' => "$module_name.detail_list", 'uses' => "$controller_name@detail_list"]);
    Route::resource("$module_name", "$controller_name");
});
