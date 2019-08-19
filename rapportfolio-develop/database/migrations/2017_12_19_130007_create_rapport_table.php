<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapport', function (Blueprint $table) {
            $table->increments('rapportid');
            $table->string('naam');
            $table->integer('leerlingid')->unsigned();
            $table->integer('groepid')->unsigned();
            $table->foreign('leerlingid')->references('leerlingid')->on('leerling')->onDelete('cascade');
            $table->foreign('groepid')->references('groepid')->on('groep')->onDelete('cascade');
            $table->string('jaar', 10);
            $table->string('notitie', 1000)->nullable();
            $table->string('notitie_leerling', 1000)->nullable();
            $table->string('ouder_bekeken', 75);
            $table->string('leerling_bekeken', 75);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapport');
    }
}
