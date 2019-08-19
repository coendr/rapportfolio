<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReflectieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reflectie', function (Blueprint $table) {
            $table->increments('reflectieid');
            $table->integer('rapportid')->unsigned();
            $table->integer('knapid')->unsigned();
            $table->string('kind', 45)->nullable();
            $table->string('leerkracht', 45)->nullable();
            $table->foreign('rapportid')->references('rapportid')->on('rapport')->onDelete('cascade');
            $table->foreign('knapid')->references('knapid')->on('knap')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reflectie');
    }
}
