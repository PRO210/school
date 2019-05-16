<?php

namespace App\Http\Controllers\Alunos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Alunos\Aluno;
use App\Models\Logs\Log;
use App\Http\Requests\AlunoFormRequest;
//
use App\Exports;
use App\Exports\AlunosFiltradosExport;
use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Facades\Excel;
//
use Illuminate\Support\Facades\Crypt;

class AlunoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $aluno;
    private $log;
    private $exporter;

    //
    public function __construct(Aluno $aluno, Log $log) {
        //
        $this->aluno = $aluno;
        $this->log = $log;
    }

    //
    public function index() {
        //
        $title = "ALUNOS";
        $alunos = $this->aluno->all();
        return view('Alunos.listar', compact('title', 'alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //Formulario que Cadastra o Aluno.OBS: Envia para o Store
        $certidoes = ['NOVO', 'ANTIGO'];
        $tiposcertidoes = ['RG', 'CASAMENTO', 'NASCIMENTO'];
        $sexos = ['FEMININO', 'MASCULINO'];
        $bolsas = ['NAO', 'SIM'];
        $urbanos = ['NAO', 'SIM'];
        $transportes = ['NAO', 'SIM'];
        $cores = ['INDÍGENA', 'AMARELA', 'MORENA', 'PARDA', 'BRANCA'];
        $declaracoes = ['SIM', 'NAO'];
        $transferencias = ['SIM', 'NAO'];
        $ouvintes = ['SIM', 'NAO'];
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
            // echo "$nome_campo = $valor <br>";
            $campo .= "$nome_campo = De $backup[$nome_campo] para $valor / ";
        }    
        /* dd(DB::getQueryLog()); */
        //Redireciona
        if ($update) {
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => 'ANDRÉ',
                'TABELA' => 'ALUNOS',
                'ALTERAR' => 'SIM',
                'ACAO' => "$campo",
            ]);
            return redirect()->route('alunos.index');
        } else {
            return redirect()->route('alunos.create');
        }
    }

    //    
    // Esse método envia para a Create para atualizar os dados Exsitentes.
    public function edit($id) {

        $certidoes = ['NOVO', 'ANTIGO'];
        $tiposcertidoes = ['RG', 'CASAMENTO', 'NASCIMENTO'];
        $sexos = ['FEMININO', 'MASCULINO'];
        $bolsas = ['NAO', 'SIM'];
        $urbanos = ['NAO', 'SIM'];
        $transportes = ['NAO', 'SIM'];
        $cores = ['INDÍGENA', 'AMARELA', 'MORENA', 'PARDA', 'BRANCA'];
        $declaracoes = ['SIM', 'NAO'];
        $transferencias = ['SIM', 'NAO'];
        $ouvintes = ['SIM', 'NAO'];
//        $aluno = $this->aluno->find(Crypt::decrypt($id));
        $aluno = $this->aluno->find($id);
        $title = "Editar o Cadastro de: {$aluno->NOME} ";
        return view('Alunos.create', compact('title', 'aluno', 'tiposcertidoes', 'certidoes', 'sexos', 'bolsas', 'urbanos', 'transportes', 'cores', 'declaracoes', 'transferencias', 'ouvintes'));
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

        $backup = Aluno::whereIn("id", $request->aluno_selecionado)->get();

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
                return redirect()->route('alunos.atualizar_varios');
            }
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

    // public function buscarItens($id)
    // {
    //     $produto = Produto::find($id);
    //     $todosItens = Item::all();
    //     $diff = $todosItens->diff($produto->itens);
    //     return response()->json($diff);
    // }
    public function show($id) {
        //
    }

    //
}
