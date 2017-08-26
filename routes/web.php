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

/* Auth */
Auth::routes();

/* Panel - user */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/panel', 'PanelController@index')->name('panel');
Route::get('/panel/websites', 'PanelController@user_websites')->name('panel.user.websites');
Route::get('/rules', function () { return view('info.rules'); })->name('rules');

/* Panel - admin */
Route::get('/panel/admin/websites/accepted', 'PanelController@admin_websites_accepted')->name('panel.admin.websites.accepted');
Route::get('/panel/admin/websites/waiting', 'PanelController@admin_websites_waiting')->name('panel.admin.websites.waiting');
Route::get('/panel/admin/websites/edited', 'PanelController@admin_websites_edited')->name('panel.admin.websites.edited');
Route::get('/panel/admin/websites/deleted', 'PanelController@admin_websites_deleted')->name('panel.admin.websites.deleted');
Route::get('/panel/admin/users', 'PanelController@admin_users')->name('panel.admin.users');

/* Websites */
Route::delete('/website/f/{website}', 'WebsiteController@destroy_forever')->name('website.destroy.forever');
Route::get('/{category}/{subcategory}/{website}-{id}', 'WebsiteController@show')->name('website.show');
Route::get('/{category}/{subcategory}/{website}-{id}/edit', 'WebsiteController@edit')->name('website.edit');
Route::get('/add-website', 'WebsiteController@create')->name('website.create');
Route::resource('/website', 'WebsiteController', ['only' => ['store', 'update', 'destroy']]);

/* Websites edited */
Route::get('/website-edited/{id}/edit', 'WebsiteEditedController@edit')->name('website.edited.edit');
Route::patch('/website-edited/{id}', 'WebsiteEditedController@update')->name('website.edited.update');
Route::delete('/website-edited/{id}', 'WebsiteEditedController@destroy')->name('website.edited.delete');

/* Search */
Route::get('/search', 'SearchController@websites')->name('search');

/* Categories */
Route::get('/{category}', 'CategoryController@show')->name('category.show');

/* Subcategories */
Route::get('/{category}/{subcategory}', 'SubcategoryController@show')->name('subcategory.show');

/* Users */
Route::resource('/user', 'UsersController', ['only' => ['edit', 'update', 'destroy']]);
