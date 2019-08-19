<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeoordelingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beoordeling', function (Blueprint $table) {
            $table->increments('beoordelingid');
            $table->integer('rapportid')->unsigned();
            $table->integer('vakid')->unsigned();
            $table->string('cijfer', 3);
            $table->foreign('rapportid')->references('rapportid')->on('rapport')->onDelete('cascade');
            $table->foreign('vakid')->references('vakid')->on('vak')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beoordeling_leerkracht');
    }
}
