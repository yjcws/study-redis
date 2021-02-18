<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/","ProductController@index")->name("product.index");

Route::get("products/{product}","ProductController@show")->name("product.show");
Route::post('seckill_orders', 'ProductController@seckill')->name('seckill_orders.store');
Route::get('seckill_product', 'ProductController@llen');
Route::get('seckill_add', 'ProductController@addseckill');