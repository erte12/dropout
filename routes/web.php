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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/panel', 'PanelController@index')->name('panel');
Route::resource('/website', 'WebsiteController', ['except' => 'index']);
Route::resource('/category', 'CategoryController', ['except' => 'index']);
Route::resource('/subcategory', 'SubcategoryController', ['except' => 'index']);
Route::get('/search', 'SearchController@websites')->name('search');
