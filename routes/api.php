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
            Route::post('calculator/model', 'CalculatorController@createModel');
            Route::post('calculator/part', 'CalculatorController@createPart');
            Route::patch('calculator/model/{model_id}', 'CalculatorController@updateModel');
            Route::patch('calculator/part/{part_id}', 'CalculatorController@updatePart');
            Route::delete('calculator/model/{model_id}', 'CalculatorController@deleteModel');
            Route::delete('calculator/part/{part_id}', 'CalculatorController@deletePart');
            Route::get('calculator/models', 'CalculatorController@getModels');
            Route::get('calculator/parts', 'CalculatorController@getParts');
            Route::post('calculator/models/{car_model_id}/parts/{car_part_id}', 'CalculatorController@update');
            Route::get('calculator/models/{car_model_id}/parts/{car_part_id}', 'CalculatorController@calculate');
        });
    });
});

