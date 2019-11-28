<?php

$curso_disciplinasEja = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

if ($key == 5 && empty($request->CODIGO[5])) {

    $marcarXEja = "";
    $aluno_historico_dadosEja = "";
    $aluno_historicosEja = "";
    $arrayNotaEja[] = "";
    $arrayDisciplinasEja[] = "";
    $arrayCursandoEja = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
//
    $idDisciplinasEja[] = "";
    foreach ($curso_disciplinasEja as $disc3) {

        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinasEja, $disciplina->DISCIPLINA);
        array_push($idDisciplinasEja, $disciplina->id);
        //  echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinasEja);
    array_shift($idDisciplinasEja);
//
    foreach ($idDisciplinasEja as $key2 => $idDisciplina) {
        array_push($arrayNotaEja, $arrayCursandoEja[$key2]);
    }
    array_shift($arrayDisciplinasEja);
    array_shift($arrayNotaEja);

    //
    //
} elseif ($key == 5 && !empty($request->CODIGO[5])) {

    $marcarXEja = "X";
    $arrayDisciplinasEja[] = "";
    $idDisciplinasEja[] = "";
    $aluno_historico_dadosEja = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[5])->get()->first();
    $curso_disciplinasEja = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dadosEja->curso_id)->orderBY('BOLETIM_ORD')->get();


    foreach ($curso_disciplinasEja as $disc3) {
        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
        array_push($arrayDisciplinasEja, $disciplina->DISCIPLINA);
        array_push($idDisciplinasEja, $disciplina->id);
        //echo $disciplina->DISCIPLINA . "<br>";
    }
    array_shift($arrayDisciplinasEja);
    array_shift($idDisciplinasEja);

    $arrayCursandoEja = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');

    if ($request->TEja_I == "SIM") {
//
        $arrayNotaEja[] = "";
        foreach ($idDisciplinasEja as $key22 => $idDisciplina) {
            array_push($arrayNotaEja, $arrayCursandoEja[$key22]);
        }
        $aluno_historico_dadosEja = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[5])->get()->first();
        $id_aluno = $aluno_historico_dadosEja->aluno_id;
        $aluno_historicosEja = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
        array_shift($arrayNotaEja);
//
    } else {       
        $aluno_historico_dadosEja = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[5])->get()->first();
        $id_aluno = $aluno_historico_dadosEja->aluno_id;
        $arrayNotaEja[] = "";

        foreach ($idDisciplinasEja as $idDisciplina) {

            $aluno_historicosEja = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[5])->where('disciplina_id', $idDisciplina)->get();

            foreach ($aluno_historicosEja as $value) {

                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
                    $antiga = $value->NOTA;
                }
                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
                    array_push($arrayNotaEja, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
                    array_push($arrayNotaEja, $value->NOTA);
                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
                    array_push($arrayNotaEja, "---");

//
                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {

                    if ($value->NOTA > $antiga) {
                        array_push($arrayNotaEja, $value->NOTA);
                    } else {
                        array_push($arrayNotaEja, $antiga);
                    }
                }
            }
        }
        array_shift($arrayNotaEja);
    }
}
