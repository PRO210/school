<?php

namespace App\Http\Controllers\Alunos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Alunos\Aluno;
use App\Models\Turmas\Turma;
use App\Models\AlunosTurmas\AlunoTurma;
use App\Models\Logs\Log;
use App\Models\Escola\Escola;
use App\Models\Alunos\AlunoClassificacao;
use App\Models\Alunos\AlunoSolicitacao;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
//
use App\Exports;
use App\Exports\AlunosFiltradosExport;
use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Facades\Excel;

class SolicitacaoController extends Controller {

    private $aluno;
    private $log;
    private $exporter;
    private $turma;
    private $alunoturma;
    private $alunoClassificacao;
    private $alunoSolicitacao;

    public function __construct(Aluno $aluno, Log $log, Escola $escola, Turma $turma, AlunoTurma $alunoturma, AlunoClassificacao $alunoclassificacao,
            AlunoSolicitacao $alunosolicitacao) {
//
        $this->aluno = $aluno;
        $this->alunoClassificacao = $alunoclassificacao;
        $this->alunoSolicitacao = $alunosolicitacao;
        $this->log = $log;
        $this->escola = $escola;
        $this->turma = $turma;
        $this->alunoturma = $alunoturma;
    }

    public function index() {
//     
//        $alunos = Aluno::with(['transferidos', 'status'])->get();
//        foreach ($alunos as $aluno) {
//            foreach ($aluno->transferidos as $key => $turma) {
//                echo "$aluno->NOME " . " $turma->TURMA / " . $aluno->classificacaos[$key]->STATUS . " / " . $turma->pivot->SOLICITANTE . $turma->pivot->TRANSFERENCIA_STATUS;
//                echo '<br>';
//            }
//        }//
//        dd($alunos);
        $alunos = Aluno::with(['transferidos', 'status'])->get();
        $title = "GERENCIAMENTO DE TRANSFERÊNCIA";
        return view('Alunos.listar_transferidos', compact('title', 'alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request);

        if ($request->botao == "pesquisar_transferencia") {
            return redirect()->action('Alunos\SolicitacaoController@show', ['id' => $request->aluno_id]);
        }

//      Valida a Data
        if (empty($request->DATA_SOLICITACAO)) {
            $request->DATA_SOLICITACAO = $data = date('Y-m-d');
        }
//     Inserindo da Tabela Pivot AlunoClassificacaos//      
        $turma_nova = Turma::findOrfail($request->turma_id);
        $turma_nova->transferencias()->attach(Crypt::decrypt($request->aluno_id), array('TURMA_ANO' => $turma_nova->ANO, 'aluno_classificacao_id' => "$request->aluno_classificacao_id", 'SOLICITANTE' => "$request->SOLICITANTE", 'TRANSFERENCIA_STATUS' => 'PENDENTE', 'DATA_SOLICITACAO' => "$request->DATA_SOLICITACAO"));
//      Recupera o Nome da Turma
        $turmas = $this->turma->find($request->turma_id);
//      Recupera o nome do Aluno
        $aluno = $this->aluno->find(Crypt::decrypt($request->aluno_id));
        $campo_final = "Solicitou o pedifo de transferência de" . " $aluno->NOME" . " da Turma: " . " $turmas->TURMA " . " $turmas->UNICO";
//      Redireciona
        if ($turma_nova) {
//       Traz o usuário
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'ALUNOS_SOLICITAÇÕES',
                'ACAO' => 'CADASTRAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
//            return redirect()->action('Alunos\SolicitacaoController@show', ['id' => $request->aluno_id])->with('msg', 'Alterações Salvas com Sucesso!');
            $title = "GERENCIAMENTO DE TRANSFERÊNCIA";
            $alunos = Aluno::with(['transferidos', 'status'])->where('id', Crypt::decrypt($request->aluno_id))->get();
            return view('Alunos.listar_transferidos', compact('title', 'alunos'));
            //
        } else {
            return redirect()->back()->with('msg', 'Alterações Não Foram Salvas!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $title = "GERENCIAMENTO DE TRANSFERÊNCIA";
        $alunos = Aluno::with(['transferidos', 'status'])->where('id', Crypt::decrypt($id))->get();
        return view('Alunos.listar_transferidos', compact('title', 'alunos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request) {

        foreach ($request->id as $id) {
            $ids = explode('/', $id);
            $id_aluno = $ids[0];
            $id_turma = $ids[1];
            $id_classificacao = $ids[2];
        }
        $alunoTeste = DB::table('aluno_solicitacaos')
                ->join('alunos', 'aluno_solicitacaos.aluno_id', '=', 'alunos.id')->where('alunos.id', Crypt::decrypt($id_aluno))
                ->join('turmas', 'aluno_solicitacaos.turma_id', '=', 'turmas.id')->where('turmas.id', $id_turma)
                ->join('aluno_classificacaos', 'aluno_solicitacaos.aluno_classificacao_id', '=', 'aluno_classificacaos.id')->where('aluno_classificacaos.id', $id_classificacao)
                ->select('alunos.NOME', 'turmas.*', 'aluno_classificacaos.id', 'aluno_solicitacaos.*')
                ->get();


        return Response::json($alunoTeste);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        // dd($request);
        if ($request->botao == "unico") {
            foreach ($request->aluno_selecionado as $id) {
                $ids = explode('/', $id);
                $id_aluno = $ids[0];
                $id_turma = $ids[1];
                $id_classificacao = $ids[2];
            }
            if ($request->DATA_TRANSFERENCIA == "") {
                $request->DATA_TRANSFERENCIA = date('Y-m-d');
            }
            if ($request->DATA_DECLARACAO == "") {
                $request->DATA_DECLARACAO = date('Y-m-d');
            }
            if ($request->DATA_TRANSFERENCIA_STATUS == "") {
                $request->DATA_TRANSFERENCIA_STATUS = date('Y-m-d');
            }
//      Backup da Tabel da Pivot
            $solicitacao_backup = $this->alunoSolicitacao->where('aluno_id', Crypt::decrypt($id_aluno))->where('turma_id', $id_turma)->where('aluno_classificacao_id', $id_classificacao)->get()->first();
//      Limpando os vinculos  da Tabela Pivot        
            $solicitacao_delete = $this->alunoSolicitacao->where('aluno_id', Crypt::decrypt($id_aluno))->where('turma_id', $id_turma)->where('aluno_classificacao_id', $id_classificacao)->delete();
//      Recuperando os dados da Turma
            $turma = $this->turma->find($id_turma);
//      Recuperando os dados do Aluno
            $aluno = $this->aluno->find(Crypt::decrypt($id_aluno));
//      Recuperar o Nome do Status Antigo
            $status_antigo_id = $this->alunoClassificacao->find($id_classificacao);
            $status_antigo_nome = $status_antigo_id->STATUS;
//      Inserindo da Tabela Pivot AlunoClassificacaos//      
            $turma_nova = Turma::findOrfail($id_turma);
            $turma_nova->transferencias()->attach(Crypt::decrypt($id_aluno), array('TURMA_ANO' => $turma->ANO, 'aluno_classificacao_id' => "$request->aluno_classificacao_id", 'SOLICITANTE' => "$request->SOLICITANTE",
                'DATA_SOLICITACAO' => "$solicitacao_backup->DATA_SOLICITACAO", 'TRANSFERENCIA_STATUS' => $request->TRANSFERENCIA_STATUS, 'DATA_TRANSFERENCIA_STATUS' => "$request->DATA_TRANSFERENCIA_STATUS",
                'DECLARACAO' => "$request->DECLARACAO", 'RESPONSAVEL_DECLARACAO' => "$request->RESPONSAVEL_DECLARACAO", 'DATA_DECLARACAO' => "$request->DATA_DECLARACAO",
                'TRANSFERENCIA' => "$request->TRANSFERENCIA", 'RESPONSAVEL_TRANSFERENCIA' => "$request->RESPONSAVEL_TRANSFERENCIA", 'DATA_TRANSFERENCIA' => "$request->DATA_TRANSFERENCIA"));
//      Backup do Update da Tabel da Pivot
            $solicitacao_backup_update = $this->alunoSolicitacao->where('aluno_id', Crypt::decrypt($id_aluno))->where('turma_id', $id_turma)->where('aluno_classificacao_id', $request->aluno_classificacao_id)->get()->first();
//
            $result_pivot = array_diff_assoc($solicitacao_backup_update->toArray(), $solicitacao_backup->toArray());
            $pivot = "";
            $X = "";
//
            foreach ($result_pivot as $campo_pivot => $valor) {
                //
                if ($campo_pivot == "created_at" || $campo_pivot == "updated_at" || $campo_pivot == "id") {
                    $campo_pivot = "";
                    $valor = "";
                    $X = "";
                } elseif ($campo_pivot == "aluno_classificacao_id") {
//              Recuperar o Nome do Status Atual
                    $status_atual_id = $this->alunoClassificacao->find($request->aluno_classificacao_id);
                    $status_atual_nome = $status_atual_id->STATUS;
                    $campo_pivot = "STATUS = ";
                    $valor = "$status_atual_nome";
                    $X = "De" . " $status_antigo_nome " . " para";
                    //
                } else {
                    if ($solicitacao_backup[$campo_pivot] == "") {
                        $X = "De Vázio para";
                    } else {
                        $X = "De $solicitacao_backup[$campo_pivot] para";
                    }
                }
                $pivot .= "$campo_pivot $X $valor / ";
            }
            $campo_final = "Alterou o Pedido de Tranferência de " . $aluno->NOME . " da TURMA: " . $turma->TURMA . " " . $turma->UNICO . " em : $pivot";
//
            if ($turma_nova) {
//          Traz o usuário
                $usuario = \Auth::user()->name;
//          Faz o Log
                $insert = $this->log->create([
                    'USUARIO' => $usuario,
                    'TABELA' => 'ALUNOS_SOLICITAÇÕES',
                    'ACAO' => 'ALTERAR',
                    'DETALHES_ACAO' => "$campo_final",
                ]);
                return redirect()->action('Alunos\SolicitacaoController@show', ['id' => $id_aluno])->with('msg', 'Alterações Salvas com Sucesso!');
            } else {
                return redirect()->back()->with('erro', 'As Alterações NÃO FORAM Salvas !');
            }
        } elseif ($request->botao == "varios") {
            return 'varios';
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
