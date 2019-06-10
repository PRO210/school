<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoSolicitacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aluno_solicitacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');

            $table->integer('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('aluno_classificacaos');

            $table->string('SOLICITANTE');
            $table->string('TURMA_ANO');
            $table->date('DATA_SOLICITACAO');
            $table->string('TRANSFERENCIA_STATUS');
            $table->date('DATA_TRANSFERENCIA_STATUS')->nullable();
            $table->string('DECLARACAO')->nullable();
            $table->string('RESPONSAVEL_DECLARACAO')->nullable();
            $table->date('DATA_DECLARACAO')->nullable();
            $table->string('TRANSFERENCIA')->nullable();
            $table->string('RESPONSAVEL_TRANSFERENCIA')->nullable();
            $table->date('DATA_TRANSFERENCIA')->nullable();
            $table->string('T1')->nullable();
            $table->string('T2')->nullable();
            $table->string('T3')->nullable();
            $table->string('T4')->nullable();
            $table->string('T5')->nullable();
            $table->string('T6')->nullable();
            $table->string('T7')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aluno_solicitacaos');
    }

}
