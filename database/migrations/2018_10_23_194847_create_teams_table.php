<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('The team name');
            $table->integer('game_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned()->nullable();
        });

        Schema::table('teams', function($table) {
          $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');;
          $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
