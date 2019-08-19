<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeerkrachtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leerkracht', function (Blueprint $table) {
            $table->increments('leerkrachtid');
            $table->integer('userid')->unsigned();
            $table->string('voornaam',45);
            $table->string('tussenvoegsel', 10)->nullable();
            $table->string('achternaam',45);
            $table->integer('groepid')->unsigned();
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
        Schema::dropIfExists('leerkracht');
    }
}
