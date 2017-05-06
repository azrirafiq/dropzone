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
Route::get('/', 'ProductsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

//route for state
Route::resource('states','StatesController');

//route for area
Route::resource('areas','AreasController');

//route for category
Route::resource('categories','CategoriesController');

//route for subcat
Route::resource('subcategories','SubcategoriesController');

//route for subcat
Route::resource('listing_types','Listing_typesController');

//route for subcat
Route::resource('brands','BrandsController');

//route for subcat
Route::get('my_products', 'ProductsController@my_products')->name('my_products');
Route::get('products/areas/{state_id}', 'ProductsController@getStateAreas');

Route::get('products/subcategories/{category_id}', 'ProductsController@getSubCategories');

Route::resource('products','ProductsController');

// Route::get('/products/edit/')

//route for admin manage product
Route::group(['prefix' => 'admin','as'=>'admin.'], function () {
    
    //route for products
	Route::get('products/areas/{state_id}', 'Admin\AdminProductsController@getStateAreas');
	Route::get('products/subcategories/{category_id}', 'Admin\AdminProductsController@getSubCategories');
	Route::resource('products','Admin\AdminProductsController');

	//route for brand

	//route for category

});