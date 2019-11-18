<?php

namespace App\Models\Cursos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplinas\Disciplina;

class Curso extends Model {
    //Alimenta a  Editar_Curso
    public function curso_disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'curso_disciplinas')->withPivot(['CARGA_HORARIA'])->withPivot(['BOLETIM'])->withPivot(['BOLETIM_ORD'])
                        ->withPivot(['FICHA_DESCRITIVA'])->withPivot(['FICHA_DESCRITIVA_ORD'])->withPivot(['ATA'])->withPivot(['ATA_ORD'])->withPivot(['BNC'])
                        ->withPivot(['BNC_ORD']);
    }
    
    
    
    

    //
    protected $fillable = ['NOME', 'MEDIACAO_PEDAGOGICA', 'MODALIDADE', 'ETAPA'];

}
