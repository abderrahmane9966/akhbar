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

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('comments', 'Api\CommentController@index');
Route::get('comments/post/{id}', 'Api\CommentController@show');


Route::get('categories', 'Api\CategoryController@index');

Route::get('categories/{id}/posts', 'Api\PostController@postsByCategory');
Route::get('posts', 'Api\PostController@index');
Route::get('posts/{id}', 'Api\PostController@show');

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('comments/post/{id}', 'Api\CommentController@store');
    Route::post('votes/post/{id}', 'Api\PostController@votes');
    Route::post('addImage', 'Api\ImageController@store');
    Route::get('userImage', 'Api\ImageController@show');
});
