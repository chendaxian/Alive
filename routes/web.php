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

// 微信秒杀
Route::group([
        'namespace' => 'Client', 
    ], function ($router)
{
    $router::get('/seckill', 'SecKillController@index');
    $router::post('/formSubmit', 'SecKillController@formSubmit');
});

// 工作台
Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin', 
        'middleware' => 'auth'
    ], function ($router)
{
    // 后台首页
    $router::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);
    // 秒杀商品管理
    $router::get('/commodities', ['as'=>'commodities', 'uses'=>'CommodityController@index']);
});

