<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataRowsSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    // Create table for storing roles
	    Schema::table('data_rows', function (Blueprint $table) {
		    $table->boolean('search')->default(true);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    // Create table for storing roles
	    Schema::table('data_rows', function (Blueprint $table) {
		    $table->dropColumn('search');
	    });
    }
}
