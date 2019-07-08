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
            
            $table->string('BIMESTRE');
            $table->string('ANO');
            $table->string('NOTA')->nullable();
            $table->string('MEDIA')->nullable();
            $table->string('APROVADO')->nullable();
            $table->string('FALTAS')->nullable();

            $table->integer('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

            $table->integer('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

            $table->integer('aluno_classificacao_id')->unsigned();
            $table->foreign('aluno_classificacao_id')->references('id')->on('aluno_classificacaos');

            $table->string('ESCOLA')->nullable();
            $table->string('CIDADE')->nullable();
            $table->string('ESTADO')->nullable();

            $table->string('ESCOLA_DIAS')->nullable();
            $table->string('ESCOLA_HORAS')->nullable();

            $table->string('ALUNO_DIAS')->nullable();
            $table->string('ALUNO_HORAS')->nullable();
            
            $table->string('TURMA')->nullable();
            $table->string('TURNO')->nullable();
            $table->string('UNICO')->nullable();
            
            $table->string('T1')->nullable();
            $table->string('T2')->nullable();
            $table->string('T3')->nullable();
            $table->string('T4')->nullable();
            $table->string('T5')->nullable();
            $table->string('T6')->nullable();
            $table->string('T7')->nullable();
            $table->string('T8')->nullable();
            $table->string('T9')->nullable();



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
