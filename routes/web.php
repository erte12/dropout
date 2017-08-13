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
Route::get('/panel/websites', 'PanelController@user_websites')->name('panel.user.websites');
Route::get('/panel/admin/websites/accepted', 'PanelController@admin_websites_accepted')->name('panel.admin.websites.accepted');
Route::get('/panel/admin/websites/waiting', 'PanelController@admin_websites_waiting')->name('panel.admin.websites.waiting');
Route::get('/panel/admin/websites/edited', 'PanelController@admin_websites_edited')->name('panel.admin.websites.edited');
Route::get('/panel/admin/websites/deleted', 'PanelController@admin_websites_deleted')->name('panel.admin.websites.deleted');
Route::get('/panel/admin/websites/waiting', 'PanelController@admin_websites_waiting')->name('panel.admin.websites.waiting');
Route::get('/panel/admin/users', 'PanelController@admin_users')->name('panel.admin.users');
Route::get('/rules', function () { return view('info.rules'); });
Route::delete('/website/force/{website}', 'WebsiteController@destroy_forever')->name('website.destroy.forever');
Route::resource('/website', 'WebsiteController', ['except' => 'index']);
Route::resource('/website/edited', 'WebsiteEditedController', ['except' => ['index', 'create', 'store', 'show']]);
Route::resource('/category', 'CategoryController', ['except' => 'index']);
Route::resource('/subcategory', 'SubcategoryController', ['except' => 'index']);
Route::resource('/user', 'UsersController', ['only' => ['edit', 'update', 'destroy']]);
Route::get('/search', 'SearchController@websites')->name('search');
