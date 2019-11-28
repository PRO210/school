<?php

$curso_disciplinas3 = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

if ($key == 2 && empty($request->CODIGO[2])) {

    $marcarX3 = "";
    $aluno_historico_dados3 = "";
    $aluno_historicos3 = "";
    $arrayNota3[] = "";
    $arrayDisciplinas3[] = "";
    $arrayCursando3 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
//
    $idDisciplinas3[] = "";
    foreach ($curso_disciplinas3 as $disc3) {

        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinas3, $disciplina->DISCIPLINA);
        array_push($idDisciplinas3, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas3);
    array_shift($idDisciplinas3);
//
    foreach ($idDisciplinas3 as $key2 => $idDisciplina) {
        array_push($arrayNota3, $arrayCursando3[$key2]);
    }
    array_shift($arrayDisciplinas3);
    array_shift($arrayNota3);
    //
    //
} elseif ($key == 2 && !empty($request->CODIGO[2])) {

    $marcarX3 = "X";
    $arrayDisciplinas3[] = "";
    $idDisciplinas3[] = "";
    $aluno_historico_dados3 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[2])->get()->first();
    $curso_disciplinas3 = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dados3->curso_id)->orderBY('BOLETIM_ORD')->get();


    foreach ($curso_disciplinas3 as $disc3) {
        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinas3, $disciplina->DISCIPLINA);
        array_push($idDisciplinas3, $disciplina->id);
      //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas3);
    array_shift($idDisciplinas3);

    $arrayCursando3 = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->T3_ano == "SIM") {
//
        $arrayNota3[] = "";
        foreach ($idDisciplinas3 as $key22 => $idDisciplina) {
            array_push($arrayNota3, $arrayCursando3[$key22]);
        }
        $aluno_historico_dados3 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[2])->get()->first();
        $id_aluno = $aluno_historico_dados3->aluno_id;
        $aluno_historicos3 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNota3);
//
    } else {

        $aluno_historico_dados3 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[2])->get()->first();
        $id_aluno = $aluno_historico_dados3->aluno_id;
        $arrayNota3[] = "";
        foreach ($idDisciplinas3 as $idDisciplina) {

            $aluno_historicos3 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[2])->where('disciplina_id', $idDisciplina)->get();
            // dd($aluno_historicos3);
            foreach ($aluno_historicos3 as $value) {//
                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNota3, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNota3, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNota3, "---");
//
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNota3, $value->NOTA);
                    } else {
                        array_push($arrayNota3, $antiga);
                    }
                }
            }
        }
        array_shift($arrayNota3);
    }
}
