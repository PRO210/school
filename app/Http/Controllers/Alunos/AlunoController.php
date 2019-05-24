<?php

namespace App\Http\Controllers\Alunos;

//
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Alunos\Aluno;
use App\Models\Turmas\Turma;
use App\Models\AlunosTurmas\AlunoTurma;
use App\Models\Logs\Log;
use App\Http\Requests\AlunoFormRequest;
// 
use App\Exports;
use App\Exports\AlunosFiltradosExport;
use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Facades\Excel;
//
use Illuminate\Support\Facades\Crypt;

//
class AlunoController extends Controller {

//
    private $aluno;
    private $log;
    private $exporter;
    private $turma;
    private $alunoturma;

//
    public function __construct(Aluno $aluno, Log $log, Turma $turma, AlunoTurma $alunoturma) {
//
        $this->aluno = $aluno;
        $this->log = $log;
        $this->turma = $turma;
        $this->alunoturma = $alunoturma;
    }

//
    public function index() {
//
        $title = "TODOS OS ALUNOS";
        $alunos = Aluno::with('turmas')->get();
        return view('Alunos.listar', compact('title', 'alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//Formulario que Cadastra o Aluno.OBS: Envia para o Store
        include 'selects.php';
        $title = "Cadastrar Aluno";
        $turmas = $this->turma->all();
        return view('Alunos.create', compact('title', 'turmas', 'certidoes', 'tiposcertidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes', 'status'));
    }

//
//  Esse método Recupera o que veio de Create Para Cadastrar Novatos
    public function store(AlunoFormRequest $request) {
        $form = $request->except(['_token', '_method', 'TURMA', 'STATUS', 'OUVINTE', 'EXCLUIDO', 'EXCLUIDO_PASTA', 'TURMA_ATUAL']);

//      Insere os dados
        $insert = $this->aluno->create($form);
//      Inserindo da Tabela Pivot
        $turma_nova = Turma::findOrfail($request->TURMA);
        $turma_nova->alunos()->attach($insert->id);
//      Recupera o Nome da Turma
        $turmas = $this->turma->find($request->TURMA);
        $campo_final = "Cadastrou" . " $request->NOME" . " na Turma: " . " $turmas->TURMA " . " $turmas->UNICO";
//      Redireciona
        if ($insert) {
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => 'ANDRÉ',
                'TABELA' => 'ALUNOS',
                'CADASTRAR' => 'SIM',
                'ACAO' => "$campo_final",
            ]);
            return redirect()->route('alunos.index');
        } else {
            return redirect()->route('alunos.create');
        }
    }

//
//Esse método Recupera o que veio do Create, mas diferente do anterior esse método Atualiza os dados existentes
    public function update(AlunoFormRequest $request, $id) {
        //
        $backup = $this->aluno->find($id);
        $form = $request->except(['_token', '_method', 'TURMA', 'STATUS', 'OUVINTE', 'EXCLUIDO', 'EXCLUIDO_PASTA', 'TURMA_ATUAL']);
        /* DB::enableQueryLog(); */
        $aluno = $this->aluno->where('id', $id);
        $update = $aluno->update($form);
//      Backup da Tabel da Pivot
        $aluno_turma_backup = $this->alunoturma->where('aluno_id', $id)->where('turma_id', $request->TURMA_ATUAL)->get()->first();
//      Atualizando a Tabela Pivot
        $user = Aluno::find($id);
        $user->turmas()->updateExistingPivot($request->TURMA_ATUAL, array('turma_id' => "$request->TURMA", 'STATUS' => "$request->STATUS", 'OUVINTE' => "$request->OUVINTE", 'updated_at' => NOW()));
//      Update da Tabel da Pivot
        $aluno_turma_update = $this->alunoturma->where('aluno_id', $id)->where('turma_id', $request->TURMA)->get()->first();
        //
        $result_pivot = array_diff_assoc($aluno_turma_update->toArray(), $aluno_turma_backup->toArray());
        $pivot = "";
        $X = "";
//      Recuperar o Nomes das Turmas
        $nome_turma_atual = $this->turma->find($request->TURMA_ATUAL);
        $nome_turma = $this->turma->find($request->TURMA);

        foreach ($result_pivot as $campo_pivot => $valor) {

            if ($campo_pivot == "turma_id") {
                $campo_pivot = "TURMA = ";
                $valor = " $nome_turma->TURMA " . " $nome_turma->UNICO ";
                $X = "De" . " $nome_turma_atual->TURMA " . " $nome_turma->UNICO " . " para";
                //
            } elseif ($campo_pivot == "updated_at") {
                $campo_pivot = "";
                $valor = "";
                $X = "";
                //
            } else {
                $X = "De $aluno_turma_backup[$campo_pivot] para";
            }
            $pivot .= "$campo_pivot $X $valor / ";
        }
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
        $campo_final = "Alterou o(s) Campo(s) de " . $backup['NOME'] . " em : $pivot  $campo ";
        /* dd(DB::getQueryLog()); */
        //Redireciona
        if ($update) {
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => 'ANDRÉ',
                'TABELA' => 'ALUNOS',
                'ALTERAR' => 'SIM',
                'ACAO' => "$campo_final",
            ]);
            return redirect()->route('alunos.index');
        } else {
            return redirect()->route('alunos.create');
        }
    }

    //    
    // Esse método envia para a Create para atualizar os dados Exsitentes - Esse método envia para a Create para atualizar os dados Exsitentes.
    //
    public function editar($id, $id_turma) {
        include 'selects.php';
        $aluno = Aluno::with('turmas')->where('id', Crypt::decrypt($id))->get()->first();
        $aluno_turma = $this->alunoturma->where('aluno_id', Crypt::decrypt($id))->where('turma_id', $id_turma)->get()->first();
        $turma = $this->turma->find($id_turma);
        $turmas = $this->turma->all();
        $title = "Editar o Cadastro de: {$aluno->NOME} ";
        return view('Alunos.create', compact('title', 'aluno', 'turma', 'turmas', 'aluno_turma', 'tiposcertidoes', 'certidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes', 'status'));
    }

    //
    //
    public function updatebloco(Request $request) {

        $this->exporter = $request;
        $bt = $request->botao;
        // return('Vem da listagem de alunos');       
        //
        if ($request->botao == "basica") {

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
        } elseif ($request->botao == "geral") {
            return 'Geral';
        } else {
            $title = "Atualizar Os Dados";
            // $forms = $request->except(['_token']);
            //  dd(Aluno::whereIn("id",$request->aluno_selecionado)->toSql());

            $teste = Aluno::whereIn("id", $request->aluno_selecionado)->get();
            $marcar = "";
            return view('Alunos.atualizar_varios', compact('title', 'teste', 'marcar'));
        }
    }

    //
    //     
    public function updateagora(Request $request) {

        $alunos = $this->aluno->find($request->aluno_selecionado);
        $todos = "";
        $todos_nomes = "";
        foreach ($alunos->toArray() as $aluno) {
//      Recuperar a turma pelo id e transformar em nome
            $todos .= $aluno['NOME'] . '/' . $aluno['TURMA'] . ',';
            $todos_nomes = substr($todos, 0, -1);
        }
        $backup = "Alterou a Turma do(as) aluno(as) $todos_nomes para ($request->inputTurma)";
        echo "$backup";

        exit();

        if ($request->turma == "turma") {
            $up = \DB::table('alunos')
                    ->whereIn('id', $request->aluno_selecionado)
                    ->update(['TURMA' => "$request->inputTurma"]);
            //
            if ($up) {


                return redirect()->route('alunos.index');
            } else {
                return redirect()->route('alunos.atualizar_varios');
            }
        } elseif ($request->bf == "bf") {
            $up = \DB::table('alunos')
                    ->whereIn('id', $request->aluno_selecionado)
                    ->update(['BOLSA_FAMILIA' => "$request->optradio"]);
            //
            if ($up) {
                return redirect()->route('alunos.index');
            } else {
                return redirect()->route('Alunos.atualizar_varios');
            }
        }
    }

    public function destroy($id) {
        //
    }

    // public function buscarItens($id)
    // {
    //     $produto = Produto::find($id);
    //     $todosItens = Item::all();
    //     $diff = $todosItens->diff($produto->itens);
    //     return response()->json($diff);
    // }
    public function show() {

//        $turma = Turma::where('id', '1')->get()->first();
//        echo "{$turma->TURMA} : ";
//        $alunos = $turma->alunos;
//        foreach ($alunos as $aluno) {
//            echo "{$aluno->NOME} - ";
//        }
        //
        echo "<br>";
        echo "<br>";
        echo "<br>";
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
//        foreach ($alunos as $aluno) {
////            echo "{$aluno->NOME} -  ";          
//            $turmas = $aluno->turmas;
//            foreach ($turmas as $turma) {
//                echo "{$aluno->NOME} - {$turma->TURMA}  ";
//            }
//        }
//       Deletando da Tabela Pivot
//        $aluno_pivot = Aluno::findOrfail($id);
//        $turma_atual = Turma::findOrfail($request->TURMA_ATUAL);
//        $turma_atual->alunos()->detach($aluno_pivot->id);
////        Inserindo da Tabela Pivot
//        $turma_nova = Turma::findOrfail($request->TURMA);
//        $turma_nova->alunos()->attach($aluno_pivot->id);


        if ($user) {
            return 'ok';
        } else {
            return 'erro';
        }
    }

}
