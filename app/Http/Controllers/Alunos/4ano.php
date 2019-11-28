<?php

$curso_disciplinas4 = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

if ($key == 3 && empty($request->CODIGO[3])) {

    $marcarX4 = "";
    $aluno_historico_dados4 = "";
    $aluno_historicos4 = "";
    $arrayNota4[] = "";
    $arrayDisciplinas4[] = "";
    $arrayCursando4 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
//
    $idDisciplinas4[] = "";
    foreach ($curso_disciplinas4 as $disc3) {

        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinas4, $disciplina->DISCIPLINA);
        array_push($idDisciplinas4, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas4);
    array_shift($idDisciplinas4);
//
    foreach ($idDisciplinas4 as $key2 => $idDisciplina) {
        array_push($arrayNota4, $arrayCursando4[$key2]);
    }
    array_shift($arrayDisciplinas4);
    array_shift($arrayNota4);
    //
    //
} elseif ($key == 3 && !empty($request->CODIGO[3])) {

    $marcarX4 = "X";
    $arrayDisciplinas4[] = "";
    $idDisciplinas4[] = "";
    $aluno_historico_dados4 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[3])->get()->first();
    $curso_disciplinas4 = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dados4->curso_id)->orderBY('BOLETIM_ORD')->get();


    foreach ($curso_disciplinas4 as $disc3) {
        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinas4, $disciplina->DISCIPLINA);
        array_push($idDisciplinas4, $disciplina->id);
      //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas4);
    array_shift($idDisciplinas4);

    $arrayCursando4 = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->T4_ano == "SIM") {
//
        $arrayNota4[] = "";
        foreach ($idDisciplinas4 as $key22 => $idDisciplina) {
            array_push($arrayNota4, $arrayCursando4[$key22]);
        }
        $aluno_historico_dados4 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[3])->get()->first();
        $id_aluno = $aluno_historico_dados4->aluno_id;
        $aluno_historicos4 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNota4);
//
    } else {

        $aluno_historico_dados4 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[3])->get()->first();
        $id_aluno = $aluno_historico_dados4->aluno_id;
        $arrayNota4[] = "";
        foreach ($idDisciplinas4 as $idDisciplina) {

            $aluno_historicos4 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[3])->where('disciplina_id', $idDisciplina)->get();
            // dd($aluno_historicos4);
            foreach ($aluno_historicos4 as $value) {//
                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNota4, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNota4, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNota4, "---");
//
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNota4, $value->NOTA);
                    } else {
                        array_push($arrayNota4, $antiga);
                    }
                }
            }
        }
        array_shift($arrayNota4);
    }
}
