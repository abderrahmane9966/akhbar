<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//Route::middleware(['auth', 'user_is_admin'])->get('test-admin', function () {
//  return  'HELLO';
//});

Route::group(['middleware' => 'user_is_admin'], function () {


    // Category
    Route::resource('categories', 'CategoryController');
    Route::post('search-categories', 'CategoryController@search')->name('search-categories');


    // Post
    Route::resource('posts', 'PostController');
    Route::post('search-posts', 'PostController@search')->name('search-posts');


    //Role
    Route::resource('roles', 'RoleController');


    //Comment
    Route::resource('comments', 'CommentController');
});
