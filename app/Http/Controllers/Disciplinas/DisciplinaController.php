<?php

namespace App\Http\Controllers\Disciplinas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Disciplinas\Disciplina;
use App\Models\Logs\Log;
use App\Models\Turmas\Turma;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DisciplinaFormRequest;
use Illuminate\Support\Facades\Crypt;

class DisciplinaController extends Controller {

    private $disciplina;

    public function __construct(Disciplina $disciplina, Log $log, Turma $turma) {

        $this->disciplina = $disciplina;
        $this->log = $log;
        $this->turma = $turma;
    }

//
//    
    public function index() {

        $title = "DISCIPLINAS";
        //$disciplinas = $this->disciplina->all();
        $disciplinas = Disciplina::with(['disciplinas_turmas'])->get();
//        foreach ($disciplinas as $disciplina) {
//            echo $disciplina->DISCIPLINA ." - ";
//            
//            foreach ($disciplina->disciplinas_turmas as $turma) {
//                  echo $turma->TURMA . $turma->pivot->CARGA_HORARIA ." , ";
//            }
//        }
        $obs = "";
        // dd($disciplinas);
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
        $campo_final = "Cadastrou a Disciplina  $request->DISCIPLINA";
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
            return redirect()->back()->with('msg_02', 'Falha na operação');
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
        //dd($arrayTurmas);
        $turmas_base = DB::table('turmas')->whereNotIn('id', $arrayTurmas)->get();
        return view('Disciplinas.editar_disciplina', compact('disciplinas_turmas', 'title', 'sim_nao', 'disciplina', 'turmas_base'));
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
        //dd($request);
        DB::beginTransaction();
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
                $X = "De";
            } elseif ($nome_campo == "updated_at") {
                $nome_campo = "";
                $valor = "";
                $X = "";
            } else {
                $X = "De $disciplina_backup[$nome_campo] para";
            }
            $campo .= "$nome_campo  $X  $valor / ";
        }
        //Preparando para Limpar a tabela disciplinas_turmas
//        Backup da Tabel da disciplinas_turmas
        $disciplinas_turmas = Disciplina::with(['disciplinas_turmas'])->where('id', Crypt::decrypt($id))->get();
        //dd($disciplinas_turmas);
        $arrayTurmas[] = "";
        foreach ($disciplinas_turmas as $disciplina) {
            foreach ($disciplina->disciplinas_turmas as $turma_backup) {
                array_push($arrayTurmas, $turma_backup->id);
            }
        }
        array_shift($arrayTurmas);
//        Limpando a tabela em questão
        $disciplina_pivot = Disciplina::findOrfail(Crypt::decrypt($id));
        $disciplina_pivot->disciplinas_turmas()->detach($arrayTurmas);
//                   
//        Inserindo da Tabela Pivot da turmas atuais// 
        $campo_turma = "";
        if (isset($request->turma_selecionada)) {
            foreach ($request->turma_selecionada as $key => $turma) {
                $disciplina_pivot = Disciplina::findOrfail(Crypt::decrypt($id));
                $turma_atual = Turma::findOrfail($turma);
                $turma_atual->disciplinas()->attach($disciplina_pivot->id, array('CARGA_HORARIA' => $request->CARGA_HORARIA[$key], 'updated_at' => NOW()));
                //
                $turmas_base = Turma::find($turma);
                $campo_turma .= $turmas_base->TURMA . "  " . $turmas_base->UNICO . " - " . $request->CARGA_HORARIA[$key] . ' Horas' . " / ";
            }
        }
//        Inserindo da Tabela Pivot da turmas novas// 
        if (isset($request->turma_selecionada_dois)) {
            foreach ($request->turma_selecionada_dois as $key => $turma) {
                $disciplina_pivot = Disciplina::findOrfail(Crypt::decrypt($id));
                $turma_atual = Turma::findOrfail($turma);
                $turma_atual->disciplinas()->attach($disciplina_pivot->id, array('CARGA_HORARIA' => $request->CARGA_HORARIA_DOIS[$key], 'updated_at' => NOW()));
                //
                $turmas_base = Turma::find($turma);
                $campo_turma .= $turmas_base->TURMA . "  " . $turmas_base->UNICO . " - " . $request->CARGA_HORARIA_DOIS[$key] . ' Horas' . " / ";
            }
        }

        if (!empty($campo_turma)) {
            $campo_turma_final = " Turma(s): $campo_turma";
        }



        if ($campo == "" && $campo_turma == "") {
            $campo_final = "Nada Foi Alterado !";
        } elseif ($campo == "") {
            $campo_final = "Inseriu a Disciplina " . $disciplina_backup['DISCIPLINA'] . " a(s) ";
        } else {
            $campo_final = "Alterou o(s) Campo(s) da Disciplina " . $disciplina_backup['DISCIPLINA'] . " em :  $campo e inseriu a(s) ";
        }

        //Redireciona
        if ($update && $turma_atual) {
            DB::commit();
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'DISCIPLINAS',
                'ACAO' => 'ALTETAR',
                'DETALHES_ACAO' => "$campo_final" . "$campo_turma_final",
            ]);
            return redirect()->route('disciplinas.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            DB::rollback();
            return redirect()->route('disciplinas.index')->with('msg_2', 'Falha em Salvar as Alterações!');
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
