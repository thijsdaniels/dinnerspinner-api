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

Route::resource('/users', 'UserController');
Route::resource('/recipes', 'RecipeController');
Route::resource('/ingredients', 'IngredientController');

Route::group([
    'prefix' => '/users/{username}',
    'namespace' => 'User',
], function () {
    Route::resource('/recipes', 'RecipeController');
    Route::resource('/selections', 'SelectionController');
    Route::resource('/requirements', 'RequirementController');
});