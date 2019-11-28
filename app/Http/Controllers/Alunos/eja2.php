<?php

$curso_disciplinasEjaII = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

if ($key == 6 && empty($request->CODIGO[6])) {

    $marcarXEjaII = "";
    $aluno_historico_dadosEjaII = "";
    $aluno_historicosEjaII = "";
    $arrayNotaEjaII[] = "";
    $arrayDisciplinasEjaII[] = "";
    $arrayCursandoEjaII = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
//
    $idDisciplinasEjaII[] = "";
    foreach ($curso_disciplinasEjaII as $disc3) {

        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinasEjaII, $disciplina->DISCIPLINA);
        array_push($idDisciplinasEjaII, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinasEjaII);
    array_shift($idDisciplinasEjaII);
//
    foreach ($idDisciplinasEjaII as $key2 => $idDisciplina) {
        array_push($arrayNotaEjaII, $arrayCursandoEjaII[$key2]);
    }
    array_shift($arrayDisciplinasEjaII);
    array_shift($arrayNotaEjaII);

    //
    //
} elseif ($key == 6 && !empty($request->CODIGO[6])) {

    $marcarXEjaII = "X";
    $arrayDisciplinasEjaII[] = "";
    $idDisciplinasEjaII[] = "";
    $aluno_historico_dadosEjaII = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[6])->get()->first();
    $curso_disciplinasEjaII = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dadosEjaII->curso_id)->orderBY('BOLETIM_ORD')->get();


    foreach ($curso_disciplinasEjaII as $disc3) {
        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinasEjaII, $disciplina->DISCIPLINA);
        array_push($idDisciplinasEjaII, $disciplina->id);
        //echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinasEjaII);
    array_shift($idDisciplinasEjaII);

    $arrayCursandoEjaII = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->TEja_II == "SIM") {
//
        $arrayNotaEjaII[] = "";
        foreach ($idDisciplinasEjaII as $key22 => $idDisciplina) {
            array_push($arrayNotaEjaII, $arrayCursandoEjaII[$key22]);
        }
        $aluno_historico_dadosEjaII = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[6])->get()->first();
        $id_aluno = $aluno_historico_dadosEjaII->aluno_id;
        $aluno_historicosEjaII = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNotaEjaII);
//
    } else {       
        $aluno_historico_dadosEjaII = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[6])->get()->first();
        $id_aluno = $aluno_historico_dadosEjaII->aluno_id;
        $arrayNotaEjaII[] = "";

        foreach ($idDisciplinasEjaII as $idDisciplina) {

            $aluno_historicosEjaII = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[6])->where('disciplina_id', $idDisciplina)->get();

            foreach ($aluno_historicosEjaII as $value) {

                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNotaEjaII, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNotaEjaII, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNotaEjaII, "---");

//
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNotaEjaII, $value->NOTA);
                    } else {
                        array_push($arrayNotaEjaII, $antiga);
                    }
                }
            }
        }
        array_shift($arrayNotaEjaII);
    }
}
