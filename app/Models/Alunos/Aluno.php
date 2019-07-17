<?php

namespace App\Models\Alunos;

use App\Models\Turmas\Turma;
use App\Models\Cursos\Curso;
use App\Models\AlunosTurmas\AlunoTurma;
use App\Models\Alunos\AlunoClassificacao;
use App\Models\Alunos\AlunoSolicitacao;
use App\Models\AlunosHistoricos\AlunoHistorico;
use App\Models\Disciplinas\Disciplina;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model {

//Alimenta a View soliciações de tranferencias
    public function transferidos() {
        return $this->belongsToMany(Turma::class, 'aluno_solicitacaos')->withPivot(['SOLICITANTE'])->withPivot(['TRANSFERENCIA_STATUS'])->withPivot(['aluno_classificacao_id']);
    }

    public function status() {
        return $this->belongsToMany(AlunoClassificacao::class, 'aluno_solicitacaos');
    }

//
//
//    Traz o relacionamento entre Alunos e Turmas através da tabela 'aluno_turmas'
    public function turmas() {
        return $this->belongsToMany(Turma::class, 'aluno_turmas')->withPivot(['Aluno_Classificacao_id'])->withPivot(['OUVINTE']);
    }

//
    //Traz o relacionamento entre Alunos e Status através da tabela 'aluno_turmas'
    public function classificacaos() {
        return $this->belongsToMany(AlunoClassificacao::class, 'aluno_turmas');
    }

//
//  Alimenta o HistoricoController@edit 
    public function historicos_alunos() {
        return $this->belongsToMany(Disciplina::class, 'aluno_historicos')->withPivot(['CODIGO'])->withPivot(['BIMESTRE'])->withPivot(['NOTA'])->withPivot(['MEDIA'])
                        ->withPivot(['APROVADO']) ->withPivot(['RECUPERACAO'])->withPivot(['FALTAS'])->where('BOLETIM', 'SIM')->orderBy('BOLETIM_ORD');
    }

//    public function historico_aluno_dados() {
//        return $this->belongsToMany(Disciplina::class, 'aluno_historicos')->withPivot(['CODIGO'])->withPivot(['curso_id'])->withPivot(['BIMESTRE'])->withPivot(['ANO'])->withPivot(['NOTA'])->withPivot(['MEDIA'])
//                ->withPivot(['APROVADO'])->withPivot(['FALTAS'])->withPivot(['aluno_classificacao_id '])->withPivot(['ESCOLA'])->withPivot(['CIDADE'])->withPivot(['ESTADO'])->withPivot(['ESCOLA_DIAS'])
//                ->withPivot(['ESCOLA_HORAS'])->withPivot(['ALUNO_DIAS'])->withPivot(['ALUNO_FREQUENCIA'])->withPivot(['TURMA'])->withPivot(['TURNO'])->withPivot(['UNICO'])->withPivot(['T1'])
//                ->withPivot(['T2'])->withPivot(['T3'])->withPivot(['T4'])->withPivot(['T5'])->withPivot(['T6'])->withPivot(['T7'])->withPivot(['T8'])->withPivot(['T9'])->where('BOLETIM','SIM')->orderBy('BOLETIM_ORD');
//    }
// 
    protected $fillable = ['INEP', 'NOME', 'NASCIMENTO', 'CERTIDAO_CIVIL', 'MODELO_CERTIDAO', 'MATRICULA_CERTIDAO',
        'DADOS_CERTIDAO', 'NUMERO_RG', 'ORGAO_EXPEDIDOR_RG', 'EXPEDICAO_CERTIDAO', 'NATURALIDADE', 'ESTADO', 'NACIONALIDADE',
        'SEXO', 'NIS', 'BOLSA_FAMILIA', 'SUS', 'NECESSIDADES_ESPECIAIS', 'COR', 'FONE', 'FONE_II', 'MAE', 'PROF_MAE', 'PAI',
        'PROF_PAI', 'ENDERECO', 'URBANO', 'CIDADE', 'CIDADE_ESTADO', 'TRANSPORTE', 'PONTO_ONIBUS', 'MOTORISTA', 'MOTORISTA_II',
        'MATRICULA', 'MATRICULA_RENOVADA', 'DECLARACAO', 'DECLARACAO_DATA', 'DECLARACAO_RESPONSAVEL', 'TRANSFERENCIA',
        'TRANSFERENCIA_DATA', 'TRANSFERENCIA_RESPONSAVEL', 'OBSERVACOES',
    ];

//    protected $guarded = [
//        'ID'
//    ];
//    public function status() {
//        return $this->belongsToMany(AlunoClassificacao::class, 'aluno_solicitacaos');
//    }
}
