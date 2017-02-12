<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('courses', function (Blueprint $table) {
		    $table->string('banner')->after('image');
	    });
	    Schema::table('pages', function (Blueprint $table) {
		    $table->string('banner')->after('image');
	    });
	    Schema::table('posts', function (Blueprint $table) {
		    $table->string('banner')->after('image');
	    });
	    Schema::table('categories', function (Blueprint $table) {
		    $table->string('banner')->before('slug');
	    });
	    Schema::table('companies', function (Blueprint $table) {
		    $table->string('banner')->after('image');
	    });
	    Schema::table('users', function (Blueprint $table) {
		    $table->string('banner')->after('avatar');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('courses', function (Blueprint $table) {
		    $table->dropColumn('banner');
	    });
	    Schema::table('pages', function (Blueprint $table) {
		    $table->dropColumn('banner');
	    });
	    Schema::table('posts', function (Blueprint $table) {
		    $table->dropColumn('banner');
	    });
	    Schema::table('categories', function (Blueprint $table) {
		    $table->dropColumn('banner');
	    });
	    Schema::table('companies', function (Blueprint $table) {
		    $table->dropColumn('banner');
	    });
	    Schema::table('users', function (Blueprint $table) {
		    $table->dropColumn('banner');
	    });
    }
}
