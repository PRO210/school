<?php

namespace App\Http\Controllers\Alunos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Alunos\Aluno;
use App\Models\Alunos\AlunoClassificacao;
use App\Models\Turmas\Turma;
use App\Models\AlunosTurmas\AlunoTurma;
use App\Models\Logs\Log;
use App\Models\Escola\Escola;
use Gate;
use App\Http\Requests\AlunoFormRequest;
// 
use App\Exports;
use App\Exports\AlunosFiltradosExport;
use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Facades\Excel;
//
use Illuminate\Support\Facades\Crypt;
//
use Carbon\Carbon;

//
class AlunoController extends Controller {

//
    private $aluno;
    private $log;
    private $exporter;
    private $turma;
    private $alunoturma;
    private $alunoClassificacao;

//
    public function __construct(Aluno $aluno, Log $log, Escola $escola, Turma $turma, AlunoTurma $alunoturma, AlunoClassificacao $alunoclassificacao) {
//
        $this->aluno = $aluno;
        $this->alunoClassificacao = $alunoclassificacao;
        $this->log = $log;
        $this->escola = $escola;
        $this->turma = $turma;
        $this->alunoturma = $alunoturma;
    }

//
    public function index() {
        $title = "Todos os Alunos";
        $alunos = Aluno::with(['classificacaos', 'turmas' => function($q) {
                        $q->orderByDesc('ANO');
                    }])->get();

//        $alunoTeste = (Aluno::with(['turmas' => function($query) use($id_turma) {
//                                $query->where('turma_id', $id_turma);
//                            },
//                            'classificacaos' => function($query2) use ($id_status) {
//                                $query2->where('aluno_classificacao_id', $id_status);
//                            }])
//                        ->where('id', $id_aluno)->get());
//       
        //dd($alunos);
        return view('Alunos.listar', compact('title', 'alunos'));
    }

//
    public function cursando() {
      
        $title = "Alunos Cursando";
// DB::enableQueryLog();
// dd(\DB::getQueryLog());
//Recupera todas as turmas do ano corrente pelo ID
        $turmas_id [] = "";
        $arrayturmas = Db::table('turmas')->where('ANO', 'LIKE', '%' . date('Y') . '%')->get();
        foreach ($arrayturmas as $turmas) {
            foreach ($turmas as $key => $value) {
                if ($key == "id") {
                    array_push($turmas_id, $value);
                }
            }
        }
        array_shift($turmas_id);
//
//      Recupera todos os alunos através das duas tumas
        $alunos_id[] = "";
        $turmas02_id[] = "";
        $aluno_classificacao_id[] = "";
        foreach ($turmas_id as $turma_id) {
            $alunos = DB::table('aluno_turmas')
                    ->join('alunos', 'aluno_turmas.aluno_id', '=', 'alunos.id')->where('alunos.EXCLUIDO', 'NAO')
                    ->join('turmas', 'aluno_turmas.turma_id', '=', 'turmas.id')->where('turmas.id', $turma_id)
                    ->join('aluno_classificacaos', 'aluno_turmas.aluno_classificacao_id', '=', 'aluno_classificacaos.id')->whereIn('aluno_classificacao_id', [2, 4])
                    ->select('aluno_turmas.id', 'aluno_id', 'alunos.NOME', 'turma_id', 'turmas.TURMA','aluno_classificacao_id')
                    ->orderBy('turmas.TURMA','ASC')->orderBy('alunos.NOME', 'ASC')
                    ->get();
//         
            foreach ($alunos as $dados) {
                foreach ($dados as $key => $value) {
//  echo " $key : " . " $value / ";
                    if ($key == "aluno_id") {
                        array_push($alunos_id, $value);
                    }
                    if ($key == "aluno_classificacao_id") {
                        array_push($aluno_classificacao_id, $value);
                    }
                    if ($key == "turma_id") {
                        array_push($turmas02_id, $value);
                    }
                }
// echo "<br>";
            }
// echo "<br>";
        }
        array_shift($alunos_id);
        array_shift($turmas02_id);
        array_shift($aluno_classificacao_id);
//    
//Montar os dados para a Views
        $alunoTeste = collect([]);
        foreach ($alunos_id as $posicao => $Idalunoatual) {
//  echo '<br>' . $posicao . " - " . $Idalunoatual . "<br>";
            $alunoTeste = $alunoTeste->concat(Aluno::with(['classificacaos' => function ($query02) use($aluno_classificacao_id, $posicao) {
                            $query02->where('aluno_classificacao_id', $aluno_classificacao_id[$posicao]);
                        }, 'turmas' => function($query) use($turmas02_id, $posicao) {
                            $query->where('turma_id', $turmas02_id[$posicao]);
                        }])->where('id', $Idalunoatual)->get());
        }
//        
        return view('Alunos.listar_cursando', compact('title', 'alunoTeste'));
    }

