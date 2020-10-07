<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::get('/posts', 'WelcomeController@index');
    Route::get('/posts/show/{id}', 'WelcomeController@show');
    Route::get('/posts/category/{category_id}', 'WelcomeController@byCategory');
    Route::get('/posts/user/{user_id}', 'WelcomeController@byAuthor');
});

/*
 * Rotas privadas
 */
Route::group(['namespace' => 'Api', 'middleware' => ['auth:api']], function () {
    Route::get("/categories", "CategoryController@index");
    Route::post("/categories", "CategoryController@store");
    Route::get("/categories/{id}", "CategoryController@edit");
    Route::put("/categories/{id}/update", "CategoryController@update");
    Route::delete("/categories/{id}", "CategoryController@destroy");
});
