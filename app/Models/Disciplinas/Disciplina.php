<?php

namespace App\Models\Disciplinas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Turmas\Turma;
use App\Models\DisciplinasTurmas\DisciplinaTurma;
use App\Models\Alunos\Aluno;
use App\Models\AlunosHistoricos\AlunoHistorico;
use App\Models\Cursos\Curso;

class Disciplina extends Model {

    protected $fillable = ['DISCIPLINA',
    ];

    //
    //Alimenta a View Editar_disciplina
    public function disciplinas_turmas() {
        return $this->belongsToMany(Turma::class, 'disciplina_turmas')->withPivot(['CARGA_HORARIA']);
    }

    //
    //
    //Adiciona as disciplinas nas no historico
    public function historicos() {
        return $this->belongsToMany(Aluno::class, 'aluno_historicos');
    }
    //
    //Inseri as Disciplinas no curso
    public function cursos() {
        return $this->belongsToMany(Curso::class, 'curso_disciplinas')->withPivot(['CARGA_HORARIA']);
    }

}
