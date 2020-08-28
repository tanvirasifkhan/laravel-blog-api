<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**********************************   Category Route Starts Here   *******************************************/
Route::get('categories','CategoryController@index');
Route::post('category/store','CategoryController@store');
Route::get('category/{id}/show','CategoryController@show');
Route::post('category/{id}/update','CategoryController@update');
Route::post('category/{id}/remove','CategoryController@remove');
Route::get('category/{keyword}/search','CategoryController@searchCategory');
/**********************************   Category Route Ends Here   *******************************************/

/**********************************   Article Route Starts Here   *******************************************/
Route::get('articles','ArticleController@index');
Route::post('article/store','ArticleController@store');
Route::get('article/{id}/show','ArticleController@show');
Route::post('article/{id}/update','ArticleController@update');
Route::post('article/{id}/remove','ArticleController@remove');
Route::get('article/{keyword}/search','ArticleController@searchArticle');
Route::get('article/{id}/comments','ArticleController@comments');
/**********************************   Article Route Ends Here   *******************************************/

/**********************************   Comment Route Starts Here   *******************************************/
Route::get('comments','CommentController@index');
Route::post('comment/store','CommentController@store');
Route::get('comment/{id}/show','CommentController@show');
Route::post('comment/{id}/update','CommentController@update');
Route::post('comment/{id}/remove','CommentController@remove');
/**********************************   Comment Route Ends Here   *******************************************/

/**********************************   Author Route Starts Here   *******************************************/
Route::get('authors','AuthorController@index');
Route::post('register','AuthorController@register');
Route::post('login','AuthorController@login');
/**********************************   Author Route Ends Here   *******************************************/