<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id')->comment('The game id');
            $table->string('name')->comment('The game name');
            $table->text('description')->comment('The game description');
            $table->string('hash')->nullable();

            $table->integer('hall_of_fame_id')->unsigned()->nullable();
            $table->timestamps();


        });

        Schema::table('games', function($table) {
          $table->foreign('hall_of_fame_id')->references('id')->on('hall_of_fame');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
