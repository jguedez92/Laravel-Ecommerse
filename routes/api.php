<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::get('/getAll', 'UserController@getAll');
    Route::get('/confirmation/{code}', 'UserController@confirmation');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'UserController@logout');
        Route::get('/{id}', 'UserController@getById');
        Route::post('/uploadImage', 'UserController@uploadImage');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@delete');
    });
});
Route::prefix('categories')->group(function () {
    Route::get('', 'CategoryController@getAll');
    Route::middleware('auth:api')->group(function () {
        Route::post('/register', 'CategoryController@insert');
        Route::put('{id}', 'CategoryController@update');
        Route::delete('{id}', 'CategoryController@delete');
    });
});
Route::prefix('products')->group(function () {
    Route::get('', 'ProductController@getAll');
    Route::middleware('auth:api')->group(function () {
        Route::get('/getByUserId', 'ProductController@getProductsByUserId');
        Route::post('/register', 'ProductController@insert');
        Route::post('/uploadImage/{product_id}', 'ProductController@uploadImage');
        Route::put('{product_id}', 'ProductController@update');
        Route::delete('{product_id}', 'ProductController@delete');
    });
});
Route::prefix('orders')->group(function () {
    Route::get('', 'OrderController@getAll');
    Route::get('/{id}', 'OrderController@getForUserId');

    Route::middleware('auth:api')->group(function () {
        Route::post('/register', 'OrderController@insert');
        Route::put('{id}', 'OrderController@update');
    });
});
