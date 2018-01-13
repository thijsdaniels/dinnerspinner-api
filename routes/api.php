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

Route::group([
    'prefix' => '/v1',
    'namespace' => 'V1'
], function () {
    Route::resource('/users', 'UserController');
    Route::resource('/ingredients', 'IngredientController');

    Route::group([
        'prefix' => '/users/{username}',
        'namespace' => 'User',
    ], function () {
        Route::resource('/recipes', 'RecipeController');
        Route::resource('/selections', 'SelectionController');

        Route::group([
            'prefix' => '/recipes/{recipeId}',
            'namespace' => 'Recipe',
        ], function () {
            Route::resource('/requirements', 'RequirementController');
            Route::resource('/steps', 'StepController');
        });
    });
});
