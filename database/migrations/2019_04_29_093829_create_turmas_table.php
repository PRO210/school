<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TURMA');
            $table->string('TURMA_EXTRA');
            $table->string('CATEGORIA');
            $table->string('TURNO');
            $table->string('UNICO');
            $table->string('STATUS');
            $table->date('ANO');
            $table->integer('TURMA_IDADE');          
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
        Schema::dropIfExists('turmas');
    }
}
