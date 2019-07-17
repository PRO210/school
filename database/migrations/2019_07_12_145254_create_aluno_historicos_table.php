<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoHistoricosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aluno_historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CODIGO');

            $table->string('BIMESTRE');

            $table->string('NOTA')->nullable();
            $table->string('MEDIA')->nullable();
            $table->string('APROVADO')->nullable();
            $table->string('RECUPERACAO')->nullable();
            $table->string('FALTAS')->nullable();

            $table->integer('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

            $table->integer('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aluno_historicos');
    }

}
