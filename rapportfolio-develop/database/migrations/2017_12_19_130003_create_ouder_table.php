<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOuderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouder', function (Blueprint $table) {
            $table->increments('ouderid');
            $table->integer('userid')->unsigned();
            $table->string('voornaam',45);
            $table->string('tussenvoegsel', 10)->nullable();
            $table->string('achternaam',45);
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouder');
    }
}
