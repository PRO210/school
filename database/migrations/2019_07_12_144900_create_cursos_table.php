<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NOME')->nullable();
            $table->enum('MEDIACAO_PEDAGOGICA',['PRESENCIAL'])->nullable();
            $table->enum('MODALIDADE',['ENSINO REGULAR','EDUCAÇÃO DE JOVENS E ADULTOS'])->nullable();
            $table->enum('ETAPA',['EDUCAÇÃO INFANTIL','ENSINO FUNDAMENTAL DE 9 ANOS','ENSINO MÉDIO'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cursos');
    }

}
