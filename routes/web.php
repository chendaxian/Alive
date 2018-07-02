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
Auth::routes();

// 工作台
Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin', 
        'middleware' => 'auth'
    ], function ($router)
{
    // 后台首页
    $router::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);
    // 商品管理
    $router::get('/commodities', ['as'=>'commodities', 'uses'=>'CommodityController@index']);
    $router::get('/commodityAdd', ['as'=>'commodityAdd', 'uses'=>'CommodityController@add']);
    $router::post('/commodityStore', ['as'=>'commodityStore', 'uses'=>'CommodityController@store']);
    $router::post('/commodityUpdate', ['as'=>'commodityUpdate', 'uses'=>'CommodityController@update']);
    $router::get('/commodityDelete/{id}', ['as'=>'commodityDelete', 'uses'=>'CommodityController@delete']);
});

