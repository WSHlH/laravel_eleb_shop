<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('food_name');
            $table->string('food_image');
            $table->unsignedDecimal('price');
            $table->unsignedInteger('sales');
            $table->string('praise');
            $table->unsignedInteger('food_categories_id');
            $table->unsignedInteger('replies_id');
            $table->string('description');
            $table->foreign('food_categories_id')->references('id')->on('food_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
