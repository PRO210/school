<?php

if ($key == 0 && empty($codigo)) {

    $aluno_historico_dados = "";
    $aluno_historicos = "";
    $arrayNota[] = "";
    $arrayDisciplinas[] = "";
    $arrayCursando = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    //
    $idDisciplinas[] = "";
    foreach ($curso_disciplinas as $disc) {

        $disciplina = DB::table('disciplinas')->where('id', $disc->disciplina_id)->get()->first();
        array_push($arrayDisciplinas, $disciplina->DISCIPLINA);
        array_push($idDisciplinas, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas);
    array_shift($idDisciplinas);
    //
    foreach ($idDisciplinas as $key2 => $idDisciplina) {
        array_push($arrayNota, $arrayCursando[$key2]);
    }
    array_shift($arrayNota);
    //
} elseif ($key == 0 && !empty($codigo)) {
    $marcarX = "X";
    $aluno_historico_dados = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO)->get()->first();
    $curso_disciplinas = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dados->curso_id)->orderBY('BOLETIM_ORD')->get();

    $arrayDisciplinas[] = "";
    $idDisciplinas[] = "";
    foreach ($curso_disciplinas as $disc) {
        $disciplina = DB::table('disciplinas')->where('id', $disc->disciplina_id)->get()->first();
        array_push($arrayDisciplinas, $disciplina->DISCIPLINA);
        array_push($idDisciplinas, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinas);
    array_shift($idDisciplinas);

    $arrayNota[] = "";
    $arrayCursando = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->T1_ano == "SIM") {
        //
        foreach ($idDisciplinas as $key2 => $idDisciplina) {
            array_push($arrayNota, $arrayCursando[$key2]);
        }
        $aluno_historico_dados = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[$key])->get()->first();
        $id_aluno = $aluno_historico_dados->aluno_id;
        $aluno_historicos = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNota);
        //
    } else {
        //           
        $aluno_historico_dados = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[$key])->get()->first();
        $id_aluno = $aluno_historico_dados->aluno_id;

        foreach ($idDisciplinas as $idDisciplina) {
            // DB::enableQueryLog();
            $aluno_historicos = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
            //  dd(\DB::getQueryLog());
            //  dd($aluno_historicos);
            foreach ($aluno_historicos as $value) {
                //

                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNota, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNota, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNota, "---");
                    //
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNota, $value->NOTA);
                    } else {
                        array_push($arrayNota, $antiga);
                    }
                }
            }
        }
        array_shift($arrayNota);
    }
}