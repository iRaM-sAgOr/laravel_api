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

//list articles
Route::get('articles','ArticleController@index');
//..here articles is the adress that we will put in the url
//.ArticleController is the controller name and 
//index is the method od the controller

//list single article
Route::get('article/{id}','ArticleController@show');

//create new article
Route::post('article','ArticleController@store');

//Update article
Route::put('articles','ArticleController@store');

//Delete articles
Route::delete('articles','ArticleController@destroy');


/////////////////////////////another routing api .......
Route::post('submit','ncr_tool_db_controller@store');
Route::get('show_items','ncr_tool_db_controller@show');