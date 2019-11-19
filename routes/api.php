<?php

use Illuminate\Http\Request;
Route::group(['namespace' => 'API'], function(){
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'UserController@user');
    });
});

