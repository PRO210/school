<?php

namespace App\Models\Alunos;

use App\Models\Turmas\Turma;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model {

    public function turmas() {
        return $this->belongsToMany(Turma::Class, 'aluno_turmas');
    }

    protected $fillable = ['INEP', 'TURMA', 'TURMA_II', 'NOME', 'NASCIMENTO', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO', 'DADOS_CERTIDAO', 'NUMERO_RG', 'ORGAO_EXPEDIDOR_RG',
        'EXPEDICAO_CERTIDAO', 'NATURALIDADE', 'ESTADO', 'NACIONALIDADE', 'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'COR', 'FONE', 'FONE_II', 'MAE', 'PROF_MAE', 'PAI',
        'PROF_PAI', 'ENDERECO', 'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II', 'MATRICULA', 'MATRICULA_RENOVADA', 'MATRICULA_VALIDA', 'CENSO',
        'DECLARACAO', 'DECLARACAO_DATA', 'DECLARACAO_RESPONSAVEL', 'TRANSFERENCIA', 'TRANSFERENCIA_DATA', 'TRANSFERENCIA_RESPONSAVEL',
        'STATUS', 'STATUS_II', 'OUVINTE', 'EXCLUIDO', 'EXCLUIDO_PASTA', 'OBSERVACOES',
    ];

//    protected $guarded = [
//        'ID'
//    ];
}
