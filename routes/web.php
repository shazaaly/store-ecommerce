<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*test Routes*/


Route::get('admin', function () {
    return view('layouts.admin');
});

Route::get('test', function () {
   return  \App\Models\Setting::find(57);
});

/*END test Routes*/
