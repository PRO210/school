<?php

namespace App\Http\Controllers\Turmas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logs\Log;
use App\Models\Disciplinas\Disciplina;
use App\Models\Turmas\Turma;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller {

    public function __construct(Turma $turma, Disciplina $discipllina, Log $log) {

        $this->turma = $turma;
        $this->disciplina = $discipllina;
        $this->log = $log;
    }

    public function index() {

        $title = "Turmas";
        $turmas = $this->turma->all();
        $obs = "";
        if (empty($turmas->TURMAS)) {
            $obs = "disabled";
        }

        return view('Turmas.listar_turmas', compact('turmas', 'title', 'obs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $SIM_NAO = ['NAO', 'SIM'];
        $TURNOS = ['MATUTINO', 'MATUTINO_VESPERTINO', 'MATUTINO_NOTURNO', 'VESPERTINO', 'VESPERTINO_NOTURNO', 'NOTURNO'];
        $title = "Cadastro de Turma";
        $CATEGORIAS = ['INFANTIL', '1° GRAU', '2° GRAU', '3° GRAU', 'FASE', 'TÉCNICO'];
        return view('Turmas.cadastrar_turma', compact('title', 'SIM_NAO', 'CATEGORIAS', 'TURNOS'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $form = $request->except(['_token', '_method']);

//      Insere os dados
        $insert = $this->turma->create($form);
//         Redireciona
        if ($insert) {
            //Traz o usuário
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'TURMAS',
                'ACAO' => 'CADASTRAR',
                'DETALHES_ACAO' => "Cadastrou a Turma: $request->TURMA $request->UNICO ($request->TURNO) - $request->ANO",
            ]);
            return redirect()->route('turmas.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->back()->with('msg_2', 'Falha em Salvar os Dados!');
        }

        //
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
    public function edit($id) {

        $turma = $this->turma->find(Crypt::decrypt($id));
        $SIM_NAO = ['SIM', 'NAO'];
        $TURNOS = ['MATUTINO', 'MATUTINO_VESPERTINO', 'MATUTINO_NOTURNO', 'VESPERTINO', 'VESPERTINO_NOTURNO', 'NOTURNO'];
        $title = "Edição de Turma";
        $CATEGORIAS = ['INFANTIL', '1° GRAU', '2° GRAU', '3° GRAU', 'FASE', 'TÉCNICO'];
//        $turmas_turma = Curso::with(['turma_turmas'])->where('id', Crypt::decrypt($id))->get();
//        $arrayDiscipllinas[] = "";
//
//        foreach ($turmas_turma as $turma) {
//            foreach ($turma->turma_turmas as $turma_backup) {
//                array_push($arrayDiscipllinas, $turma_backup->id);
//            }
//        }
//        array_shift($arrayDiscipllinas);
//        $turmas_nao_vinculadas = DB::table('turmas')->whereNotIn('id', $arrayDiscipllinas)->get();
        //dd($turmas_turma);
        //  dd($turma);
        return view('Turmas.editar_turma', compact('turma', 'title', 'SIM_NAO', 'CATEGORIAS', 'TURNOS'));
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
        DB::beginTransaction();
//       Backup da turma
        $turma_backup = $this->turma->find(Crypt::decrypt($id));
//        $turma_duplicidade = $this->turma->where('NOME', $request->NOME)->count();
//
//        if ($request->NOME !== "$turma_backup->NOME") {
//            if ($turma_duplicidade > 0) {
//                return redirect()->back()->with('msg_3', 'A Duplicidade de Nome não é Permitida!');
//            }
//        }
        //
        $form = $request->except(['_token', '_method']);
//        Update dos dados do turma da tabel turmas
        $turma = $this->turma->find(Crypt::decrypt($id));
        $update = $turma->update($form);





        //Redireciona
        if ($update) {
            DB::commit();
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'TURMA_DISCIPLINAS',
                'ACAO' => 'ALTETAR',
                'DETALHES_ACAO' => "Alterou a $turma_backup->TURMA",
            ]);
            return redirect()->route('turmas.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            DB::rollback();
            return redirect()->back()->with('msg_2', 'Falha em Salvar as Alterações!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
//      Backup da Turma
        $turma_backup = $this->turma->find(Crypt::decrypt($id));
//        Deleta a Turma
        $delete = $this->turma->find(Crypt::decrypt($id))->delete();
//        Descrição da ação para o campo Log
        $campo_final = "Deletou a Turma " . $turma_backup['TURMA'] . "  " . $turma_backup['UNICO'] . " " . '(' . $turma_backup['TURNO'] . ')' . " - " . $turma_backup['ANO'] . "  e seus Vínculos. ";
        //Redireciona
        if ($delete) {
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'TURMAS',
                'ACAO' => 'DELETAR',
                'DETALHES_ACAO' => "$campo_final",
            ]);
            return redirect()->route('turmas.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            return redirect()->route('turmas.index')->with('msg_2', 'Falha em Salvar as Alterações!');
        }
    }

    //
    public function update_bloco(Request $request) {
        //
        dd($request);
    }

}