    //
    //Formulario que Cadastra o Aluno.OBS: Envia para o Store
    public function create() {
        include 'selects.php';
        $title = "Cadastrar Aluno";
        $turmas = $this->turma->all();
        $sem_turma = "SEM TURMA";
        return view('Alunos.create', compact('title', 'turmas', 'certidoes', 'tiposcertidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes', 'sem_turma'));
    }

//
//  Esse método Recupera o que veio de Create Para Cadastrar Novatos
    public function store(AlunoFormRequest $request) {
        //Teste de Duplicidade
        $duplicidade = Aluno::with(['turmas', 'classificacaos'])->get();
        foreach ($duplicidade as $aluno) {
            if ($request->NOME == "$aluno->NOME") {
                return redirect()->back()->with('msg_3', 'Esse nome já consta no banco de dados!');
            }
        }
        //
        $form = $request->except(['_token', '_method', 'TURMA', 'STATUS', 'OUVINTE', 'EXCLUIDO', 'EXCLUIDO_PASTA', 'TURMA_ATUAL', 'DATA_CENSO']);
//      Insere os dados
        $insert = $this->aluno->create($form);
//      Recuperando a Data do Censo       
        $data = date('Y-m-d');
        $escola = $this->escola->find(1);
        if ($data <= $escola->DATA_CENSO) {
            $status = "2";
        } else {
            $status = "4";
        }
//      Inserindo da Tabela Pivot//      
        $turma_nova = Turma::findOrfail($request->TURMA);
        $turma_nova->alunos()->attach($insert->id, array('TURMA_ANO' => $turma_nova->ANO, 'aluno_classificacao_id' => "$status", 'OUVINTE' => "$request->OUVINTE", 'updated_at' => NOW()));
//      Recupera o Nome da Turma
        $turmas = $this->turma->find($request->TURMA);
        $campo_final = "Cadastrou" . " $request->NOME" . " na Turma: " . " $turmas->TURMA " . " $turmas->UNICO";
//      Redireciona
        if ($insert && $turma_nova) {
            //Traz o usuário
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'ALUNOS',
                'ACAO' => 'CADASTRAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
//            return redirect()->route('alunos.index')->with('msg', 'Alterações Salvas com Sucesso!');
            return redirect()->action('Alunos\AlunoController@cursando', ['id' => '0'])->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->route('alunos.create')->with('msg_2', 'Falha em Salvar os Dados!');
        }
    }

//
//Esse método Recupera o que veio do Create, mas diferente do anterior  Atualiza os dados existentes
    public function update(AlunoFormRequest $request, $id) {

//      Recuperar o Nome do Status Atual
        $status_antigo_id = $this->alunoClassificacao->find($request->STATUS_ATUAL);
        $status_antigo_nome = $status_antigo_id->STATUS;
        //
        $backup = $this->aluno->find($id);
        $form = $request->except(['_token', '_method', 'TURMA', 'STATUS', 'STATUS_ATUAL', 'OUVINTE', 'EXCLUIDO', 'EXCLUIDO_PASTA', 'TURMA_ATUAL']);
        /* DB::enableQueryLog(); */
        $aluno = $this->aluno->where('id', $id);
        $update = $aluno->update($form);
////      Backup da Tabel da Pivot
//        $aluno_turma_backup = $this->alunoturma->where('aluno_id', $id)->where('turma_id', $request->TURMA_ATUAL)->get()->first();
//        //  Atualizando a Tabela Pivot
        $user = Aluno::find($id);
        $user->turmas()->updateExistingPivot($request->TURMA_ATUAL, array('OUVINTE' => "$request->OUVINTE", 'updated_at' => NOW()));

////      Update da Tabel da Pivot
//        $aluno_turma_update = $this->alunoturma->where('aluno_id', $id)->where('turma_id', $request->TURMA)->get()->first();
//        //
//        $result_pivot = array_diff_assoc($aluno_turma_update->toArray(), $aluno_turma_backup->toArray());
//        $pivot = "";
//        $X = "";
////      Recuperar o Nomes das Turmas
//        $nome_turma_atual = $this->turma->find($request->TURMA_ATUAL);
//        $nome_turma = $this->turma->find($request->TURMA);
//
//        foreach ($result_pivot as $campo_pivot => $valor) {
//            if ($campo_pivot == "turma_id") {
//                $campo_pivot = "TURMA = ";
//                $valor = " $nome_turma->TURMA " . " $nome_turma->UNICO ";
//                $X = "De" . " $nome_turma_atual->TURMA " . " $nome_turma->UNICO " . " para";
//                //
//            } elseif ($campo_pivot == "updated_at") {
//                $campo_pivot = "";
//                $valor = "";
//                $X = "";
//            } elseif ($campo_pivot == "aluno_classificacao_id") {
////              Recuperar o Nome do Status Atual
//                $status_atual_id = $this->alunoClassificacao->find($request->STATUS);
//                $status_atual_nome = $status_atual_id->STATUS;
//                $campo_pivot = "STATUS = ";
//                $valor = "$status_atual_nome";
//                $X = "De" . " $status_antigo_nome " . " para";
//                //
//            } else {
//                $X = "De $aluno_turma_backup[$campo_pivot] para";
//            }
//            $pivot .= "$campo_pivot $X $valor / ";
//        }
        //
        $backup_update = $this->aluno->find($id);
        $result = array_diff_assoc($backup_update->toArray(), $backup->toArray());
        $campo = "";
//
        foreach ($result as $nome_campo => $valor) {
            if ($backup[$nome_campo] == "") {
                $backup[$nome_campo] = "Vazio";
            }
            if ($valor == "") {
                $valor = "Vazio";
            }
            $campo .= "$nome_campo = De $backup[$nome_campo] para $valor / ";
        }
        $campo_final = "Alterou o(s) Campo(s) de " . $backup['NOME'] . " em : $campo ";
//        $campo_final = "Alterou o(s) Campo(s) de " . $backup['NOME'] . " em : $pivot $campo ";
        /* dd(DB::getQueryLog()); */
        //Redireciona
        if ($update) {
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'ALUNOS',
                'ACAO' => 'ALTETAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
//            return redirect()->route('alunos.index')->with('msg', 'Alterações Salvas com Sucesso!');
            return redirect()->action('Alunos\AlunoController@cursando', ['id' => '0'])->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->route('alunos.create');
        }
        //
    }

