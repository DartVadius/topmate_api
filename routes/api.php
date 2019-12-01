<?php

use Illuminate\Http\Request;
Route::group([
    'namespace' => 'API',
], function(){
    # public routes
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    # authorized routes
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'UserController@user');
        # admin routes
        Route::group(['middleware' => 'checkRole:admin'], function(){
            Route::resource('faq', 'FaqController')->except([
                'create', 'edit'
            ]);
            # calculator routes
            Route::post('calculator/models', 'CalculatorController@createModel');
            Route::post('calculator/parts', 'CalculatorController@createPart');
            Route::patch('calculator/models/{model_id}', 'CalculatorController@updateModel');
            Route::patch('calculator/parts/{part_id}', 'CalculatorController@updatePart');
            Route::delete('calculator/models/{model_id}', 'CalculatorController@deleteModel');
            Route::delete('calculator/parts/{part_id}', 'CalculatorController@deletePart');
            Route::get('calculator/models', 'CalculatorController@getModels');
            Route::get('calculator/parts', 'CalculatorController@getParts');
            Route::post('calculator/models/{car_model_id}/parts/{car_part_id}', 'CalculatorController@attach');
            Route::delete('calculator/models/{car_model_id}/parts/{car_part_id}', 'CalculatorController@detach');
            Route::get('calculator/models/{car_model_id}/parts/{car_part_id}', 'CalculatorController@calculate');
        });
    });
});

