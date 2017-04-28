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

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('products/areas/{state_id}', 'ProductsController@getStateAreas');

Route::get('products/subcategories/{category_id}', 'ProductsController@getSubCategories');

Route::resource('products','ProductsController');