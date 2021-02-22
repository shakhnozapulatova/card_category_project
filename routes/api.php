<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::resource('category', \App\Http\Controllers\CategoriesController::class);
    Route::resource('products', \App\Http\Controllers\ProductsController::class);\
    Route::resource('product-attributes-option', \App\Http\Controllers\AttributeOptionsController::class)
        ->only( 'index');

    Route::post('product-data/{product}', [App\Http\Controllers\ProductDataController::class, 'store'])
        ->name('product-data.store');

    Route::put('product-data/{product}', [App\Http\Controllers\ProductDataController::class, 'update'])
        ->name('product-data.update');

    Route::post('import-products', [App\Http\Controllers\ProductsImportController::class, 'import'])
        ->name('import.products');
});
