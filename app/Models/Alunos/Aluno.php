<?php

namespace App\Models\Alunos;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model {

    protected $fillable = [
        'nome', 'nascimento', 'id_turma', 'mae', 'prof_mae', 'inep'
    ];

           
    
    

}