    //    
    // Esse método envia para a View Create para atualizar os dados Exsitentes - Esse método envia para a Create para atualizar os dados Exsitentes.
    //
    public function editar($id, $id_turma) {

        include 'selects.php';
        $aluno = $this->aluno->find(Crypt::decrypt($id));
//        //$this->authorize('editar',$aluno);        
//        if(Gate::denies('editar',$aluno))
//            abort (403,'Unauthorized');        
        $aluno_turma = $this->alunoturma->where('aluno_id', Crypt::decrypt($id))->where('turma_id', $id_turma)->get()->first();
        $turmas_atuais = (Aluno::with(['turmas'])->where('id', Crypt::decrypt($id))->get()->first());

        $turma_atual = "";
        foreach ($turmas_atuais->turmas as $turma) {
            $turma_atual .= $turma->TURMA . " " . $turma->UNICO . " - " . \Carbon\Carbon::parse($turma->ANO)->format('Y') . ", ";
        }

        $turma = $this->turma->find($id_turma);
        $turmas = $this->turma->all();
        $status = AlunoClassificacao::all()->where('ORDEM_I', 'S');
        $title = "Editar o Cadastro de: {$aluno->NOME} ";

        return view('Alunos.create', compact('title', 'aluno', 'turma', 'turmas', 'turma_atual', 'aluno_turma', 'tiposcertidoes', 'certidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes', 'status', 'necessidades'));
    }

