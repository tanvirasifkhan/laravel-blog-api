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
Route::get('categories','CategoryController@index')->middleware('auth:api');
Route::post('category/store','CategoryController@store')->middleware('auth:api');
Route::get('category/{id}/show','CategoryController@show');
Route::post('category/{id}/update','CategoryController@update')->middleware('auth:api');
Route::post('category/{id}/remove','CategoryController@remove')->middleware('auth:api');
Route::get('category/{keyword}/search','CategoryController@searchCategory');
/**********************************   Category Route Ends Here   *******************************************/

/**********************************   Article Route Starts Here   *******************************************/
Route::get('articles','ArticleController@index')->middleware('auth:api');
Route::post('article/store','ArticleController@store')->middleware('auth:api');
Route::get('article/{id}/show','ArticleController@show');
Route::post('article/{id}/update','ArticleController@update')->middleware('auth:api');
Route::post('article/{id}/remove','ArticleController@remove')->middleware('auth:api');
Route::get('article/{keyword}/search','ArticleController@searchArticle');
Route::get('article/{id}/comments','ArticleController@comments');
/**********************************   Article Route Ends Here   *******************************************/

/**********************************   Comment Route Starts Here   *******************************************/
Route::get('comments','CommentController@index')->middleware('auth:api');
Route::post('comment/store','CommentController@store')->middleware('auth:api');
Route::get('comment/{id}/show','CommentController@show');
Route::post('comment/{id}/update','CommentController@update')->middleware('auth:api');
Route::post('comment/{id}/remove','CommentController@remove')->middleware('auth:api');
/**********************************   Comment Route Ends Here   *******************************************/

/**********************************   Author Route Starts Here   *******************************************/
Route::get('authors','AuthorController@index')->middleware('auth:api');
Route::post('author/check/name','AuthorController@checkName');
Route::post('register','AuthorController@register');
Route::post('login','AuthorController@login');
Route::post('logout','AuthorController@logout')->middleware('auth:api');
/**********************************   Author Route Ends Here   *******************************************/