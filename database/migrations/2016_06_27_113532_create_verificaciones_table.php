<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('file');
            $table->integer('iniciativa_id')->unsigned()->nullable();
            $table->foreign('iniciativa_id')->references('id')
                ->on('iniciativas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('verificaciones');
    }
}
