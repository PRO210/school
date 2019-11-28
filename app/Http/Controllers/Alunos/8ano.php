<?php

$curso_disciplinas8 = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

$marcarX8 = "";
$aluno_historico_dados8 = "";
$aluno_historicos8 = "";
$arrayNota8 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');


//if ($key == 4 && empty($request->CODIGO[4])) {
//
//    $marcarX8 = "";
//    $aluno_historico_dados8 = "";
//    $aluno_historicos8 = "";
//    $arrayNota8[] = "";
//    $arrayDisciplinas6[] = "";
//    $arrayCursando6 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
////
//    $idDisciplinas6[] = "";
//    foreach ($curso_disciplinas8 as $disc3) {
//
//        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
//        array_push($arrayDisciplinas6, $disciplina->DISCIPLINA);
//        array_push($idDisciplinas6, $disciplina->id);
//        //  echo $disciplina->DISCIPLINA . "<br>";
//    }
//    array_shift($arrayDisciplinas6);
//    array_shift($idDisciplinas6);
////
//    foreach ($idDisciplinas6 as $key2 => $idDisciplina) {
//        array_push($arrayNota8, $arrayCursando6[$key2]);
//    }
//    array_shift($arrayDisciplinas6);
//    array_shift($arrayNota8);
//    //
//    //
//} elseif ($key == 4 && !empty($request->CODIGO[4])) {
//
//    $marcarX8 = "X";
//    $arrayDisciplinas6[] = "";
//    $idDisciplinas6[] = "";
//    $aluno_historico_dados8 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[3])->get()->first();
//    $curso_disciplinas8 = DB::table('curso_disciplinas')->where('curso_id', $aluno_historico_dados8->curso_id)->orderBY('BOLETIM_ORD')->get();
//
//
//    foreach ($curso_disciplinas8 as $disc3) {
//        $disciplina = DB::table('disciplinas')->where('id', $disc3->disciplina_id)->get()->first();
//        array_push($arrayDisciplinas6, $disciplina->DISCIPLINA);
//        array_push($idDisciplinas6, $disciplina->id);
//      //  echo $disciplina->DISCIPLINA . "<br>";
//    }
//    array_shift($arrayDisciplinas6);
//    array_shift($idDisciplinas6);
//
//    $arrayCursando6 = array('C', 'U', 'R', 'S', 'A', 'N', 'D', 'O', '---', '---', '---', '---', '---', '---', '---', '---');
//
//    if ($request->T5_ano == "SIM") {
////
//        $arrayNota8[] = "";
//        foreach ($idDisciplinas6 as $key22 => $idDisciplina) {
//            array_push($arrayNota8, $arrayCursando6[$key22]);
//        }
//        $aluno_historico_dados8 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[4])->get()->first();
//        $id_aluno = $aluno_historico_dados8->aluno_id;
//        $aluno_historicos8 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[$key])->where('disciplina_id', $idDisciplina)->get();
//        array_shift($arrayNota8);
////
//    } else {
//
//        $aluno_historico_dados8 = DB::table('aluno_historico_dados')->where('CODIGO', $request->CODIGO[4])->get()->first();
//        $id_aluno = $aluno_historico_dados8->aluno_id;
//        $arrayNota8[] = "";
//        foreach ($idDisciplinas6 as $idDisciplina) {
//
//            $aluno_historicos8 = DB::table('aluno_historicos')->where('CODIGO', $request->CODIGO[4])->where('disciplina_id', $idDisciplina)->get();
//            // dd($aluno_historicos8);
//            foreach ($aluno_historicos8 as $value) {//
//                if ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO") {
//                    $antiga = $value->NOTA;
//                }
//                if ($value->BIMESTRE == "media" && $value->APROVADO == "APROVADO") {
//                    array_push($arrayNota8, $value->NOTA);
//                } elseif ($value->BIMESTRE == "media" && $value->APROVADO == "REPROVADO" && $value->RECUPERACAO == "NAO") {
//                    array_push($arrayNota8, $value->NOTA);
//                } elseif ($value->BIMESTRE == "media" && empty($value->APROVADO)) {
//                    array_push($arrayNota8, "---");
////
//                } elseif ($value->BIMESTRE == "media_final" && $value->RECUPERACAO == "SIM") {
//
//                    if ($value->NOTA > $antiga) {
//                        array_push($arrayNota8, $value->NOTA);
//                    } else {
//                        array_push($arrayNota8, $antiga);
//                    }
//                }
//            }
//        }
//        array_shift($arrayNota8);
//    }
//}
