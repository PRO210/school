<?php

namespace App\Models\Cursos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplinas\Disciplina;

class Curso extends Model {

    //Alimenta a  Editar_Curso
    public function curso_disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'curso_disciplinas')->withPivot(['CARGA_HORARIA']);
    }
    //
    protected $fillable = ['NOME','MEDIACAO_PEDAGOGICA','MODALIDADE','ETAPA'];
    
    
}
