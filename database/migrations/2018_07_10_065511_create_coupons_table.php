<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->comment('优惠券说明');
            $table->tinyInteger('type')->comment('优惠券类型 1表示满减 2无门槛使用');
            $table->decimal('limit_money', 10, 2)->nullable()->comment('满减类型 金额限制门槛');
            $table->decimal('preferential_amount', 10, 2)->comment('优惠额度');
            $table->datetime('dead_line')->nullable()->default(NULL)->comment('截止时间');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('coupon_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->decimal('preferential_amount', 10, 2)->comment('优惠额度');
            $table->unsignedInteger('coupon_user_id')->comment('客户已领优惠券id'); 
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('coupon_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wechat_user_id')->comment('客户id');
            $table->unsignedInteger('coupon_id')->comment('优惠券id');
            $table->tinyInteger('is_use')->default(1)->comment('是否已使用 1未使用 2已使用');
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
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('coupon_logs');
        Schema::dropIfExists('coupon_users');
    }
}
