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
        });
    });
});