    //
    //
    public function updatebloco(Request $request) {
        $this->exporter = $request;
        $bt = $request->botao;
        // return('Vem da listagem de alunos');       
        //
        if ($request->botao == "geral") {
//            $opcao = [
//                'Id',
//                'Inep',
//                'Turma',
//                'Nome',
//                'Nascimento',
//                'Mãe',
//                'Profº Maẽ',
//                'Cadastrado',
//                'Atualizado'
//            ];
            //return Excel::download(new AlunosFiltradosExport($request->aluno_selecionado, $opcao), 'Nome do Arquivo Filtrado.xlsx');
            return Excel::download(new AlunosFiltradosExport($request->aluno_selecionado), 'Nome do Arquivo Filtrado.xlsx');
            //Fim do botão básica
        } elseif ($request->botao == "basica") {
            return 'Geral';
        } else {
            $title = "ATUALIZAR VÁRIOS ";
            $alunoTeste = collect([]);
            foreach ($request->aluno_selecionado as $id) {
                $ids = explode('/', $id);
                $id_aluno = $ids[0];
                $id_turma = $ids[1];

                $alunoTeste = $alunoTeste->concat(Aluno::with(['turmas' => function($query) use($id_turma) {
                                $query->where('turma_id', $id_turma);
                            }])->where('id', $id_aluno)->get());
            }
            //NO CASO DE VIR UM COLEÇÃO JÁ PRONTA
//            $listaIdAluno = [1, 2, 3, 1];
//            $listaIdTurmas = [4, 2, 3, 1];
//            $alunoTeste = collect([]);
//            foreach ($listaIdAluno as $posicao => $Idalunoatual) {
//                echo '<br>' . $posicao . " - " . $Idalunoatual . "<br>";
//                $alunoTeste = $alunoTeste->concat(Aluno::with(['turmas' => function($query) use($listaIdTurmas, $posicao) {
//                                $query->where('turma_id', $listaIdTurmas[$posicao]);
//                            }])->where('id', $listaIdAluno[$posicao])->get());
//            }
            include 'selects.php';
            $Turmas = Turma::orderByDesc('ANO')->orderBy('TURMA', 'ASC')->get();
            $status = AlunoClassificacao::all()->where('ORDEM_I', 'S');
            $marcar = "";
            return view('Alunos.atualizar_varios', compact('title', 'alunoTeste', 'marcar', 'Turmas', 'status', 'transportes', 'urbanos'));
        }
    }

