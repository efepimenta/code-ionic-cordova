<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.checkrole:admin'], function () {

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'ClientsController@store']);
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'CategoriesController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'CategoriesController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CategoriesController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'CategoriesController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'CategoriesController@store']);
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ProductsController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ProductsController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'ProductsController@store']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'ProductsController@destroy']);
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'OrdersController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'OrdersController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'OrdersController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'OrdersController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'OrdersController@store']);
    });

    Route::group(['prefix' => 'cupoms', 'as' => 'cupoms.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'CupomsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'CupomsController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CupomsController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'CupomsController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'CupomsController@store']);
    });

});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => 'auth.checkrole:client'], function () {

    Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => 'auth.checkrole:client'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'CheckoutController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'CheckoutController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CheckoutController@store']);
    });

});

Route::group(['middleware' => 'cors'], function () {

    Route::post('oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'oauth'], function () {

        Route::get('authenticated', ['as' => 'authenticated', 'uses' => 'UsersController@show']);

        Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => 'oauth.checkrole:client'], function () {
            Route::resource('order', 'Api\Client\ClientCheckoutController', ['except' => ['create', 'edit', 'update', 'destroy']]);
            Route::get('products', 'Api\Client\ClientProductController@index');
        });

        Route::group(['prefix' => 'deliveryman', 'as' => 'deliveryman.', 'middleware' => 'oauth.checkrole:deliveryman'], function () {
            Route::resource('order', 'Api\Deliveryman\DeliverymanCheckoutController', ['except' => ['create', 'edit', 'destroy']]);
            Route::patch('order/{id}/update-status', ['as' => 'update-status', 'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus']);
        });

    });
});