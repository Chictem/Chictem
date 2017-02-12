<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('courses', function (Blueprint $table) {
		    $table->integer('teacher_id')->unsigned()->after('category_id')->nullable();
		    $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
		    $table->integer('company_id')->unsigned()->after('category_id')->nullable();
		    $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
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
		    $table->dropColumn('teacher_id');
		    $table->dropColumn('company_id');
	    });
    }
}
