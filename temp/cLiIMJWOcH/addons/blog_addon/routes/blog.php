<?php

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/{slug}', 'ArticleController@view')->name('articles.view');

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	//articles
	Route::get('/articles', 'ArticleController@index')->name('admin.articles.index');
	Route::get('/articles/{id}/edit', 'ArticleController@edit')->name('admin.articles.edit');
	Route::post('/articles/{id}/update', 'ArticleController@update')->name('admin.articles.update');
	Route::get('/articles/create', 'ArticleController@create')->name('admin.articles.create');
	Route::post('/articles/store', 'ArticleController@store')->name('admin.articles.store');
	Route::post('/articles/publish', 'ArticleController@publish')->name('admin.articles.publish');
	Route::get('/articles/destroy/{id}', 'ArticleController@destroy')->name('admin.articles.destroy');
	Route::get('/articles/checkslug', 'ArticleController@checkslug')->name('admin.articles.checkslug');
	//categories
	Route::get('/categories', 'CategoryController@index')->name('admin.categories.index');
	Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('admin.categories.edit');
	Route::get('/categories/{id}/view', 'CategoryController@view')->name('admin.categories.view');
	Route::post('/categories/{id}/update', 'CategoryController@update')->name('admin.categories.update');
	Route::get('/categories/create', 'CategoryController@create')->name('admin.categories.create');
	Route::post('/categories/store', 'CategoryController@store')->name('admin.categories.store');
	Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('admin.categories.destroy');
	Route::get('/categories/checkslug', 'CategoryController@checkslug')->name('admin.categories.checkslug');
	//tags
	Route::get('/tags', 'TagController@index')->name('admin.tags.index');
	Route::get('/tags/{id}/edit', 'TagController@edit')->name('admin.tags.edit');
	Route::get('/tags/{id}/view', 'TagController@view')->name('admin.tags.view');
	Route::post('/tags/{id}/update', 'TagController@update')->name('admin.tags.update');
	Route::get('/tags/create', 'TagController@create')->name('admin.tags.create');
	Route::post('/tags/store', 'TagController@store')->name('admin.tags.store');
	Route::get('/tags/destroy/{id}', 'TagController@destroy')->name('admin.tags.destroy');
	//comments
	Route::get('/comments', 'CommentController@index')->name('admin.comments.index');
	Route::post('/comments/{id}/update', 'CommentController@update')->name('admin.comments.update');
	Route::get('/comments/destroy/{id}', 'CommentController@destroy')->name('admin.comments.destroy');
});
