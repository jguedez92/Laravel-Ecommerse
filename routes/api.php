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
    Route::post('/uploadPassword', 'UserController@updatePassword');
    Route::get('/confirmation/{code}', 'UserController@confirmation');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'UserController@logout');
        Route::get('/getByAuth', 'UserController@getByAuth');
        Route::get('/{id}', 'UserController@getById');
        Route::post('/uploadImgProfile', 'UserController@uploadImgProfile');
        Route::post('/uploadImgDni', 'UserController@uploadImgDni');
        Route::post('/uploadImgLicense', 'UserController@uploadImgLicense');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@delete');
    });
});
Route::prefix('categories')->group(function () {
    Route::get('', 'CategoryController@getAll');
    Route::middleware('auth:api')->group(function () {
        Route::post('/insert', 'CategoryController@insert');
        Route::put('{id}', 'CategoryController@update');
        Route::delete('{id}', 'CategoryController@delete');
    });
});
Route::prefix('products')->group(function () {
    Route::get('', 'ProductController@getAll');
    Route::middleware('auth:api')->group(function () {
        Route::get('/getByUserId', 'ProductController@getProductsByUserId');
        Route::post('/insert', 'ProductController@insert');
        Route::post('/uploadImage/{product_id}', 'ProductController@uploadImage');
        Route::post('/img_1/{id}', 'ProductController@uploadImg1');
        Route::post('/img_2/{id}', 'ProductController@uploadImg2');
        Route::post('/img_3/{id}', 'ProductController@uploadImg3');
        Route::post('/img_4/{id}', 'ProductController@uploadImg4');
        Route::post('/img_pc/{id}', 'ProductController@uploadPermitConduction');
        Route::put('{product_id}', 'ProductController@update');
        Route::delete('{product_id}', 'ProductController@delete');
    });
});
Route::prefix('orders')->group(function () {
    Route::get('', 'OrderController@getAll');
    Route::middleware('auth:api')->group(function () {
        Route::get('/get', 'OrderController@getForUserId');
        Route::post('/insert', 'OrderController@insert');
        Route::put('/{id}', 'OrderController@update');
        Route::post('/enable', 'OrderController@enable');
    });
});
