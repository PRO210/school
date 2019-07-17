<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_disciplinas', function (Blueprint $table) {
            $table->increments('id');          
                        
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            
            $table->integer('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
            
            $table->string('CARGA_HORARIA')->nullable();
            
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
    public function down()
    {
        Schema::dropIfExists('curso_disciplinas');
    }
}
