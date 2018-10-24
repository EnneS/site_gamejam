<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id')->comment('The student id');
            $table->string('first_name')->comment('The student first name');
            $table->string('last_name')->comment('The student last name');
            $table->string('email')->unique()->comment('The student email');
            $table->integer('team_id')->unsigned()->nullable();
        });

        Schema::table('students', function($table) {
          $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
