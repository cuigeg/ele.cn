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



//进入根模块
Route::get('/', function () {
    return view('/home/index');
});


//进入前台主页，帮助，今日推进页面
Route::controller('/home','home\PageController');

Route::controller('/admin','admin\ContController');

//中间件控制进入用户中心
Route::group(['middleware' =>'Person'],function(){
    //进入用户个人中心模块
	Route::controller('/personal','home\PersonalController');
});

//进入前台商家模块
Route::controller('/shop','home\ShopController');

//进入前台订单模块
Route::controller('/order','home\OrderController');

// 进入前台登录注册模块
Route::controller('/auth', 'Auth\AuthController');

//进入总后台隐式路由
Route::controller('/admin','admin\ContController');

//进入商家后台隐式路由
Route::controller('/adminshop','adminshop\ShopController');

	// Route::group(['middleware' => 'login'], function () {
	//     Route::controller('/adminshop','adminshop\ShopController');

	// });
	
Route::controller('/admins','adminshop\ShoploginController');

