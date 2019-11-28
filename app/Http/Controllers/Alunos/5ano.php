<?php

$curso_disciplinas5 = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

if ($key == 4 && empty($request->CODIGO[4])) {

    $marcarX5 = "";
    $aluno_historico_dados5 = "";
    $aluno_historicos5 = "";
    $arrayNota5[] = "";
    $arrayDisciplinas5[] = "";
    $arrayCursando5 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
//
    $idDisciplinas5[] = "";
    foreach ($curso_disciplinas5 as $disc3) {

        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinas5, $disciplina->DISCIPLINA);
        array_push($idDisciplinas5, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas5);
    array_shift($idDisciplinas5);
//
    foreach ($idDisciplinas5 as $key2 => $idDisciplina) {
        array_push($arrayNota5, $arrayCursando5[$key2]);
    }
    array_shift($arrayDisciplinas5);
    array_shift($arrayNota5);
    //
    //
} elseif ($key == 4 && !empty($request->CODIGO[4])) {

    $marcarX5 = "X";
    $arrayDisciplinas5[] = "";
    $idDisciplinas5[] = "";
    $aluno_historico_dados5 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[4])->get()->first();
    $curso_disciplinas5 = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dados5->curso_id)->orderBY('BOLETIM_ORD')->get();


    foreach ($curso_disciplinas5 as $disc3) {
        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinas5, $disciplina->DISCIPLINA);
        array_push($idDisciplinas5, $disciplina->id);
      //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas5);
    array_shift($idDisciplinas5);

    $arrayCursando5 = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->T5_ano == "SIM") {
//
        $arrayNota5[] = "";
        foreach ($idDisciplinas5 as $key22 => $idDisciplina) {
            array_push($arrayNota5, $arrayCursando5[$key22]);
        }
        $aluno_historico_dados5 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[4])->get()->first();
        $id_aluno = $aluno_historico_dados5->aluno_id;
        $aluno_historicos5 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNota5);
//
    } else {

        $aluno_historico_dados5 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[4])->get()->first();
        $id_aluno = $aluno_historico_dados5->aluno_id;
        $arrayNota5[] = "";
        foreach ($idDisciplinas5 as $idDisciplina) {

            $aluno_historicos5 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[4])->where('disciplina_id', $idDisciplina)->get();
            // dd($aluno_historicos5);
            foreach ($aluno_historicos5 as $value) {//
                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNota5, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNota5, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNota5, "---");
//
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNota5, $value->NOTA);
                    } else {
                        array_push($arrayNota5, $antiga);
                    }
                }
            }
        }
        array_shift($arrayNota5);
    }
}
