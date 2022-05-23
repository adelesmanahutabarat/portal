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

/*
*
* Label Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Withdraw\Http\Controllers\Label', 'as' => 'label.', 'middleware' => ['web', 'auth', 'can:view_label'], 'prefix' => 'label'], function () {
    
    /*
     *
     *  Label Withdraw Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'withdraws';
    $controller_name = 'WithdrawController';
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    // Route::get("$module_name/files/{image}", ['as' => "$module_name.files", 'uses' => "$controller_name@index_data"]);
    Route::resource("$module_name", "$controller_name");

});