    //
    //   Recebe os Dados do updatebloco  // Recebe os Dados do updatebloco 
    public function updateagora(Request $request) {
        //
        if ($request->botao == "turma") {
            $alunos = $this->aluno->find($request->aluno_selecionado);
            $turma = $this->turma->find($request->inputTurma);
            $todos = "";
            $todos_nomes = "";
            foreach ($alunos->toArray() as $aluno) {
//          Recuperar o aluno pelo id e transformar em nome
                $todos .= $aluno['NOME'] . ',';
                $todos_nomes = substr($todos, 0, -1);
            }
            $campo_final = "Alterou a Turma do(as) aluno(as) $todos_nomes para: $turma->TURMA $turma->UNICO ($turma->TURNO)";
//           Limpando os vinculos  da Tabela Pivot   
            foreach ($request->aluno_selecionado as $id) {
                $ids = explode('/', $id);
                $id_aluno = $ids[0];
                $id_turma = $ids[1];
                $aluno_turma_delete = $this->alunoturma->where('aluno_id', $id_aluno)->where('turma_id', $id_turma)->delete();
            }
//          Fazendo o Update
            foreach ($request->aluno_selecionado as $aluno) {
                $aluno_pivot = Aluno::findOrfail($aluno);
                $turma_atual = Turma::findOrfail($request->inputTurma);
                $turma_atual->alunos()->attach($aluno_pivot->id, array('aluno_classificacao_id' => "$request->STATUS", 'TURMA_ANO' => "$turma->ANO", 'updated_at' => NOW()));
            }
//            $up = \DB::table('alunos')
//                    ->whereIn('id', $request->aluno_selecionado)
//                    ->update(['TURMA' => "$request->inputTurma"]);
            //
            if ($turma_atual) {
                //Traz o usuario
                $usuario = \Auth::user()->name;
//                Faz o Log
                $insert = $this->log->create([
                    'USUARIO' => $usuario,
                    'TABELA' => 'ALUNOS',
                    'ACAO' => 'ALTERAR',
                    'DETALHES_ACAO' => "$campo_final",
                ]);
                return redirect()->route('alunos.index')->with('msg', 'Alterações Salvas com Sucesso!');
            } else {
                return redirect()->route('alunos.atualizar_varios');
            }
            //
            //
            //Bolsa Família     //Bolsa Família     //Bolsa Família
        } elseif ($request->botao == "bf") {
            $up = \DB::table('alunos')
                    ->whereIn('id', $request->aluno_selecionado)
                    ->update(['BOLSA_FAMILIA' => "$request->optradio"]);
            //
            if ($up) {
                //Recuperar o aluno pelo id e transformar em nome
                $alunos = $this->aluno->find($request->aluno_selecionado);
                $todos = "";
                $todos_nomes = "";
                foreach ($alunos->toArray() as $aluno) {
                    $todos .= $aluno['NOME'] . ',';
                    $todos_nomes = substr($todos, 0, -1);
                }
                $campo_final = "Alterou o Bolsa Família do(as) aluno(as) $todos_nomes para: $request->optradio";
                //Traz o usuario
                $usuario = \Auth::user()->name;
//                Faz o Log
                $insert = $this->log->create([
                    'USUARIO' => $usuario,
                    'TABELA' => 'ALUNOS',
                    'ACAO' => 'ALTERAR',
                    'DETALHES_ACAO' => "$campo_final",
                ]);
                return redirect()->route('alunos.index');
            } else {
                return redirect()->route('Alunos.atualizar_varios');
            }
        } elseif ($request->botao == "transporte") {
            $up = \DB::table('alunos')
                    ->whereIn('id', $request->aluno_selecionado)
                    ->update(['TRANSPORTE' => "$request->TRANSPORTE", 'MOTORISTA' => "$request->MOTORISTA", 'MOTORISTA_II' => "$request->MOTORISTA_II", 'URBANO' => "$request->URBANO"]);
            //
            if ($up) {
                //Recuperar o aluno pelo id e transformar em nome
                $alunos = $this->aluno->find($request->aluno_selecionado);
                $todos = "";
                $todos_nomes = "";
                foreach ($alunos->toArray() as $aluno) {
                    $todos .= $aluno['NOME'] . ',';
                    $todos_nomes = substr($todos, 0, -1);
                }
                $campo_final = "Alterou o Transporte do(as) aluno(as) $todos_nomes para: TRANSPORTE => $request->TRANSPORTE, MOTORISTA(S) => $request->MOTORISTA, $request->MOTORISTA_II E URBANO => $request->URBANO .";
                //Traz o usuario
                $usuario = \Auth::user()->name;
//                Faz o Log
                $insert = $this->log->create([
                    'USUARIO' => $usuario,
                    'TABELA' => 'ALUNOS',
                    'ACAO' => 'ALTERAR',
                    'DETALHES_ACAO' => "$campo_final",
                ]);
                return redirect()->route('alunos.index');
            } else {
                return redirect()->route('Alunos.atualizar_varios');
            }
        }
    }

