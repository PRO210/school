<?php

namespace App\Models\Turmas;

use App\Models\Alunos\Aluno;
use App\Models\Alunos\AlunoSolicitacao;
use App\Models\Disciplinas\Disciplina;
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
//    
    //Adiciona os pedidos de transferências
    public function transferencias() {
        return $this->belongsToMany(Aluno::class, 'aluno_solicitacaos');
    }

    //Adiciona as disciplinas nas turmas
    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'disciplina_turmas');
    }

    

}
