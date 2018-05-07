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

Route::get('/oss', function()
{
    $client = App::make('aliyun-oss');
    $client->putObject("lavarel-eleb", "1.txt", "hello");
    $result = $client->getObject("lavarel-eleb", "1.txt");
    echo $result;
});

//图片上传
Route::post('/foodAdd','UploadController@food');
Route::post('/businessListAdd','UploadController@business');

//订单管理
Route::resource('order','OrderController');
//Route::get('sale','OrderController@sale')->name('sale');

Route::get('orders','OrderController@orders')->name('orders');
Route::post('everyOrder','OrderController@everyOrder')->name('everyOrder');
Route::post('refuse','OrderController@refuse')->name('refuse');

//抽奖活动报名
Route::get('eventBusiness','EventBusinessController@index')->name('eventBusiness');
Route::get('eventShow/{eventShow}','EventBusinessController@show')->name('eventShow');
Route::post('eventBusiness','EventBusinessController@store')->name('eventBusinessSave');
Route::get('prizeBusiness','EventBusinessController@prize')->name('prizeBusiness');
//Route::resource('eventBusiness','EventBusinessController');
