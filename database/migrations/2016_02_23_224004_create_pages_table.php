<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('alias');
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->string('thumb')->nullable();
            $table->string('banner')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('source_link')->nullable();
            $table->string('source_name')->nullable();
            $table->integer('secret')->default(0);
            $table->string('password')->nullable();
            $table->integer('allow_comment')->default(1);
            $table->integer('weight')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
