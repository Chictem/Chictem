<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnsOfBannerItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('banner_items', function (Blueprint $table) {
			$table->integer('parent_id')->nullable();
			$table->integer('order')->nullable();
			$table->text('description')->nullable()->change();
			$table->string('url', 255)->nullable()->change();
			$table->string('image', 255)->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('banner_items', function (Blueprint $table) {
			$table->dropColumn('parent_id');
			$table->dropColumn('order');
			$table->text('description')->change();
			$table->string('url', 255)->change();
			$table->string('image', 255)->change();
		});
	}
}
