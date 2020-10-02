<?php

use App\Models\Category;
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
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

//        Admin profile setting//
        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
            Route::put('update', 'ProfileController@updateProfile')->name('update.profile');

        });

//    ===============Start Settings=================//
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingsMethods')->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingsMethods')->name('update.shippings.methods');
        });
        // ================END Settings=================//

        //##################### Begin mainCategories Routes#############################################//
        Route::group(['prefix' => 'mainCategories'], function () {
            Route::get('/', 'MainCategoryController@index')->name('dashboard.categories.index');
            Route::get('create', 'MainCategoryController@create')->name('dashboard.categories.create');
            Route::post('store', 'MainCategoryController@store')->name('admin.mainCategories.store');
            Route::get('edit/{id}', 'MainCategoryController@edit')->name('admin.mainCategories.edit');
            Route::post('update/{id}', 'MainCategoryController@update')->name('admin.mainCategories.update');
            Route::get('delete/{id}', 'MainCategoryController@destroy')->name('admin.mainCategories.delete');
            Route::get('changeStatus/{id}', 'MainCategoryController@changeStatus')->name('admin.mainCategories.status');
        });
        //##################### End mainCategories Routes#############################################//

        ######################### Begin Sub Categoris Routes ########################
        Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/','SubCategoryController@index') -> name('dashboard.subcategories');
            Route::get('create','SubCategoryController@create') -> name('dashboard.subcategories.create');
            Route::post('store','SubCategoryController@store') -> name('dashboard.subcategories.store');
            Route::get('edit/{id}','SubCategoryController@edit') -> name('dashboard.subcategories.edit');
            Route::post('update/{id}','SubCategoryController@update') -> name('dashboard.subcategories.update');
            Route::get('delete/{id}','SubCategoryController@destroy') -> name('dashboard.subcategories.delete');
            Route::get('changeStatus/{id}','SubCategoryController@changeStatus') -> name('dashboard.subcategories.status');

        });
        ######################### End  Sub Categoris Routes  ########################

        ######################### Begin Sub Categoris Routes ########################
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/','BrandsController@index') -> name('dashboard.brands');
            Route::get('create','BrandsController@create') -> name('dashboard.brands.create');
            Route::post('store','BrandsController@store') -> name('dashboard.brands.store');
            Route::get('edit/{id}','BrandsController@edit') -> name('dashboard.brands.edit');
            Route::put('update/{id}','BrandsController@update') -> name('dashboard.brands.update');
            Route::get('delete/{id}','BrandsController@destroy') -> name('dashboard.brands.delete');
            Route::get('changeStatus/{id}','BrandsController@changeStatus') -> name('dashboard.brands.status');

        });
        ######################### End  Sub Categoris Routes  ########################

        ######################### Begin  tags Routes ########################
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/','TagsController@index') -> name('dashboard.tags');
            Route::get('create','TagsController@create') -> name('dashboard.tags.create');
            Route::post('store','TagsController@store') -> name('dashboard.tags.store');
            Route::get('edit/{id}','TagsController@edit') -> name('dashboard.tags.edit');
            Route::post('update/{id}','TagsController@update') -> name('dashboard.tags.update');
            Route::get('delete/{id}','TagsController@destroy') -> name('dashboard.tags.delete');
            Route::get('changeStatus/{id}','TagsController@changeStatus') -> name('dashboard.tags.status');

        });
        ######################### End  Sub tags Routes  ########################
        ######################### Begin  products Routes ########################
        Route::group(['prefix' => 'products'], function () {
            Route::get('/','ProductsController@index') -> name('dashboard.products');
            Route::get('general-information','ProductsController@create') -> name('dashboard.products.general.create');
            Route::post('store-general-information','ProductsController@store') -> name('dashboard.products.general.store');
//            Route::get('edit/{id}','TagsController@edit') -> name('dashboard.tags.edit');
//            Route::post('update/{id}','TagsController@update') -> name('dashboard.tags.update');
//            Route::get('delete/{id}','TagsController@destroy') -> name('dashboard.tags.delete');
//            Route::get('changeStatus/{id}','TagsController@changeStatus') -> name('dashboard.tags.status');

        });
        ######################### End  Sub tags Routes  ########################
    });



});
//end laravel localiz//

/*test*/

