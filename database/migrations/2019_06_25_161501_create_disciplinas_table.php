<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DISCIPLINA');
            $table->string('EM_DESUSO')->nullable();
            $table->string('BOLETIM')->nullable();
            $table->string('BOLETIM_ORD')->nullable();
            $table->string('FICHA_DESCRITIVA')->nullable();
            $table->string('FICHA_DESCRITIVA_ORD')->nullable();
            $table->string('ATA')->nullable();
            $table->string('ATA_ORD')->nullable();
            $table->string('BNC')->nullable();
            $table->string('BNC_ORD')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('disciplinas');
    }

}
