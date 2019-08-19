<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeerlingOuderPendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leerling_ouder_pending', function (Blueprint $table) {
            $table->increments('leerling_ouder_pendingid');
            $table->integer('leerlingid')->unsigned();
            $table->integer('ouderid')->unsigned();
            $table->integer('groepid')->unsigned();
            $table->foreign('leerlingid')->references('leerlingid')->on('leerling')->onDelete('cascade');
            $table->foreign('ouderid')->references('ouderid')->on('ouder')->onDelete('cascade');
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
        Schema::dropIfExists('leerling_ouder_pending');
    }
}
