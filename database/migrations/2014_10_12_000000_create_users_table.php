<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('banner')->nullable();
            $table->integer('gender')->default(0);
            $table->date('birthday');
            $table->text('province')->nullable();
            $table->text('city')->nullable();
            $table->text('district')->nullable();
            $table->text('location')->nullable();
            $table->integer('blood_type')->default(0);
            $table->text('brief')->nullable();
            $table->text('detail')->nullable();
            $table->string('domain')->nullable();
            $table->string('qq')->nullable();
            $table->string('wechat')->nullable();
            $table->string('weibo')->nullable();
            $table->string('phone')->nullable();
            $table->text('education')->nullable();
            $table->text('work')->nullable();
            $table->integer('login')->default(0);
            $table->string('last_login_time')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
