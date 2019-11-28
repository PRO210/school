<?php

$curso_disciplinas2 = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

if ($key == 1 && empty($request->CODIGO[1])) {

    $aluno_historico_dados2 = "";
    $aluno_historicos2 = "";
    $arrayNota2[] = "";
    $arrayDisciplinas2[] = "";
    $arrayCursando2 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
//
    $idDisciplinas2[] = "";
    foreach ($curso_disciplinas2 as $disc2) {

        $disc2iplina = DB::table('disciplinas')->where('id', $disc2->disciplina_id)->get()->first();
        array_push($arrayDisciplinas2, $disc2iplina->DISCIPLINA);
        array_push($idDisciplinas2, $disc2iplina->id);
        // echo $disc2iplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas2);
    array_shift($idDisciplinas2);
//
    foreach ($idDisciplinas2 as $key2 => $idDisciplina) {
        array_push($arrayNota2, $arrayCursando2[$key2]);
    }
    array_shift($arrayNota2);
    array_shift($arrayNota2);
//
//    
} elseif ($key == 1 && !empty($request->CODIGO[1])) {

    $marcarX2 = "X";
    $aluno_historico_dados2 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[1])->get()->first();
    $curso_disciplinas2 = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dados2->curso_id)->orderBY('BOLETIM_ORD')->get();

    $arrayDisciplinas2[] = "";
    $idDisciplinas2[] = "";
    foreach ($curso_disciplinas2 as $disc2) {
        $disc2iplina = DB::table('disciplinas')->where('id', $disc2->disciplina_id)->get()->first();
        array_push($arrayDisciplinas2, $disc2iplina->DISCIPLINA);
        array_push($idDisciplinas2, $disc2iplina->id);
//  echo $disc2iplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas2);
    array_shift($idDisciplinas2);


    $arrayCursando2 = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->T2_ano == "SIM") {
//
        foreach ($idDisciplinas2 as $key22 => $idDisciplina) {
            array_push($arrayNota2, $arrayCursando2[$key22]);
        }
        $aluno_historico_dados2 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[1])->get()->first();
        $id_aluno = $aluno_historico_dados2->aluno_id;
        $aluno_historicos2 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNota2);
//
    } else {

        $aluno_historico_dados2 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[1])->get()->first();
        $id_aluno = $aluno_historico_dados2->aluno_id;

        foreach ($idDisciplinas2 as $idDisciplina) {

            $aluno_historicos2 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[1])->where('disciplina_id', $idDisciplina)->get();
            // dd($aluno_historicos2);
            foreach ($aluno_historicos2 as $value) {
                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNota2, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNota2, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNota2, "---");
//
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNota2, $value->NOTA);
                    } else {
                        array_push($arrayNota2, $antiga);
                    }
                }
            }
        }       
        array_shift($arrayNota2);        
    }
}

