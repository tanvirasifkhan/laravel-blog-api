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
/**********************************   Article Route Ends Here   *******************************************/