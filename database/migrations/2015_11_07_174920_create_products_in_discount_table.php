<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsInDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("products_in_discount", function(Blueprint $table)
        {
            $table->increments('id')->comment('主键编号');
            $table->unsignedInteger('discount_info_id')->comment('打折信息编号');
            $table->unsignedInteger('product_id')->comment('参加折扣活动的商品编号');
            $table->timestamps();

            $table->foreign("discount_info_id")->references("id")->on("discount_info");
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('products_in_discount');
    }
}
