<?php

use Illuminate\Http\Request;

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

/* 无需认证的接口 */
Route::group([
        'namespace' => 'Api',
    ], function ($router)
{
    // 获取商品信息
    $router::get('/getCommodities', ['as'=>'getCommodities', 'uses'=>'CommodityController@index']);
});

/* 需要认证的用户交互接口 */
Route::group([
        'namespace' => 'Api',
        'middleware' => 'wechatAuth'
    ], function ($router)
{

});
