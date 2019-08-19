<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeerlingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leerling', function (Blueprint $table) {
            $table->increments('leerlingid');
            $table->integer('userid')->unsigned();
            $table->string('voornaam', 45);
            $table->string('tussenvoegsel', 10)->nullable();
            $table->string('achternaam', 45);
            $table->integer('groepid')->unsigned()->nullable();
            $table->date('start_datum')->nullable();
            $table->date('eind_datum')->nullable();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('groepid')->references('groepid')->on('groep')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leerling');
    }
}
