<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route of admin sign in =>no middleware  :admin.login//
Route::group([
    'namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function () {
    //
    Route::get('login', 'LoginController@login')->name('admin.login');
    //Form//
    Route::post('login', 'LoginController@postLogin')->name('admin.post.login');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {



//  Routes after Admin Login access to his dashboard
    Route::group([
        'namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
//    routes accessible by admin
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

//    ===============Start Settings=================//
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingsMethods')->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingsMethods')->name('update.shippings.methods');
        });
        // ================END Settings=================//
    });




});
//end laravel localiz//

