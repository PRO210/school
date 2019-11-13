<?php

namespace App\Http\Controllers\AlunosHistoricos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alunos\Aluno;
use App\Models\Alunos\AlunoClassificacao;
use App\Models\Cursos\Curso;
use App\Models\Turmas\Turma;
use App\Models\Logs\Log;
use App\Models\Escola\Escola;
use App\Models\Disciplinas\Disciplina;
use App\Models\AlunosHistoricos\AlunoHistorico;
use App\Models\AlunosTurmas\AlunoTurma;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class HistoricoController extends Controller {

    private $aluno;
    private $log;
    private $turma;
    private $alunoClassificacao;
    private $disciplina;
    private $alunoHistorico;
    private $alunoturma;
    private $curso;

//
    public function __construct(Aluno $aluno, Log $log, Escola $escola, Turma $turma, Disciplina $disciplina, AlunoClassificacao $alunoclassificacao, AlunoTurma $alunoturma, AlunoHistorico $alunohistorico, Curso $curso) {
//
        $this->aluno = $aluno;
        $this->alunoClassificacao = $alunoclassificacao;
        $this->log = $log;
        $this->escola = $escola;
        $this->turma = $turma;
        $this->disciplina = $disciplina;
        $this->alunoHistorico = $alunohistorico;
        $this->alunoturma = $alunoturma;
        $this->curso = $curso;
    }

//
    public function index() {

        $alunos = Disciplina::with(['historicos'])->get();
        dd($alunos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $id_turma = null) {
        include 'selects.php';
        $aluno = (Aluno::with(['turmas'])->where('id', Crypt::decrypt($id))->get()->first());
//        $aluno = (Aluno::with(['turmas' => function($query) use($id_turma) {
//                        $query->where('turma_id', $id_turma);
//                    }])->where('id', Crypt::decrypt($id))->get()->first());

        $turma_atual = "";
        foreach ($aluno->turmas as $turma) {
            $turma_atual .= $turma->TURMA . " " . $turma->UNICO . ",";
            $aluno_classificacao_id = $turma->pivot->Aluno_Classificacao_id;
        }

        $historico_dados = DB::table('aluno_historico_dados')->where('aluno_id', Crypt::decrypt($id))->get();

        $turmas = $this->turma->all();
        $cursos = $this->curso->all();
        $title = "Históricos";
        return view('Alunos.cadastrar_historico', compact('title', 'id', 'aluno', 'historico_dados', 'turmas', 'turma_atual', 'id_turma',
                        'aluno_classificacao_id', 'anos', 'cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->TURMA);
        if ($request->botao == "pesquisar") {
            return redirect()->route('histórico/edição', ['id' => $request->aluno_id, 'codigo' => $request->CODIGO]);
        }
        $unico = uniqid();
        $bimestres = ["1", "2", "3", "4", "media", "final", "media_final"];
        //$disciplinas = $this->disciplina->all();
        $curso = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->where('BOLETIM', 'SIM')->orderBy('BOLETIM_ORD')->get();
        foreach ($bimestres as $bimestre) {
            foreach ($curso as $value) {
                foreach ($value as $key => $disciplina) {
                    if ($key == "disciplina_id") {
                        $historico = Disciplina::findOrfail($disciplina);
                        $historico->historicos()->attach(Crypt::decrypt($request->aluno_id), array('CODIGO' => $unico, 'BIMESTRE' => $bimestre, 'disciplina_id' => $disciplina, 'created_at' => NOW()));
                        // echo " $disciplina " . " <br> ";
                    }
                }
            }
        }
        // dd($request);
        if ($historico) {
            $historico_dados = DB::table('aluno_historico_dados')->insert(['curso_id' => $request->curso_id, 'aluno_id' => Crypt::decrypt($request->aluno_id), 'CODIGO' => $unico,
                'ANO' => $request->ANO, 'SEMESTRE' => $request->SEMESTRE, 'aluno_classificacao_id' => $request->aluno_classificacao_id, 'ESCOLA' => $request->ESCOLA,
                'CIDADE' => $request->CIDADE, 'ESTADO' => $request->ESTADO, 'ESCOLA_DIAS' => $request->ESCOLA_DIAS, 'ESCOLA_HORAS' => $request->ESCOLA_HORAS, 'ALUNO_DIAS' => $request->ALUNO_DIAS,
                'ALUNO_FREQUENCIA' => $request->ALUNO_FREQUENCIA, 'TURMA' => $request->TURMA, 'TURNO' => $request->TURNO, 'UNICO' => $request->UNICO, 'created_at' => NOW()]);
        }
        //
        if ($historico_dados) {
            return redirect()->route('histórico/edição', ['id' => $request->aluno_id, 'codigo' => $unico])->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return back()->with('msg_2', 'Falha em Salvar os Dados!');
        }
    }

    public function show($id) {

        foreach ($id->aluno_selecionado as $id) {
            $ids = explode('/', $id);
            $ano = $ids[0];
            $id_aluno = $ids[1];
            echo"$ano" . "<br>";
            echo"$id_aluno";
        }
//          

        dd($id);
    }

//    
//   Recebe o que veio do Store para Edição e atualização do histórico
    public function edit($id, $codigo) {
        //
        $curso_id_recebido = DB::table('aluno_historico_dados')->where('codigo', $codigo)->get()->first();

        $aluno = (Aluno::with(['historicos_alunos' => function($query) use($codigo) {
                        $query->where('CODIGO', $codigo);
                    }])->where('id', Crypt::decrypt($id))->get()->first());

        $title = "EDITAR HISTÓRICO";
        foreach ($aluno->historicos_alunos as $value) {
            // dd($aluno->historicos_alunos);
            $ANO = $value->pivot->ANO;
            $CODIGO = $value->pivot->CODIGO;
            $curso_id = $value->pivot->curso_id;
            $RECUPERACAO = $value->pivot->RECUPERACAO;
        }
        $cursos = $this->curso->all();
        $bimestres = ["1", "2", "3", "4", "media", "final", 'media_final'];
        $status = AlunoClassificacao::all();
        //        
        $historico_dados = DB::table('aluno_historico_dados')->where('CODIGO', $codigo)->get()->first();
        $curso_disciplinas = DB::table('curso_disciplinas')->where('curso_id', $curso_id_recebido->curso_id)->orderBY('BOLETIM_ORD')->get();
        //
        $SEMESTRE = $historico_dados->SEMESTRE;
        $ALUNO_DIAS = $historico_dados->ALUNO_DIAS;
        $ALUNO_FREQUENCIA = $historico_dados->ALUNO_FREQUENCIA;
        $ANO = $historico_dados->ANO;
        $TURMA = $historico_dados->TURMA;
        $TURNO = $historico_dados->TURNO;
        $UNICO = $historico_dados->UNICO;
        $CIDADE = $historico_dados->CIDADE;
        $ESTADO = $historico_dados->ESTADO;
        $ESCOLA = $historico_dados->ESCOLA;
        $ESCOLA_DIAS = $historico_dados->ESCOLA_DIAS;
        $ESCOLA_HORAS = $historico_dados->ESCOLA_HORAS;
        $CODIGO = $historico_dados->CODIGO;
        $curso_id = $historico_dados->curso_id;
        $aluno_classificacao_id = $historico_dados->aluno_classificacao_id;
        $aluno_turma = $this->alunoturma->where('aluno_id', Crypt::decrypt($id))->orderBY('TURMA_ANO', 'DESC')->get()->first();
        // dd($aluno_turma->aluno_classificacao_id);
//        foreach ($bimestres as $bimestre) {
//            echo " Bimestre: " . $bimestre . "  ";
//            foreach ($aluno->historicos_alunos as $disciplina) {
//                if ($disciplina->pivot->BIMESTRE == $bimestre) {
//                    echo $disciplina->DISCIPLINA . " - ";
//                }
//            }
//            echo "<br>";
//            foreach ($aluno->historicos_alunos as $disciplina) {
//                if ($disciplina->pivot->BIMESTRE == $bimestre) {
//                    echo $disciplina->pivot->disciplina_id . " - ";
//                }
//            }
//            echo "<br>";
//            break;
//        }
        return view('Alunos.editar_historico', compact('title', 'aluno', 'SEMESTRE', 'ALUNO_DIAS', 'ALUNO_FREQUENCIA', 'ANO', 'TURMA', 'TURNO', 'UNICO', 'CIDADE', 'ESTADO', 'ESCOLA',
                        'ESCOLA_DIAS', 'ESCOLA_HORAS', 'bimestres', 'CODIGO', 'curso_id', 'cursos', 'aluno_classificacao_id', 'status', 'RECUPERACAO', 'curso_disciplinas', 'aluno_turma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // dd($request);
        $disciplina = $request->DISCIPLINAS;
        $bimestres = [1, 2, 3, 4, 'media', 'final', 'media_final'];
//        foreach ($request->B1 as $key => $nota) {
//            $up = \DB::table('aluno_historicos')->where('BIMESTRE', "1")->where('aluno_id', "$id")->where('disciplina_id', $disciplina[$key])->where('ANO', "$request->ANO")
//                    ->update(['NOTA' => $nota]);
//        }      
        foreach ($bimestres as $bimestre) {
            foreach ($request->$bimestre as $key => $nota) {
                $up = \DB::table('aluno_historicos')->where('BIMESTRE', "$bimestre")->where('aluno_id', Crypt::decrypt($id))->where('disciplina_id', $disciplina[$key])->where('CODIGO', "$request->CODIGO")
                        ->update(['NOTA' => "$nota", 'RECUPERACAO' => $request->RECUPERACAO, 'updated_at' => NOW()]);
            }
        }
        if ($up) {
            $up2 = \DB::table('aluno_historico_dados')->where('CODIGO', "$request->CODIGO")->update(['SEMESTRE' => $request->SEMESTRE, 'aluno_classificacao_id' => $request->aluno_classificacao_id,
                'ESCOLA' => $request->ESCOLA, 'CIDADE' => $request->CIDADE, 'ESTADO' => $request->ESTADO, 'ESCOLA_DIAS' => $request->ESCOLA_DIAS, 'ESCOLA_HORAS' => $request->ESCOLA_HORAS,
                'ALUNO_DIAS' => $request->ALUNO_DIAS, 'ALUNO_FREQUENCIA' => $request->ALUNO_FREQUENCIA, 'TURMA' => $request->TURMA, 'TURNO' => $request->TURNO, 'UNICO' => $request->UNICO,
                'curso_id' => $request->curso_id, 'updated_at' => NOW()]);
        }
        $aluno_turma = $this->alunoturma->where('aluno_id', Crypt::decrypt($id))->orderBY('TURMA_ANO', 'DESC')->get()->first();
    //  Atualizando a Tabela Pivot
        $user = Aluno::find(Crypt::decrypt($id));
        $user->turmas()->updateExistingPivot($aluno_turma->turma_id, array('aluno_classificacao_id' => "$request->STATUS", 'updated_at' => NOW()));

        $campo_final = "Alterou o Histórico do Aluno(a): $request->NOME ";
        if ($up2 = true) {
            //Traz o usuário
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'ALUNOS',
                'ACAO' => 'ALTERAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
            return redirect()->route('histórico/edição', ['id' => $id, 'codigo' => $request->CODIGO])->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return back()->with('msg_2', 'Falha em Salvar os Dados!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $aluno_id) {

        DB::beginTransaction();
//      Limpando os vinculos da Tabela Pivot Histórico       
        $historico_delete = $this->alunoHistorico->where('CODIGO', $id)->delete();
        $historico_dados_delete = DB::table('aluno_historico_dados')->where('CODIGO', $id)->delete();
        //
        if ($historico_delete && $historico_dados_delete) {
            DB::commit();
            return redirect()->route('histórico', ['id' => $aluno_id, 'id_turma' => ''])->with('msg', 'Alterações Salvas com Sucesso!');
            //  return redirect()->route('alunos.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            DB::rollback();
            return redirect()->back()->with('msg_2', 'Falha em Salvar os Dados!');
        }
    }

}
