<?php

namespace App\Http\Controllers\AlunosHistoricos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alunos\Aluno;
use App\Models\Alunos\AlunoClassificacao;
use App\Models\Turmas\Turma;
use App\Models\Logs\Log;
use App\Models\Escola\Escola;
use App\Models\Disciplinas\Disciplina;
use App\Models\AlunosHistoricos\AlunoHistorico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class HistoricoController extends Controller {

    private $aluno;
    private $log;
    private $turma;
    private $alunoClassificacao;
    private $disciplina;
    private $alunoHistorico;

//
    public function __construct(Aluno $aluno, Log $log, Escola $escola, Turma $turma, Disciplina $disciplina, AlunoClassificacao $alunoclassificacao, AlunoHistorico $alunohistorico) {
//
        $this->aluno = $aluno;
        $this->alunoClassificacao = $alunoclassificacao;
        $this->log = $log;
        $this->escola = $escola;
        $this->turma = $turma;
        $this->disciplina = $disciplina;
        $this->alunoHistorico = $alunohistorico;
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
        //dd($aluno);
        $turma_atual = "";
        foreach ($aluno->turmas as $turma) {
            $turma_atual .= $turma->TURMA . " " . $turma->UNICO . ",";
            $aluno_classificacao_id = $turma->pivot->Aluno_Classificacao_id;
        }
        $aluno_historicos = DB::table('aluno_historicos')->select('ANO')->groupBy('ANO')->where('aluno_id', Crypt::decrypt($id))->get();
        $turmas = $this->turma->all();
        $title = "Históricos";
        return view('Alunos.cadastrar_historico', compact('title', 'id', 'aluno', 'aluno_historicos', 'turmas', 'turma_atual', 'id_turma', 'aluno_classificacao_id', 'anos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request);
        if ($request->botao == "pesquisar") {
            return redirect()->route('histórico/edição', ['id' => $request->aluno_id, 'ano' => $request->ANO2]);
        }
        $bimestres = ["1", "2", "3", "4", "media", "final", "media_final"];
        $disciplinas = $this->disciplina->all();

        foreach ($bimestres as $bimestre) {
            foreach ($disciplinas as $disciplina) {
//                $teste = "Aluno_id : " . Crypt::decrypt($request->aluno_id) . "- Disciplina : $disciplina->id" . "- Bimestre: $bimestre ";
//      Inserindo da Tabela Pivot    
                $historico = Disciplina::findOrfail($disciplina->id);
                $historico->historicos()->attach(Crypt::decrypt($request->aluno_id), array('BIMESTRE' => $bimestre, 'ANO' => $request->ANO, 'disciplina_id' => $disciplina->id,
                    'aluno_classificacao_id' => $request->aluno_classificacao_id, 'ESCOLA' => $request->ESCOLA, 'CIDADE' => $request->CIDADE, 'ESTADO' => $request->ESTADO,
                    'ESCOLA_DIAS' => $request->ESCOLA_DIAS, 'ESCOLA_HORAS' => $request->ESCOLA_HORAS, 'ALUNO_DIAS' => $request->ALUNO_DIAS, 'ALUNO_FREQUENCIA' => $request->ALUNO_FREQUENCIA,
                    'TURMA' => $request->TURMA, 'TURNO' => $request->TURNO, 'UNICO' => $request->UNICO, 'created_at' => NOW()));
            }
        }
        //
        if ($historico) {
            return redirect()->route('histórico/edição', ['id' => $request->aluno_id, 'ano' => $request->ANO])->with('msg', 'Alterações Salvas com Sucesso !');
        } else {
            return back()->with('msg_2', 'Falha em Salvar os Dados !');
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
//   Recebe o que veio do Store para Edição do histórico
    public function edit($id, $ano) {

        $aluno = (Aluno::with(['historicos_alunos' => function($query) use($ano) {
                        $query->where('ANO', $ano);
                    }])->where('id', Crypt::decrypt($id))->get()->first());

        $title = "EDITAR HISTÓRICO";
        foreach ($aluno->historicos_alunos as $value) {
            $ANO = $value->pivot->ANO;
            $TURMA = $value->pivot->TURMA;
            $TURNO = $value->pivot->TURNO;
            $UNICO = $value->pivot->UNICO;

            $ALUNO_DIAS = $value->pivot->ALUNO_DIAS;
            $ALUNO_FREQUENCIA = $value->pivot->ALUNO_FREQUENCIA;

            $ESCOLA_DIAS = $value->pivot->ESCOLA_DIAS;
            $ESCOLA_HORAS = $value->pivot->ESCOLA_HORAS;
            $CIDADE = $value->pivot->CIDADE;
            $ESTADO = $value->pivot->ESTADO;
            $ESCOLA = $value->pivot->ESCOLA;
        }

        $bimestres = ["1", "2", "3", "4", "media", "final", 'media_final'];

//        foreach ($bimestres as $bimestre) {
//            echo " Bimestre: " . $bimestre . "  ";
//
//            foreach ($aluno->historicos_alunos as $disciplina) {
//
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
//        }//        

        return view('Alunos.editar_historico', compact('title', 'aluno', 'ALUNO_DIAS', 'ALUNO_FREQUENCIA', 'ANO', 'TURMA', 'TURNO', 'UNICO', 'CIDADE', 'ESTADO', 'ESCOLA','bimestres'));
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
                $up = \DB::table('aluno_historicos')->where('BIMESTRE', "$bimestre")->where('aluno_id', "$id")->where('disciplina_id', $disciplina[$key])->where('ANO', "$request->ANO")
                        ->update(['NOTA' => "$nota"]);
            }
        }

        if ($up = true) {
            return redirect()->route('histórico/edição', ['id' => Crypt::encrypt($id), 'ano' => $request->ANO])->with('msg', 'Alterações Salvas com Sucesso !');
        } else {
            return redirect()->route('histórico/edição', ['id' => Crypt::encrypt($id), 'ano' => $request->ANO])->with('msg_2', 'Falha em Salvar os Dados !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
