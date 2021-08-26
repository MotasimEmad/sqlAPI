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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Api'], function(){

    Route::get('authors', 'AuthorController@authors');
    Route::post('author', 'AuthorController@addAuthor');
    Route::put('author/{id}', 'AuthorController@updateAuthor');
    Route::delete('authors/{id}', 'AuthorController@deleteAuthor');
    /////////////////////////////////////////////////////////////////
    Route::get('books', 'BookController@books');
    Route::get('books/{author}', 'BookController@authorBooks');
    Route::post('book', 'BookController@addBook');
    Route::put('book/{id}', 'BookController@updateBook');
    Route::delete('books/{id}', 'BookController@deleteBook');

});