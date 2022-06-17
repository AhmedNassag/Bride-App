<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('socials',  function(Blueprint $table)
        {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('phones',  function(Blueprint $table)
        {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });


        Schema::table('packages',  function(Blueprint $table)
        {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('galleries',  function(Blueprint $table)
        {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('galleries',  function(Blueprint $table)
        {
            $table->foreign('package_id')
            ->references('id')
            ->on('packages')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('locations',  function(Blueprint $table)
        {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('locations',  function(Blueprint $table)
        {
            $table->foreign('area_id')
            ->references('id')
            ->on('areas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('locations',  function(Blueprint $table)
        {
            $table->foreign('city_id')
            ->references('id')
            ->on('cities')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
