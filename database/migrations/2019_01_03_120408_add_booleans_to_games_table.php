<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBooleansToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
          $table->boolean('zip_uploaded')->default(0)->comment('Determins if the game zip has been uploaded or not');
          $table->boolean('jaquette_uploaded')->default(0)->comment('Determins if the game jaquette has been uploaded or not');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
}