    public function destroy($id, $botao) {

        $aluno = $this->aluno->find(Crypt::decrypt($id));
        $aluno->NOME;
        $aluno_del = DB::table('alunos')->where('id', Crypt::decrypt($id))->delete();
//        $aluno_del = true;
//        echo "$botao";
//        dd($id);
        if ($aluno_del) {
            //Traz o usuário
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'ALUNOS',
                'ACAO' => 'DELETAR',
                'DETALHES_ACAO' => "DELETOU $aluno->NOME DO SISTEMA",
            ]);
            if ($botao == "cursando") {
                return redirect()->action('Alunos\AlunoController@cursando', ['id' => '0'])->with('msg', 'Alterações Salvas com Sucesso!');
            } else {
                return redirect()->route('alunos.index')->with('msg', 'Alterações Salvas com Sucesso!');
            }
        } else {
            return redirect()->back()->with('msg_2', 'Falha em Salvar os Dados!');
        }
    }

    // public function buscarItens($id)
    // {
    //     $produto = Produto::find($id);
    //     $todosItens = Item::all();
    //     $diff = $todosItens->diff($produto->itens);
    //     return response()->json($diff);
    // }
    public function show($id, $id_turma) {
        include 'selects.php';
        $aluno = $this->aluno->find(Crypt::decrypt($id));
        $aluno_turma = $this->alunoturma->where('aluno_id', Crypt::decrypt($id))->where('turma_id', $id_turma)->get()->first();
        $turma = $this->turma->find($id_turma);
        $turmas = $this->turma->all();
        $status = AlunoClassificacao::all()->where('ORDEM_I', 'S');
        $title = "Visualizar o Cadastro de: {$aluno->NOME} ";

        return view('Alunos.listar_unico', compact('title', 'aluno', 'turma', 'turmas', 'aluno_turma', 'tiposcertidoes', 'certidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes', 'status', 'necessidades'));

//        $turma = Turma::where('id', '1')->get()->first();
//        echo "{$turma->TURMA} : ";
//        $alunos = $turma->alunos;
//        foreach ($alunos as $aluno) {
//            echo "{$aluno->NOME} - ";
//        }
        //
//        $aluno = Aluno::where('id', '1')->get()->first();
//        echo "{$aluno->NOME} : ";
//
//        $turma = $aluno->turmas;
//
//        foreach ($turma as $turma_unica) {
//            echo "{$turma_unica->TURMA} - ";
//        }
//        //dd($turma);
//        dd($aluno);//   
//        
//         Deletando da Tabela Pivot
//        $aluno_pivot = Aluno::findOrfail(1);//        
//        $turma_atual = Turma::findOrfail(1);//        
//        $turma_atual->alunos()->detach($aluno_pivot->id);
//        
////        Inserindo da Tabela Pivot
//        $aluno_pivot = Aluno::findOrfail(1);
//        $turma_atual = Turma::findOrfail(1);
//        $turma_atual->alunos()->attach($aluno_pivot->id);
//        
//        $tp = "";
//        $alunos = Aluno::with('turmas')->get();
//        foreach ($alunos as $aluno) {
////            echo "{$aluno->NOME}";
//            echo "<br>";
//
//            foreach ($aluno->turmas as $turma) {
//
//                echo "{$aluno->NOME} - {$turma->TURMA} - {$turma->pivot->STATUS} - {$turma->pivot->OUVINTE}";
//
//                echo "<br>";
//            }
//        }
//        echo "<br>";
//        echo "<br>";
//
//        //
//        dd($aluno);
    }

    public function showturma($id) {
        include 'selects.php';
        $arrayTurmas[] = "";
        $alunos = Aluno::with('turmas', 'classificacaos')->where('id', Crypt::decrypt($id))->get();
        //dd($alunos);
//        $aluno = $aluno->concat(Aluno::with(['turmas' => function($query) use($id_turma) {
//                        $query->where('turma_id', $id_turma);
//                    }])->where('id', Crypt::decrypt($id))->get());
//        

        $backup = $this->aluno->find(Crypt::decrypt($id));
        $id_aluno = $id;
        $nome = $backup->NOME;
        $status = AlunoClassificacao::all()->where('ORDEM_I', 'S');

        foreach ($alunos as $aluno) {
            foreach ($aluno->turmas as $turma_backup) {
                array_push($arrayTurmas, $turma_backup->id);
            }
        }
        array_shift($arrayTurmas);
        $turmas_base = DB::table('turmas')->whereNotIn('id', $arrayTurmas)->get();

        $title = "EDIÇAO DE TURMAS";
        return view('Alunos.inserir_retirar_turma', compact('title', 'alunos', 'id_aluno', 'nome', 'turmas_base', 'ouvintes', 'status'));
    }

    //
    //
    public function update_turma(Request $request) {//       
        $form = $request->except(['_token', '_method']);
//       
        $alunos = Aluno::with('turmas', 'classificacaos')->where('id', Crypt::decrypt($request->id))->get();
        $campo = "";
        foreach ($alunos as $aluno) {
            foreach ($aluno->turmas as $key => $turma) {
                $status = $aluno->classificacaos[$key]->STATUS;
                $ouvinte = $turma->pivot->OUVINTE;
                $campo .= "$turma->TURMA " . "$turma->UNICO " . ',' . 'Status:' . " $status " . ',' . 'Ouvinte:' . " $ouvinte" . '/ ';
            }
        }

        /* DB::enableQueryLog(); */
//      Backup da Tabel da Pivot
        $aluno_turma_backup = $this->alunoturma->where('aluno_id', Crypt::decrypt($request->id))->get();
//        
//      Limpando os vinculos  da Tabela Pivot        
        $aluno_turma_delete = $this->alunoturma->where('aluno_id', Crypt::decrypt($request->id))->delete();
//      Recuperando a Data do Censo       
        $data = date('Y-m-d');
        $escola = $this->escola->find(1);
        if ($data <= $escola->DATA_CENSO) {
            $status = "2";
        } else {
            $status = "4";
        }
//      Inserindo da Tabela Pivot
//        DB::enableQueryLog();    
        if (isset($request->turma_selecionada)) {
            foreach ($request->turma_selecionada as $key => $turma) {
                $aluno_pivot = Aluno::findOrfail(Crypt::decrypt($request->id));
                $turma_atual = Turma::findOrfail($turma);
                $turma_atual->alunos()->attach($aluno_pivot->id, array('TURMA_ANO' => "$turma_atual->ANO", 'aluno_classificacao_id' => "$status", 'OUVINTE' => $request->OUVINTE_UM[$key], 'updated_at' => NOW()));
            }
        }
//      Inserindo da Tabela Pivot da turmas novas// 
        if (isset($request->turma_selecionada_2)) {
            foreach ($request->turma_selecionada_2 as $key => $turma) {
                $aluno_pivot = Aluno::findOrfail(Crypt::decrypt($request->id));
                $turma_atual = Turma::findOrfail($turma);
                $turma_atual->alunos()->attach($aluno_pivot->id, array('TURMA_ANO' => "$turma_atual->ANO", 'aluno_classificacao_id' => "$status", 'OUVINTE' => $request->OUVINTE_DOIS[$key], 'updated_at' => NOW()));
            }
        }
//       
        $campo_2 = "";
        $alunos_2 = Aluno::with('turmas', 'classificacaos')->where('id', Crypt::decrypt($request->id))->get();
        foreach ($alunos_2 as $aluno) {
            foreach ($aluno->turmas as $key => $turma) {
                $status = $aluno->classificacaos[$key]->STATUS;
                $ouvinte = $turma->pivot->OUVINTE;
                $campo_2 .= "$turma->TURMA " . "$turma->UNICO " . ',' . 'Status:' . " $status " . ',' . 'Ouvinte:' . " $ouvinte" . '/ ';
            }
        }
        if ($campo_2 == "") {
            $campo_2 = "";
            $campo_3 = "";
        } else {
            $campo_3 = "e Vinculou a(s) Turma(s):";
        }
        $campo_final = "Desvinculou " . $aluno->NOME . " da(s) Turma(s): $campo $campo_3 $campo_2 ";
        //dd($campo_final);
        /* dd(DB::getQueryLog()); */
        //Traz o usuario
        $usuario = \Auth::user()->name;
//         Faz o Log
        $insert = $this->log->create([
            'USUARIO' => $usuario,
            'TABELA' => 'ALUNOS',
            'ACAO' => 'ALTERAR',
            'DETALHES_ACAO' => "$campo_final",
        ]);
        //Redireciona
        if ($insert) {
            return redirect()->route('alunos.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->route('alunos.index')->with('msg_2', 'Falha em Salvar as Alterações!');
        }
    }

    //
    //Página Link para Históricos e transferências 
    public function historico($id, $id_turma) {
        include 'selects.php';
        $aluno = (Aluno::with(['turmas' => function($query) use($id_turma) {
                        $query->where('turma_id', $id_turma);
                    }])->where('id', Crypt::decrypt($id))->get()->first());

        foreach ($aluno->turmas as $turma) {
            $turma_atual = "($turma->TURMA)";
            //  dd($turma);
        }
        $solicitacaos = DB::table('aluno_solicitacaos')->where('aluno_id', Crypt::decrypt($id))->where('turma_id', $id_turma)->get()->count();
        $id_classificacao = $turma->pivot->Aluno_Classificacao_id;
        $turmas = $this->turma->all();
        $title = "Transferências";

        return view('Alunos.cadastrar_transferencia', compact('title', 'id', 'aluno', 'turmas', 'turma_atual', 'id_turma', 'id_classificacao', 'anos', 'solicitacaos'));
    }

//
//
    public function arquivo($id) {
        $up = DB::table('alunos')->where('id', Crypt::decrypt($id))->update(['EXCLUIDO' => "SIM"]);
    }

    //
    //
    public function relatorio() {
        include 'selects.php';
        $status = AlunoClassificacao::all()->where('id', '<>', '1')->where('id', '<>', '6');
        $turmas = Db::table('turmas')->orderBy('ANO', 'DESC')->get();
        //dd($turmas);
        return view('Alunos.montar_relatorio', compact('status', 'turmas', 'ouvintes'));
    }

    //
    //
    public function relatorio_gerar(Request $request) {
        //Tratamento dos dados do Status
        if (!empty($request->STATUS)) {
            $status = $request->STATUS;
        } else {
            $status = ['2', '3', '4', '5'];
        }
        $arrayAlunos [] = "";
        $alunos_id [] = "";
        $turmas_id [] = "";
        foreach ($request->turma_id as $key => $turma_id) {
            $alunos = DB::table('aluno_turmas')->where('OUVINTE', 'LIKE', "%$request->OUVINTE%")
                    ->join('alunos', 'aluno_turmas.aluno_id', '=', 'alunos.id')->where('alunos.EXCLUIDO', 'NAO')->where('alunos.NECESSIDADES_ESPECIAIS', 'LIKE', "%$request->NECESSIDADES_ESPECIAIS%")
                    ->where('alunos.TRANSPORTE', 'LIKE', "%$request->TRANSPORTE%")->where('alunos.URBANO', 'LIKE', "%$request->URBANO%")
                    ->join('turmas', 'aluno_turmas.turma_id', '=', 'turmas.id')->where('turmas.id', $turma_id)
                    ->join('aluno_classificacaos', 'aluno_turmas.aluno_classificacao_id', '=', 'aluno_classificacaos.id')->whereIn('aluno_classificacao_id', $status)
                    ->select('aluno_turmas.id', 'aluno_id', 'alunos.NOME', 'turma_id', 'aluno_classificacaos.STATUS', 'aluno_turmas.OUVINTE', 'alunos.NECESSIDADES_ESPECIAIS', 'alunos.TRANSPORTE', 'alunos.URBANO')
                    ->orderBy('turmas.ANO', 'ASC')->orderBy('alunos.NOME', 'ASC')
                    ->get();
//         
            foreach ($alunos as $dados) {
                foreach ($dados as $key => $value) {
//                    echo " $key : " . " $value / ";
                    if ($key == "id") {
                        array_push($arrayAlunos, $value);
                    }
                    if ($key == "aluno_id") {
                        array_push($alunos_id, $value);
                    }
                    if ($key == "turma_id") {
                        array_push($turmas_id, $value);
                    }
                }
//                echo "<br>";
            }
//            echo "<br>";
        }
        array_shift($arrayAlunos);
        array_shift($alunos_id);
        array_shift($turmas_id);
//        $alunos_02 = DB::table('aluno_turmas')->whereIn('aluno_turmas.id', $arrayAlunos)
//                ->join('alunos', 'aluno_turmas.aluno_id', '=', 'alunos.id')
//                ->join('turmas', 'aluno_turmas.turma_id', '=', 'turmas.id')
//                ->join('aluno_classificacaos', 'aluno_turmas.aluno_classificacao_id', '=', 'aluno_classificacaos.id')
//                ->select('aluno_turmas.id', 'aluno_id', 'alunos.NOME', 'aluno_classificacaos.STATUS', 'aluno_turmas.OUVINTE', 'alunos.NECESSIDADES_ESPECIAIS',
//                        'turma_id', 'turmas.TURMA', 'turmas.TURNO', 'turmas.ANO', 'turmas.UNICO')
//                ->get();
//        foreach ($alunos_02 as $value) {
//            foreach ($value as $key_02 => $value_02) {
//                $html[$key_02] = $value_02;
//            }////          
//           // echo $html['NOME'];
//          //  echo "<br>";
//        }
        //NO CASO DE VIR UM COLEÇÃO JÁ PRONTA
//            $listaIdAluno = [1, 2, 3, 1];
//            $listaIdTurmas = [4, 2, 3, 1];
        $alunoTeste = collect([]);
        foreach ($alunos_id as $posicao => $Idalunoatual) {
            //  echo '<br>' . $posicao . " - " . $Idalunoatual . "<br>";
            $alunoTeste = $alunoTeste->concat(Aluno::with(['turmas' => function($query) use($turmas_id, $posicao) {
                            $query->where('turma_id', $turmas_id[$posicao]);
                        }])->where('id', $alunos_id[$posicao])->get());
        }
//        dd($alunoTeste);
        $title = "Resultado da Pesquisa";
        return view('Alunos.montar_relatorio_server', compact('alunoTeste', 'title'));
//        
    }

//
//
}
