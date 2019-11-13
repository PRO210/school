<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Anouar\Fpdf\Facades\Fpdf;
use Illuminate\Support\Facades\Response;
use App\Models\Alunos\Aluno;
use App\Models\Escola\Escola;
use App\Models\Alunos\AlunoSolicitacao;
use Illuminate\Support\Facades\DB;

class ExportPdfController extends Controller {

    //    

    public function exportpdf($id, $turma) {

        //
        $pdf = new Fpdf();
        
        $pdf::SetLeftMargin(15);
        $pdf::SetAutoPageBreak(false);
        $pdf::AliasNbPages();
        $pdf::AddPage();

        $pdf::Output();
        exit;
    }

}
