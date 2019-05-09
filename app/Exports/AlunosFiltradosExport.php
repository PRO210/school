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
    public function headings():array {
        //return (array) $this->menu;
        return [
            'Id',
            'Inep',
            'Turma',
            'Nome',
            'Nascimento',
            'Mãe',
            'Profº Maẽ',
            'Cadastrado',
            'Atualizado'
        ];
    }

}
