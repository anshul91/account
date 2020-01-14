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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

/**User profile related url's */
Route::middleware('auth:web')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/settings/edit-myProfile','admin\SettingsController@updateProfile')->middleware('auth');
    Route::post('/settings/edit-myProfile','admin\SettingsController@updateProfile')->middleware('auth');
    Route::get('change-password','admin\SettingsController@changePassword');
    Route::post('change-password','admin\SettingsController@changePassword');
});


/**Routes below for customers */
Route::middleware('auth:web')->group(function() {
    Route::get('/customer-list', 'Customers\CustomersController@customerList')->name('customer-list');
    Route::get('/customer-add', 'Customers\CustomersController@create')->name('customer-add');
    Route::post('/customer-add', 'Customers\CustomersController@create')->name('customer-add');
    Route::get('/customer-update/{id}', 'Customers\CustomersController@update')->name('customer-update');
    Route::post('/customer-update/{id}', 'Customers\CustomersController@update')->name('customer-update');
    Route::post('/customer-delete', 'Customers\CustomersController@destroy')->name('customer-delete');
    Route::get('/customer-view/{id}', 'Customers\CustomersController@view')->name('customer-view');
   
});

/**Routes below for customers */
Route::middleware('auth:web')->group(function() {
    Route::get('/unit-list', 'Unit\UnitsController@unitList')->name('unit-list');

    Route::get('/customer-add', 'Customers\CustomersController@create')->name('customer-add');
    Route::post('/customer-add', 'Customers\CustomersController@create')->name('customer-add');
    Route::get('/customer-update/{id}', 'Customers\CustomersController@update')->name('customer-update');
    Route::post('/customer-update/{id}', 'Customers\CustomersController@update')->name('customer-update');
    Route::post('/customer-delete', 'Customers\CustomersController@destroy')->name('customer-delete');
    Route::get('/customer-view/{id}', 'Customers\CustomersController@view')->name('customer-view');
   
});


Route::any('/logout','admin\SettingsController@logout');

Route::get('/register',function(){
    return view("auth/register");
});