<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowColumnToDataRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('data_rows', function (Blueprint $table) {
		    $table->integer('show')->default(0)->after('delete');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('data_rows', function (Blueprint $table) {
		    $table->dropColumn('show');
	    });
    }
}
