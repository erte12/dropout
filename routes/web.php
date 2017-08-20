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
Route::get('/panel/strony', 'PanelController@user_websites')->name('panel.user.websites');
Route::get('/regulamin', function () { return view('info.rules'); })->name('rules');

/* Panel - admin */
Route::get('/panel/admin/strony/zaakceptowane', 'PanelController@admin_websites_accepted')->name('panel.admin.websites.accepted');
Route::get('/panel/admin/strony/oczekujace', 'PanelController@admin_websites_waiting')->name('panel.admin.websites.waiting');
Route::get('/panel/admin/strony/edytowane', 'PanelController@admin_websites_edited')->name('panel.admin.websites.edited');
Route::get('/panel/admin/strony/usuniete', 'PanelController@admin_websites_deleted')->name('panel.admin.websites.deleted');
Route::get('/panel/admin/uzytkownicy', 'PanelController@admin_users')->name('panel.admin.users');

/* Websites */
Route::delete('/strona/f/{website}', 'WebsiteController@destroy_forever')->name('website.destroy.forever');
Route::get('/{category}/{subcategory}/{website}-{id}', 'WebsiteController@show')->name('website.show');
Route::get('/{category}/{subcategory}/{website}-{id}/edytuj', 'WebsiteController@edit')->name('website.edit');
Route::get('/dodaj-strone', 'WebsiteController@create')->name('website.create');
Route::post('/strona', 'WebsiteController@store')->name('website.store');
Route::patch('/strona/{id}', 'WebsiteController@update')->name('website.update');
Route::delete('/strona/{id}', 'WebsiteController@destroy')->name('website.delete');

/* Websites edited */
Route::get('/strony-edytowana/{id}/edytuj', 'WebsiteEditedController@edit')->name('website.edited.edit');
Route::patch('/strony-edytowana/{id}', 'WebsiteEditedController@update')->name('website.edited.update');
Route::delete('/strony-edytowana/{id}', 'WebsiteEditedController@destroy')->name('website.edited.delete');

/* Search */
Route::get('/szukaj', 'SearchController@websites')->name('search');

/* Categories */
Route::get('/{category}', 'CategoryController@show')->name('category.show');

/* Subcategories */
Route::get('/{category}/{subcategory}', 'SubcategoryController@show')->name('subcategory.show');

/* Users */
Route::resource('/user', 'UsersController', ['only' => ['edit', 'update', 'destroy']]);
