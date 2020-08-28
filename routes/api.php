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
/**********************************   Category Route Ends Here   *******************************************/
