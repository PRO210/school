<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Alunos\Aluno;

class ExportController extends Controller {

    function export() {

        return Excel:: download(new UsersExport, 'Nome do Arquivo.xlsx');
    }

    
}
