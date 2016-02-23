<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index();
            $table->integer('kind')->default(1);
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('alias');
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->string('thumb')->nullable();
            $table->string('banner')->nullable();
            $table->integer('user_id')->index();
            $table->string('source_link')->nullable();
            $table->string('source_name')->nullable();
            $table->string('external_link')->nullalbe();
            $table->integer('secret')->default(0);
            $table->string('password')->nullable();
            $table->integer('allow_comment')->default(1);
            $table->integer('allow_reprint')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contents');
    }
}
