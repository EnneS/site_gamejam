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
            $table->string('login')->unique()->comment('The student login');
            $table->string('first_name')->comment('The student first name');
            $table->string('last_name')->comment('The student last name');
            $table->integer('team_id')->unsigned()->nullable();
            $table->integer('admin')->unsigned()->nullable()->default(0);

            $table->string('remember_token', 256)->nullable()->comment('The remember token to keep logged');

            $table->timestamps();
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
