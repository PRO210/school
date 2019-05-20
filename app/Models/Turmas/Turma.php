<?php

namespace App\Models\Turmas;

use App\Models\Alunos\Aluno;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model {

    public function alunos() {
        return $this->belongsToMany(Aluno::class,'aluno_turmas');
    }

    //
}
