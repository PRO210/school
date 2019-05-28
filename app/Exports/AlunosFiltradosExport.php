<?php

namespace App\Exports;

use App\Models\Alunos\Aluno;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite \ Excel \ Concerns \ ShouldAutoSize;

class AlunosFiltradosExport implements FromQuery, WithHeadings, ShouldAutoSize {

    //
//    public function __construct($alunos, $menu) {
//        $this->alunos = $alunos;
//         $this->menu = (array) $menu;
//    }
    public function __construct($alunos) {
        $this->alunos = $alunos;
    }

    //A consulta no Banco é feita Aqui.
    public function query() {
        return Aluno::query()->whereIn('id', $this->alunos);
    }

    //
    public function headings(): array {
        //return (array) $this->menu;
        return [
            'id',
            'INEP',
            'NOME',
            'NASCIMENTO',
            'CERTIDAO_CIVIL',
            'MODELO_CERTIDAO',
            'MATRICULA_CERTIDAO',
            'DADOS_CERTIDAO',
            'NUMERO_RG',
            'ORGAO_EXPEDIDOR_RG',
            'EXPEDICAO_CERTIDAO',
            'NATURALIDADE',
            'ESTADO',
            'NACIONALIDADE',
            'SEXO',
            'NIS',
            'BOLSA_FAMILIA',
            'SUS',
            'NECESSIDADES_ESPECIAIS',
            'COR',
            'FONE',
            'FONE_II',
            'MAE',
            'PROF_MAE',
            'PAI',
            'PROF_PAI',
            'ENDERECO',
            'URBANO',
            'CIDADE',
            'CIDADE_ESTADO',
            'TRANSPORTE',
            'PONTO_ONIBUS',
            'MOTORISTA',
            'MOTORISTA_II',
            'MATRICULA',
            'MATRICULA_RENOVADA',
            'MATRICULA_VALIDA',
            'DECLARACAO',
            'DECLARACAO_DATA',
            'DECLARACAO_RESPONSAVEL',
            'TRANSFERENCIA',
            'TRANSFERENCIA_DATA',
            'TRANSFERENCIA_RESPONSAVEL',
            'OBSERVACOES',
            'created_at',
            'updated_at',
        ];
    }

}
