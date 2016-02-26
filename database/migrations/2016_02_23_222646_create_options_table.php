<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('display_name')->nullable();
            $table->string('input')->nullable();
            $table->string('description')->nullable();
            $table->string('weight')->default(0);
            $table->integer('deletable')->default(1);
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
        Schema::drop('options');
    }
}
