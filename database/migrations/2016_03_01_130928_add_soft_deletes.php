<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('contents', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('options', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('password_resets', function (Blueprint $table) {
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
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
