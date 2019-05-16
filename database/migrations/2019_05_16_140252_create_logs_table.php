<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('USUARIO')->nullable();
            $table->string('TABELA')->nullable();
            $table->string('CADASTRAR')->nullable();
            $table->string('ALTERAR')->nullable();
            $table->string('EXCLUIR')->nullable();
            $table->text('ACAO')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('logs');
    }

}