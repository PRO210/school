<?php

namespace App\Http\Controllers\Alunos;

//
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Alunos\Aluno;
use App\Models\Turmas\Turma;
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

//
    public function __construct(Aluno $aluno, Log $log, Turma $turma) {
//
        $this->aluno = $aluno;
        $this->log = $log;
        $this->turma = $turma;
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
        return view('Alunos.create', compact('title', 'certidoes', 'tiposcertidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes'));
    }

//
//
    public function store(AlunoFormRequest $request) { //Esse método Recupera o que veio de Create Para Cadastrar Novatos
        $form = $request->except(['_token']);

//Insere os dados
        $insert = $this->aluno->create($form);
//Redireciona
        if ($insert) {
            return redirect()->route('alunos.index');
        } else {
            return redirect()->route('alunos.create');
        }
    }

//
//Esse método Recupera o que veio do Create, mas diferente do anterior esse método Atualiza os dados existentes
    public function update(AlunoFormRequest $request, $id) {
        $backup = $this->aluno->find($id);
        $form = $request->except(['_token', '_method']);
        /* DB::enableQueryLog(); */
        $aluno = $this->aluno->where('ID', $id);
        $update = $aluno->update($form);
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
        $campo_final = "Alterou o(s) Campo(s) de " . $backup['NOME'] . " em : $campo";
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
        $turma = $this->turma->find($id_turma);
        $turmas = $this->turma->all();
        $title = "Editar o Cadastro de: {$aluno->NOME} ";       
        return view('Alunos.create', compact('title', 'aluno', 'turma', 'turmas', 'tiposcertidoes', 'certidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes'));
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
        $aluno_teste = Aluno::findOrfail(4);
        $turma_teste = Turma::findOrfail(4);
        $turma_teste->alunos()->detach($aluno_teste->id);
        if($turma_teste){
            return 'ok';
        }else{
            return 'erro';
        }
    }

}
