<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscolasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('escolas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NOME');
            $table->string('INEP');
            $table->string('CADASTRO');
            $table->string('CNPJ');
            $table->date('DO');
            $table->string('ATO');
            $table->date('DATA_MATRICULA')->nullable();
            $table->date('DATA_CENSO')->nullable()->nullable();
            $table->string('ENDERECO');
            $table->string('CIDADE');
            $table->string('ESTADO');
            $table->string('CEP');
            $table->string('EMAIL');
            $table->string('FONE');
            $table->binary('LOGO')->nullable();
            $table->binary('ESCUDO')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('escolas');
    }

}
