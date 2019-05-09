<?php

namespace App\Exports;

use App\User;
use App\Models\Alunos\Aluno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings {

    /**
     * @return \Illuminate\Support\Collection

     */
    public function collection() {
        ///Pega os dados no namespace
        //return User::all();
        return Aluno::all();
    }

    public function headings(): array {
//        return[
//            '#',
//            'Name',
//            'Email',
//            'Created at',
//            'Update at'
//        ];
        //Cabeçalho da Tabela
        return[
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
