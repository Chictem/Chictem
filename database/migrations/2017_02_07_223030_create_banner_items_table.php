<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannerItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->integer('banner_id')->unsigned();
            $table->text('description');
            $table->string('url', 255);
            $table->string('image', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('banner_id')->references('id')->on('banners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banner_items');
    }
}
