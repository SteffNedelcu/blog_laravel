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


Route::get('/admin/', 'admin\AdminController@index');

Route::get('/admin/categories', 'admin\CategoriesController@index');
Route::post('/admin/categories', 'admin\CategoriesController@store');
Route::get('/admin/categories/create', 'admin\CategoriesController@create');
Route::get('/admin/categories/{category}', 'admin\CategoriesController@show');
Route::patch('/admin/categories/{category}', 'admin\CategoriesController@update');
Route::delete('/admin/categories/{category}', 'admin\CategoriesController@destroy');
Route::get('/admin/categories/{category}/edit', 'admin\CategoriesController@edit');
