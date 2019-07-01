<?php

namespace App\Models\Disciplinas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Turmas\Turma;
use App\Models\DisciplinasTurmas\DisciplinaTurma;

class Disciplina extends Model
{
     protected $fillable = ['DISCIPLINA', 'CARGA_HORARIA',
        
    ];
     //Alimenta a View Editar_disciplina
    public function disciplinas_turmas() {
        return $this->belongsToMany(Turma::class, 'disciplina_turmas');
    }
}
