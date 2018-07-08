<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number', 20)->comment('订单编号');
            $table->string('express_number', 20)->nullable()->comment('物流单号');
            $table->string('reveiver_name', 20)->comment('收货人姓名');
            $table->string('reveiver_number', 12)->comment('收货人联系电话');
            $table->string('reveiver_address', 120)->comment('收货地址');
            $table->unsignedInteger('wechat_user_id')->comment('客户id');
            $table->tinyInteger('order_status')->default(1)->comment('订单状态 0已取消 1新订单 2待发货 3已发货 4待收货 5已完成');
            $table->decimal('total_price', 10, 2)->comment('订单总价');
            $table->decimal('commodity_price', 10, 2)->comment('商品总价');
            $table->decimal('express_price', 10, 2)->comment('物流总价');
            $table->decimal('preferential_price', 10, 2)->comment('优惠减免价格');
            $table->decimal('pay_amount', 10, 2)->comment('实际支付价格');
            $table->timestamp('payed_at')->comment('支付时间');
            $table->tinyInteger('pay_status')->default(1)->comment('支付状态: 1未支付 2已支付');
            $table->string('remark')->nullable()->comment('客户备注');
            $table->unsignedInteger('staff_id')->nullable()->comment('操作员工ID');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->unsignedInteger('commodity_id')->comment('商品id');
            $table->string('name')->comment('商品名称');
            $table->decimal('price', 10, 2)->comment('商品单价');
            $table->decimal('express_price', 10, 2)->comment('物流费用'); 
            $table->integer('buy_amount')->comment('购买数量'); 
            $table->string('img')->nullable()->comment('商品图片');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
    }
}
