<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIniciativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iniciativas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('justify');
            $table->text('objetive');
            $table->string('area');
            $table->string('responsable');
            $table->string('coresponsable');
            $table->integer('status');
            $table->timestamps();
            $table->integer('componente_id')->unsigned()->nullable();
            $table->foreign('componente_id')->references('id')
                ->on('componentes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iniciativas');
    }
}