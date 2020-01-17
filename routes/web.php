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

Route::get('/', 'HomeController@index')->name('home');

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

    Route::get('/unit-add', 'Unit\UnitsController@create')->name('unit-add');
    Route::post('/unit-add', 'Unit\UnitsController@create')->name('unit-add');
    Route::get('/unit-update/{id}', 'Unit\UnitsController@update')->name('unit-update');
    Route::post('/unit-update/{id}', 'Unit\UnitsController@update')->name('unit-update');
    Route::post('/unit-delete', 'Unit\UnitsController@destroy')->name('unit-delete');
    Route::get('/unit-view/{id}', 'Unit\UnitsController@view')->name('unit-view');
   
});
/**Routes below for master-Products */
Route::middleware('auth:web')->group(function() {
    Route::get('/master-product-list', 'MasterProducts\MasterProductsController@masterProductList')->name('master-product-list');

    Route::get('/master-product-add', 'MasterProducts\MasterProductsController@create')->name('master-product-add');
    Route::post('/master-product-add', 'MasterProducts\MasterProductsController@create')->name('master-product-add');
    Route::get('/master-product-update/{id}', 'MasterProducts\MasterProductsController@update')->name('master-product-update');
    Route::post('/master-product-update/{id}', 'MasterProducts\MasterProductsController@update')->name('master-product-update');
    Route::post('/master-product-delete', 'MasterProducts\MasterProductsController@destroy')->name('master-product-delete');
    Route::get('/master-product-view/{id}', 'MasterProducts\MasterProductsController@view')->name('master-product-view');
   
});

/**Routes below for Products */
Route::middleware('auth:web')->group(function() {
    Route::get('/product-list', 'Products\ProductsController@productList')->name('product-list');

    Route::get('/product-add', 'Products\ProductsController@create')->name('product-add');
    Route::post('/product-add', 'Products\ProductsController@create')->name('product-add');
    Route::get('/product-update/{id}', 'Products\ProductsController@update')->name('product-update');
    Route::post('/product-update/{id}', 'Products\ProductsController@update')->name('product-update');
    Route::post('/product-delete', 'Products\ProductsController@destroy')->name('product-delete');
    Route::get('/product-view/{id}', 'Products\ProductsController@view')->name('product-view');
   
});

Route::any('/logout','admin\SettingsController@logout');
Route::any('/login',function(){
    return view('auth/login');
});
Route::get('/register',function(){
    return view("auth/register");
});
Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
