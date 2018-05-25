<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('商品标题');
            $table->decimal('original_price', 10, 2)->comment('商品原价');
            $table->decimal('present_price', 10, 2)->comment('商品秒杀价'); 
            $table->decimal('express_price', 10, 2)->comment('物流费用'); 
            $table->integer('sale_amounts')->comment('销量'); 
            $table->string('location')->comment('发货地点');
            $table->tinyInteger('is_shelves')->default(0)->comment('是否上架 0未上架 1已上架');
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
        Schema::dropIfExists('commodity');
    }
}
