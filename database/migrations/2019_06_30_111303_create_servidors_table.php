<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServidorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('servidors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('INEP')->nullable();
            $table->string('NOME');
            $table->date('NASCIMENTO')->nullable();
            $table->string('CERTIDAO_CIVIL')->nullable();
            $table->string('MODELO_CERTIDAO')->nullable();
            $table->string('MATRICULA_CERTIDAO')->nullable();
            $table->string('DADOS_CERTIDAO')->nullable();
            $table->string('NUMERO_RG')->nullable();
            $table->string('ORGAO_EXPEDIDOR_RG')->nullable();
            $table->date('EXPEDICAO_CERTIDAO')->nullable();
            $table->string('ESTADO_CIVIL')->nullable();
            $table->string('NATURALIDADE')->nullable();
            $table->string('ESTADO')->nullable();
            $table->string('NACIONALIDADE')->nullable();
            $table->string('CPF')->nullable();
            $table->string('FONE')->nullable();
            $table->string('FONE_II')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('MAE')->nullable();
            $table->string('PAI')->nullable();
            $table->string('ENDERECO')->nullable();
            $table->string('GRADUACAO')->nullable();
            $table->string('INSTITUICAO_GRADUACAO')->nullable();
            $table->string('POS_GRADUACAO')->nullable();
            $table->string('INSTITUICAO_POS_GRADUACAO')->nullable();
            $table->string('MESTRADO')->nullable();
            $table->string('INSTITUICAO_MESTRADO')->nullable();
            $table->string('DOUTORADO')->nullable();
            $table->string('INSTITUICAO_DOUTORADO')->nullable();
            $table->string('FUNCAO')->nullable();
            $table->string('FUNCAO_RESUMO')->nullable();
            $table->string('VINCULO')->nullable();
            $table->string('OBSERVACOES')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('servidors');
    }

}
