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
    // 微信粉丝管理
    $router::get('/fans', ['as'=>'fans', 'uses'=>'FansController@index']);
    $router::get('/fansReportForm', ['as'=>'fansReportForm', 'uses'=>'FansController@report']);
    // 商品管理
    $router::get('/commodities', ['as'=>'commodities', 'uses'=>'CommodityController@index']);
    $router::get('/commodityAdd', ['as'=>'commodityAdd', 'uses'=>'CommodityController@add']);
    $router::post('/commodityStore', ['as'=>'commodityStore', 'uses'=>'CommodityController@store']);
    $router::post('/commodityUpdate', ['as'=>'commodityUpdate', 'uses'=>'CommodityController@update']);
    $router::get('/commodityDelete/{id}', ['as'=>'commodityDelete', 'uses'=>'CommodityController@delete']);
    $router::get('/commoditySearch', ['as'=>'commoditySearch', 'uses'=>'CommodityController@search']);
    // 商品类别管理
    $router::get('/commodityTypes', ['as'=>'commodityTypes', 'uses'=>'CommodityTypesController@index']);
    $router::get('/commodityTypesAdd', ['as'=>'commodityTypesAdd', 'uses'=>'CommodityTypesController@add']);
    $router::post('/commodityTypesStore', ['as'=>'commodityTypesStore', 'uses'=>'CommodityTypesController@store']);
    $router::get('/commodityTypesDelete/{id}', ['as'=>'commodityTypesDelete', 'uses'=>'CommodityTypesController@delete']);
    $router::post('/commodityTypesUpdate', ['as'=>'commodityTypesUpdate', 'uses'=>'CommodityTypesController@update']);
    // 活动管理
    $router::get('/activities', ['as'=>'activities', 'uses'=>'ActivityController@index']);
    $router::get('/activitiesAdd', ['as'=>'activitiesAdd', 'uses'=>'ActivityController@add']);
    $router::post('/activitiesStore', ['as'=>'activitiesStore', 'uses'=>'ActivityController@store']);
    $router::get('/activitiesDelete/{id}', ['as'=>'activitiesDelete', 'uses'=>'ActivityController@delete']);
    $router::post('/activitiesUpdate', ['as'=>'activitiesUpdate', 'uses'=>'ActivityController@update']);
    $router::get('/getActivities', ['as'=>'getActivities', 'uses'=>'ActivityController@getActivities']);
    $router::post('/addCommodityToActivity', ['as'=>'addCommodityToActivity', 'uses'=>'ActivityController@addCommodityToActivity']);
    $router::get('/getActivityCommodities/{id}', ['as'=>'getActivityCommodities', 'uses'=>'ActivityController@getActivityCommodities']);
    $router::get('/deleteActivityCommodities/{id}', ['as'=>'deleteActivityCommodities', 'uses'=>'ActivityController@deleteActivityCommodities']);
    $router::post('/updateActivityCommodities', ['as'=>'updateActivityCommodities', 'uses'=>'ActivityController@updateActivityCommodities']);
    // 订单管理
    $router::get('/orders', ['as'=>'orders', 'uses'=>'OrderController@index']);
    $router::post('/updateReceiverInfo', ['as'=>'updateReceiverInfo', 'uses'=>'OrderController@updateReceiverInfo']);
    $router::post('/setDelivery', ['as'=>'setDelivery', 'uses'=>'OrderController@setDelivery']);
    // 优惠券管理
    $router::get('/coupons', ['as'=>'coupons', 'uses'=>'CouponController@index']);
    $router::get('/couponAdd', ['as'=>'couponAdd', 'uses'=>'CouponController@add']);
    $router::post('/couponStore', ['as'=>'couponStore', 'uses'=>'CouponController@store']);
    $router::get('/couponDelete/{id}', ['as'=>'couponDelete', 'uses'=>'CouponController@delete']);
    $router::post('/couponUpdate', ['as'=>'couponUpdate', 'uses'=>'CouponController@update']);
    $router::post('/couponCheck', ['as'=>'couponCheck', 'uses'=>'CouponController@check']);
});

