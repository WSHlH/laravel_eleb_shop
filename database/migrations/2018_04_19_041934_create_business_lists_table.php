<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->unsignedTinyInteger('brand');
            $table->unsignedTinyInteger('on_time');
            $table->unsignedTinyInteger('humming');
            $table->unsignedTinyInteger('promise');
            $table->unsignedTinyInteger('invoice');
            $table->unsignedDecimal('start_send');
            $table->unsignedDecimal('send_cost');
            $table->unsignedInteger('estimate_time');
            $table->string('notice');
            $table->string('discount');
            $table->tinyInteger('is_examine');
            $table->timestamps();
            $table->engine='InnoDB';
            /**
             * "id": "s10001",
             * "shop_name": "上沙麦当劳",
             * "shop_img": "http://www.homework.com/images/shop-logo.png",
             * "shop_rating": 4.7,评分
             * "brand": true,是否是品牌
             * "on_time": true,是否准时送达
             * "fengniao": true,是否蜂鸟配送
             * "bao": true,是否保标记
             * "piao": true,是否票标记
             * "zhun": true,是否准标记
             * "start_send": 20,起送金额
             * "send_cost": 5,配送费
             * "estimate_time": 30,预计时间
             * "notice": "新店开张，优惠大酬宾！",店公告
             * "discount": "新用户有巨额优惠！"优惠信息
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_lists');
    }
}
