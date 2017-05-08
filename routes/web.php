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


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('dashboard');



    /* articles routes */
    Route::get('/articles', 'ArticlesController@index')->name('articles');


    /* recipes routes */
    Route::get('/recipes', 'RecipesController@index')->name('recipes');
    Route::get('/recipe/{id}', 'RecipesController@show')->name('recipesdetails');

    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/user-create',      'UsersController@create')->name('usercreate');
    Route::post('/user-save',        'UsersController@store')->name('usersave');
    Route::get('/user-edit/{id}',        'UsersController@edit')->name('useredit');
    Route::post('/user-update/{id}',     'UsersController@update')->name('userupdate');

    /* news routes */
    Route::get('/news', 'NewsController@index')->name('news');
    Route::get('/show/{id}', 'NewsController@show')->name('newsdetails');
    Route::get('/create',           'NewsController@create')->name('newscreate');
    Route::post('/save',            'NewsController@store')->name('newssave');
    Route::get('/edit/{id}',        'NewsController@edit')->name('newsedit');
    Route::get('/delete/{id}',      'NewsController@destroy')->name('newsdelete');
    Route::post('/update/{id}',     'NewsController@update')->name('newsupdate');

    Route::get('/article-create',       'ArticlesController@create')->name('articlecreate');
    Route::post('/article-save',        'ArticlesController@store')->name('articlesave');
    Route::get('/article-edit/{id}',    'ArticlesController@edit')->name('articleedit');
    Route::get('/article-delete/{id}',  'ArticlesController@destroy')->name('articledelete');
    Route::post('/article-update/{id}', 'ArticlesController@update')->name('articleupdate');

    Route::get('/recipe-create',        'RecipesController@create')->name('recipescreate');
    Route::post('/recipe-save',         'RecipesController@store')->name('recipessave');
    Route::get('/recipe-edit/{id}',     'RecipesController@edit')->name('recipesedit');
    Route::get('/recipe-delete/{id}',   'RecipesController@destroy')->name('recipesdelete');
    Route::post('/recipe-update/{id}',  'RecipesController@update')->name('recipesupdate');
});


Route::group(['namespace' => 'Front'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    /* articles routes */
    Route::get('/articles', 'ArticlesController@index')->name('front.articles');
    Route::get('/article/{id}', 'ArticlesController@show')->name('front.article');

    /* news routes */
    Route::get('/news', 'NewsController@index')->name('front.newslist');
    Route::get('/news/{id}', 'NewsController@show')->name('front.news');

    Route::get('/recipes', 'RecipesController@index')->name('front.recipes');
    Route::get('/recipe/{id}', 'RecipesController@show')->name('front.recipe');


    /* comments routes*/
    Route::post('/comment-save',         'CommentsController@saveComment')->name('commentssave');
});



