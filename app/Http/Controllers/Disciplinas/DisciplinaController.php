<?php

namespace App\Http\Controllers\Disciplinas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Disciplinas\Disciplina;
use App\Models\Logs\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DisciplinaFormRequest;
use Illuminate\Support\Facades\Crypt;

class DisciplinaController extends Controller {

    private $disciplina;

    public function __construct(Disciplina $disciplina, Log $log) {

        $this->disciplina = $disciplina;
        $this->log = $log;
    }

//
//    
    public function index() {

        $title = "DISCIPLINAS";
        $disciplinas = $this->disciplina->all();
        $obs = "";
        //dd($disciplinas);
        if (empty($disciplinas->DISCIPLINA)) {
            $obs = "disabled";
        }
        return view('Disciplinas.listar_disciplinas', compact('disciplinas', 'title', 'obs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "CADASTRO DE DISCIPLINA";
        return view('Disciplinas.cadastrar_disciplina', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplinaFormRequest $request) {
        //  dd($request);
        $form = $request->except(['_token', '_method']);
//      Insere os dados
        $insert = $this->disciplina->create($form);
        //Recupera os dados inseridos
        $campo_final = "Cadastrou a Disciplina  $request->DISCIPLINA de Carga Horária: $request->CARGA_HORARIA";
//      Redireciona
        if ($insert) {
            //Traz o usuário
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'DISCIPLINAS',
                'ACAO' => 'CADASTRAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
            return redirect()->route('disciplinas.index')->with('msg', 'Alteraçaões Salvas com Sucesso!');
        } else {
            return redirect()->back()->with('msg', 'Falha na operação');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Recebe o que vem do Listar_disiciplinas 
    public function edit($id) {
        $sim_nao = ['SIM', 'NAO'];
        $disciplina = $this->disciplina->find(Crypt::decrypt($id));
        $title = "EDIÇÃO DE DISCIPLINA";
        $disciplinas_turmas = Disciplina::with(['disciplinas_turmas'])->where('id', Crypt::decrypt($id))->get();
        
          $arrayTurmas[] = "";
        foreach ($disciplinas_turmas as $disciplina) {
            foreach ($disciplina->disciplinas_turmas as $turma_backup) {
                array_push($arrayTurmas, $turma_backup->id);
            }
        }
        array_shift($arrayTurmas);
        $turmas_base = DB::table('turmas')->whereNotIn('id', $arrayTurmas)->get();
        return view('Disciplinas.editar_disciplina', compact('disciplinas_turmas', 'title', 'sim_nao','disciplina','turmas_base'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Recebe o que vem do Edit
    public function update(Request $request, $id) {

//        Backup da disciplina
        $disciplina_backup = $this->disciplina->find(Crypt::decrypt($id));
        $form = $request->except(['_token', '_method']);
//        Update dos dados
        $disciplina = $this->disciplina->find(Crypt::decrypt($id));
        $update = $disciplina->update($form);
//        Recupera o update
        $disciplina_update = $this->disciplina->find(Crypt::decrypt($id));
        $result = array_diff_assoc($disciplina_update->toArray(), $disciplina_backup->toArray());
        $campo = "";
//
        foreach ($result as $nome_campo => $valor) {
            if ($disciplina_backup[$nome_campo] == "") {
                $disciplina_backup[$nome_campo] = "Vazio";
            }
            if ($valor == "") {
                $valor = "Vazio";
            }
            if ($disciplina_backup[$nome_campo] == "updated_at") {
                $disciplina_backup[$nome_campo] = "";
                $valor = "";
            }
            $campo .= "$nome_campo = De $disciplina_backup[$nome_campo] para $valor / ";
        }
        $campo_final = "Alterou o(s) Campo(s) da Disciplina " . $disciplina_backup['DISCIPLINA'] . " em :  $campo ";
        if ($campo == "") {
            $campo_final = "Nada Foi Alterado !";
        }
        //Redireciona
        if ($update) {
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'DISCIPLINAS',
                'ACAO' => 'ALTETAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
            return redirect()->route('disciplinas.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->route('disciplinas.edit')->with('msg', 'Falha em Salvar as Alterações!');
            ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
//        Backup da Disciplina
        $disciplina_backup = $this->disciplina->find(Crypt::decrypt($id));
//        Deleta a Disciplina
        $delete = $this->disciplina->find(Crypt::decrypt($id))->delete();
//        Descrição da ação para o campo Log
        $campo_final = "Deletou a Disciplina " . $disciplina_backup['DISCIPLINA'] . " e seus Vínculos. ";
        //Redireciona
        if ($delete) {
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'DISCIPLINAS',
                'ACAO' => 'DELETAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
            return redirect()->route('disciplinas.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->route('disciplinas.index')->with('msg', 'Falha em Salvar as Alterações!');
            ;
        }
    }

    public function updatebloco(Request $request) {


        $title = "Gerenciamento de Disciplinas";
        $disciplinas = $this->disciplina->whereIn('id', $request->aluno_selecionado)->get();

        return view('Disciplinas.atualizar_varias_disciplinas', compact('disciplinas', 'title'));
    }

    public function updateblocoserver(Request $request) {

        foreach ($request->aluno_selecionado as $key => $id) {

            $disciplinas = \DB::table('disciplinas')
                    ->where('id', $id)
                    ->update(['BOLETIM' => $request->BOLETIM[$key], 'BOLETIM_ORD' => $request->BOLETIM_ORD[$key]]);
        }
        //
        if ($disciplinas) {
            return redirect()->route('disciplinas.index')->with('msg', 'Alterações Salvas com Sucesso');
        } else {
            redirect()->route('disciplinas.index')->with('msg', 'Falha em Salvar as Alterações');
        }
    }

}
