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
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});


Route::resource('computers', 'ComputerController');
Route::post('maintains', 'MaintainController@index');
Route::resource('parts', 'PartController');
Route::resource('brands', 'BrandController')->except(['index']);
Route::post('brands', 'BrandController@index');

