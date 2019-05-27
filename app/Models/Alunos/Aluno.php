<?php

namespace App\Models\Alunos;

use App\Models\Turmas\Turma;
use App\Models\AlunosTurmas\AlunoTurma;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model {

    public function turmas() {
        return $this->belongsToMany(Turma::Class, 'aluno_turmas')->withPivot(['STATUS'])->withPivot(['OUVINTE']);
    }
    
    protected $fillable = ['INEP', 'NOME', 'NASCIMENTO', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO', 'DADOS_CERTIDAO', 'NUMERO_RG', 'ORGAO_EXPEDIDOR_RG',
        'EXPEDICAO_CERTIDAO', 'NATURALIDADE', 'ESTADO', 'NACIONALIDADE', 'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'COR', 'FONE', 'FONE_II', 'MAE', 'PROF_MAE', 'PAI',
        'PROF_PAI', 'ENDERECO', 'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II', 'MATRICULA', 'MATRICULA_RENOVADA', 'MATRICULA_VALIDA', 'CENSO',
        'DECLARACAO', 'DECLARACAO_DATA', 'DECLARACAO_RESPONSAVEL', 'TRANSFERENCIA', 'TRANSFERENCIA_DATA', 'TRANSFERENCIA_RESPONSAVEL',
        'OBSERVACOES',
    ];

//    protected $guarded = [
//        'ID'
//    ];
}
