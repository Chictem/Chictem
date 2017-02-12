<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCoursesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('courses', function (Blueprint $table) {
		    $table->string('image')->after('description');
		    $table->integer('category_id')->unsigned()->after('url')->nullable();
		    $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
		    $table->integer('weight')->after('url');
		    $table->string('duration')->after('url');
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
		    $table->dropColumn('image');
		    $table->dropColumn('category_id');
		    $table->dropColumn('weight');
		    $table->dropColumn('duration');
	    });
    }
}
