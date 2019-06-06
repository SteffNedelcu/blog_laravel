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

Route::get('/admin/categories', 'admin\CategoriesController@index'); // list all categories
Route::post('/admin/categories', 'admin\CategoriesController@store'); // request post to add a category
Route::get('/admin/categories/create', 'admin\CategoriesController@create'); // form for adding
Route::get('/admin/categories/{category}', 'admin\CategoriesController@show'); // display the page
Route::patch('/admin/categories/{category}', 'admin\CategoriesController@update'); //request for update the category
Route::delete('/admin/categories/{category}', 'admin\CategoriesController@destroy'); // remove a category
Route::get('/admin/categories/{category}/edit', 'admin\CategoriesController@edit'); // display the edit form


//Routes for posts
Route::get('/admin/posts', 'admin\PostsController@index'); // list all categories
Route::get('/admin/categories/{category}/posts/create', 'admin\PostsController@create'); // display the form to add
Route::post('/admin/categories/{category}/posts', 'admin\PostsController@store'); 
Route::get('/admin/posts/{post}/edit', 'admin\PostsController@edit');
Route::patch('/admin/posts/{post}', 'admin\PostsController@update');
Route::delete('/admin/posts/{post}', 'admin\PostsController@destroy');


// Playground - various tests

Route::get('/pg/posts', 'PlaygroundController@index'); 
Route::get('/pg/posts/{post}', 'PlaygroundController@find'); 
Route::get('/pg/posts/{post}/2', 'PlaygroundController@find2'); 
Route::get('/pg/posts-in', 'PlaygroundController@getIn'); 
Route::get('/pg/posts-in2', 'PlaygroundController@getIn2'); 
Route::get('/pg/whereBetween', 'PlaygroundController@whereBetween'); 
Route::get('/pg/lastPost', 'PlaygroundController@lastPost'); 
Route::get('/pg/randomPost', 'PlaygroundController@randomPost'); 
Route::get('/pg/mapceva', 'PlaygroundController@mapceva'); 
Route::get('/pg/getUserPosts', 'PlaygroundController@getUserPosts'); 
Route::get('/pg/getUser', 'PlaygroundController@getUser'); 
Route::get('/pg/leftJoin', 'PlaygroundController@leftJoin'); 
Route::get('/pg/testPagination', 'PlaygroundController@testPagination'); 

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
