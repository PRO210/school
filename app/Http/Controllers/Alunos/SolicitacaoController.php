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
use App\Models\Cursos\Curso;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
//
use App\Exports;
use App\Exports\AlunosFiltradosExport;
use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Facades\Excel;
use \Anouar\Fpdf\Facades\Fpdf;

class SolicitacaoController extends Controller {

    private $aluno;
    private $log;
    private $exporter;
    private $turma;
    private $alunoturma;
    private $alunoClassificacao;
    private $alunoSolicitacao;
    private $curso;

    public function __construct(Aluno $aluno, Log $log, Escola $escola, Turma $turma, AlunoTurma $alunoturma, AlunoClassificacao $alunoclassificacao, AlunoSolicitacao $alunosolicitacao, Curso $curso) {
//
        $this->aluno = $aluno;
        $this->alunoClassificacao = $alunoclassificacao;
        $this->alunoSolicitacao = $alunosolicitacao;
        $this->log = $log;
        $this->escola = $escola;
        $this->turma = $turma;
        $this->alunoturma = $alunoturma;
        $this->curso = $curso;
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
        } elseif ($request->botao == "folha_rosto") {
            foreach ($request->aluno_selecionado as $id) {
                $ids = explode('/', $id);
                $id_aluno = $ids[0];
                $id_turma = $ids[1];
                $id_classificacao = $ids[2];
                $id_solicitacao = $ids[3];
            }
            $aluno = $this->aluno->find(Crypt::decrypt($id_aluno));
            $transferencia = $this->alunoSolicitacao->find($id_solicitacao);
            $turmas = $this->turma->all();
//            dd($aluno->NASCIMENTO);
            return view('Alunos.folha_rosto', compact('aluno', 'turmas', 'transferencia'));
            //
        } elseif ($request->botao == "folha_rosto_servidor") {
//            dd($request->id);
            $up = \DB::table('aluno_solicitacaos')
                    ->where('id', $request->id)
                    ->update(['T1' => "$request->T1", 'T2' => "$request->T2", 'T3' => "$request->T3", 'T4' => "$request->T4", 'T5' => "$request->T5", 'T6' => "$request->T6", 'T7' => "$request->T7"]);
            //
            if ($up = 1) {
                $transferencia = $this->alunoSolicitacao->find($request->id);
                $aluno = $this->aluno->find($request->aluno_id);
                $turma = $request->TURMA;
                $pai_e = "";
                if ($aluno->PAI !== "") {
                    $pai_e = "e";
                }
                return view('Alunos.folha_rosto_impressao', compact('aluno', 'turma', 'transferencia', 'pai_e', 'turma'));
                //
            }
            //
//            Página Que Monta os Anos para a Transferência
            //
        } elseif ($request->botao == "folha_notas") {

            foreach ($request->aluno_selecionado as $id) {
                $ids = explode('/', $id);
                $id_aluno = $ids[0];
                $id_turma = $ids[1];
                $id_classificacao = $ids[2];
                $id_solicitacao = $ids[3];
            }
            $aluno = (Aluno::with(['turmas' => function($query) use($id_turma) {
                            $query->where('turma_id', $id_turma);
                        }])->where('id', Crypt::decrypt($id_aluno))->get()->first());
            //
            $turma_atual = "";
            foreach ($aluno->turmas as $turma) {
                $turma_atual .= $turma->TURMA . " " . $turma->UNICO . " (".$turma->TURNO . ") ". substr($turma->ANO, 0, -6) . "";
            }
            $historico_dados = DB::table('aluno_historico_dados')->where('aluno_id', Crypt::decrypt($id_aluno))->get();
            $cursos = $this->curso->find($historico_dados[0]->curso_id);
            $todos_cursos = $this->curso->all();
            $todas_turmas = ['1 ano', '2 ano', '3 ano', '4 ano', '5 ano', 'Eja I', 'Eja II'];
              dd($historico_dados);
            return view('Alunos.folha_notas', compact('aluno', 'turma_atual', 'cursos', 'historico_dados', 'todos_cursos', 'todas_turmas'));
            //
            //
        } elseif ($request->botao == "folha_notas_visualizar") {

            $marcarX = "";
            $marcarX2 = "";
            $aluno_historico_dados2 = "";
            $arrayNota2[] = "";
            $curso_disciplinas = DB::table('curso_disciplinas')->where('curso_id', $request->curso_id)->orderBY('BOLETIM_ORD')->get();

            foreach ($request->CODIGO as $key => $codigo) {

                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/1ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/2ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/eja1.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/3ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/4ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/eja2.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/5ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/6ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/7ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/8ano.php';
                include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/Alunos/9ano.php';
            }
            include '/opt/lampp/htdocs/laravel/school/app/Http/Controllers/data_atual_completa.php';
            $res_dis = "DE SÁUDE.";
            $res_dis1 = "E PROGRAMAS";
            $res_dis2 = "CIÊNCIAS FÍSICA, BIO";
            $res_dis3 = "LINGUA ESTRANGEIRA";
            $res_dis4 = "MODERNA (INGLÊS)";
            $res_dis7 = "ELEMENTOS DE";
            $res_dis6 = "DESENHOS";
            $res_dis5 = "GEOMÉTRICOS";
            $teste2 = 0;
            foreach ($arrayNota2 as $Tkey => $Tnota) {
                if (is_numeric($Tnota)) {
                    $teste2 += $Tnota;
                }
            }
            if ($teste2 > 0) {
                $teste2 = true;
            }
            $testeEja2 = 0;
            foreach ($arrayNota4 as $Tkey => $Tnota) {
                if (is_numeric($Tnota)) {
                    $testeEja2 += $Tnota;
                }
            }
            if ($testeEja2 > 0) {
                $testeEja2 = true;
            }
            return view('Alunos.folha_notas_impressao', compact('aluno_historico_dados', 'aluno_historico_dados2', 'aluno_historico_dados3', 'aluno_historico_dados4',
                            'aluno_historico_dados5', 'aluno_historico_dados6', 'aluno_historico_dados7', 'aluno_historico_dados8', 'aluno_historico_dados9', 'aluno_historico_dadosEja', 'aluno_historico_dadosEjaII',
                            'aluno_historicos', 'arrayDisciplinas', 'res_dis', 'res_dis1', 'res_dis2', 'res_dis3', 'res_dis4', 'res_dis5', 'res_dis6', 'res_dis7', 'arrayNota', 'arrayNota2', 'arrayNota3',
                            'arrayNota4', 'arrayNota5', 'arrayNota6', 'arrayNota7', 'arrayNota8', 'arrayNota9', 'arrayNotaEja', 'arrayNotaEjaII', 'marcarX', 'marcarX2', 'marcarX3',
                            'marcarX4', 'marcarX5', 'marcarX6', 'marcarX7', 'marcarX8', 'marcarX9', 'marcarXEja', 'marcarXEjaII',
                            'dia', 'mes', 'ano', 'teste2', 'testeEja2'));
        }
        //
        //
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
