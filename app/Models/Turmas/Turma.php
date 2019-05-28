<?php

namespace App\Models\Turmas;

use App\Models\Alunos\Aluno;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model {

//  Essa função traz todos os alunos com vinculo em alguma turma 
    public function alunos() {
        return $this->belongsToMany(Aluno::class, 'aluno_turmas');
    }

//    public function alunos_cursando() {
//        return $this->belongsToMany(Aluno::class, 'aluno_turmas')->withPivot('STATUS')->wherePivot('STATUS', 'cursando');
//    }
//
//    public function alunos_reprovados() {
//        return $this->belongsToMany(Aluno::class, 'aluno_turmas')->withPivot('STATUS')->wherePivot('STATUS', '!=', 'cursando');
//    }
}
