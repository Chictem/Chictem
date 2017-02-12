<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
	        $table->string('image')->nullable();
	        $table->string('banner')->nullable();
	        $table->integer('user_id')->nullable()->unsigned();
	        $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
	        $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
    }
}
