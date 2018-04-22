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

//Route::get('/', function () {
//    return view('welcome');
//});

//店铺账号表
Route::resource('business','BusinessController');
//店铺信息表
Route::resource('businessList','BusinessListController');

//店铺登录与退出
Route::get('login','LoginController@show')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::delete('logout','LoginController@destroy')->name('logout');

//食品路由
Route::resource('food','FoodController');

//添加食品分类
Route::resource('foodCategory','FoodCategoryController');