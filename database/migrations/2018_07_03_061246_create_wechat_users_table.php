<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name')->comment('微信昵称');
            $table->string('avatar_url')->comment('微信头像');
            $table->string('open_id')->comment('微信open_id');
            $table->string('country', 20)->nullable()->comment('国家');
            $table->string('province', 20)->nullable()->comment('省份');
            $table->string('city', 20)->nullable()->comment('城市');
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
        Schema::dropIfExists('wechat_users');
    }
}
