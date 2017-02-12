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
			$table->string('name');
			$table->integer('banner_id')->nullable()->unsigned();
			$table->text('description')->nullable();
			$table->string('url')->nullable();
			$table->string('image')->nullable();
			$table->string('image_url')->nullable();
			$table->integer('parent_id')->nullable();
			$table->integer('order')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('banner_id')->references('id')->on('banners')->onUpdate('cascade')->onDelete('cascade');
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
