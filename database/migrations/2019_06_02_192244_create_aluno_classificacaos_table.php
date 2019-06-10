<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoClassificacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aluno_classificacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('STATUS');
            $table->string('ORDEM_I')->nullable();
            $table->string('ORDEM_II')->nullable();
            $table->string('ORDEM_III')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aluno_classificacaos');
    }

}
