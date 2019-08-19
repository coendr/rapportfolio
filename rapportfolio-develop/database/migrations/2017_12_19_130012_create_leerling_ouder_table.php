<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeerlingOuderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leerling_ouder', function (Blueprint $table) {
            $table->increments('leerling_ouderid');
            $table->integer('leerlingid')->unsigned();
            $table->integer('ouderid')->unsigned();
            $table->foreign('leerlingid')->references('leerlingid')->on('leerling')->onDelete('cascade');
            $table->foreign('ouderid')->references('ouderid')->on('ouder')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leerling_ouder');
    }
}
