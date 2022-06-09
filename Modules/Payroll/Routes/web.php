<?php

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Payroll\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    $module_name = 'payrolls';
    $controller_name = 'PayrollController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/detail_list", ['as' => "$module_name.detail_list", 'uses' => "$controller_name@detail_list"]);
    Route::get("$module_name/getdownloadexample", ['as' => "$module_name.getdownloadexample", 'uses' => "$controller_name@getdownloadexample"]);

    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::post("$module_name/storeloadinfile", ['as' => "$module_name.storeloadinfile", 'uses' => "$controller_name@storeloadinfile"]);
    Route::resource("$module_name", "$controller_name");
});

Route::group(['namespace' => '\Modules\Payroll\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    $module_name = 'resetpayrolls';
    $controller_name = 'ResetPayrollController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/detail_list", ['as' => "$module_name.detail_list", 'uses' => "$controller_name@detail_list"]);
    Route::get("$module_name/reset/{id}", ['as' => "$module_name.reset", 'uses' => "$controller_name@reset"]);


    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::post("$module_name/storeloadinfile", ['as' => "$module_name.storeloadinfile", 'uses' => "$controller_name@storeloadinfile"]);
    Route::resource("$module_name", "$controller_name");
});

/*
*
* Employee Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Payroll\Http\Controllers\Employee', 'as' => 'employee.', 'middleware' => ['web', 'auth', 'can:view_employee'], 'prefix' => 'employee'], function () {
    $module_name = 'payrolls';
    $controller_name = 'UserPayrollController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/detail_list", ['as' => "$module_name.detail_list", 'uses' => "$controller_name@detail_list"]);

    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::post("$module_name/storeloadinfile", ['as' => "$module_name.storeloadinfile", 'uses' => "$controller_name@storeloadinfile"]);
    Route::resource("$module_name", "$controller_name");
});