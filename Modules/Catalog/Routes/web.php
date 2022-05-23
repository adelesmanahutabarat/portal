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
Route::group(['namespace' => '\Modules\Catalog\Http\Controllers\Label', 'as' => 'label.', 'middleware' => ['web', 'auth', 'can:view_label'], 'prefix' => 'label'], function () {
    
    /*
     *
     *  Label Catalogs Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'catalogs';
    $controller_name = 'CatalogController';
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    // Route::get("$module_name/files/{image}", ['as' => "$module_name.files", 'uses' => "$controller_name@index_data"]);
    Route::resource("$module_name", "$controller_name");

    /*
     *
     *  CatalogFiles Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'catalogfiles';
    $controller_name = 'CatalogFilesController';
    Route::resource("$module_name", "$controller_name");
});
