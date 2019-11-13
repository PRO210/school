<?php

namespace App\Http\Controllers\Cursos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cursos\Curso;
use App\Models\Logs\Log;
use App\Models\Disciplinas\Disciplina;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

//
class CursoController extends Controller {

    private $curso;
    private $disciplina;
    private $log;

    public function __construct(Curso $curso, Curso $discipllina, Log $log) {

        $this->curso = $curso;
        $this->disciplina = $discipllina;
        $this->log = $log;
    }

    public function index() {
        $title = "Cursos";
        $cursos = $this->curso->all();
        return view('Cursos.listar_cursos', compact('cursos', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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

        $sim_nao = ['SIM', 'NAO'];
        $MEDIACOES = ['PRESENCIAL', 'EDUCAÇÃO A DISTÂNCIA', 'SEMIPRESENCIAL'];
        $MODALIDADES = ['ENSINO REGULAR', 'EDUCAÇÃO ESPECIAL', 'EDUCAÇÃO DE JOVENS E ADULTOS', 'EDUCAÇÃO PROFISSIONAL'];
        $ETAPAS = ['EDUCAÇÃO INFANTIL', 'ENSINO FUNDAMENTAL', 'ENSINO MÉDIO', 'ENSINO SUPERIOR', 'PROFISSIONALIZANTE'];

        $curso = $this->curso->find(Crypt::decrypt($id));
        $title = "Edição de Curso";
        $disciplinas_curso = Curso::with(['curso_disciplinas'])->where('id', Crypt::decrypt($id))->get();
        $arrayDiscipllinas[] = "";

        foreach ($disciplinas_curso as $disciplina) {
            foreach ($disciplina->curso_disciplinas as $disciplina_backup) {
                array_push($arrayDiscipllinas, $disciplina_backup->id);
            }
        }
        array_shift($arrayDiscipllinas);
        $disciplinas_nao_vinculadas = DB::table('disciplinas')->whereNotIn('id', $arrayDiscipllinas)->get();
        //dd($disciplinas_curso);

        return view('Cursos.editar_curso', compact('curso', 'disciplinas_curso', 'disciplinas_nao_vinculadas', 'title', 'sim_nao', 'MEDIACOES', 'MODALIDADES', 'ETAPAS'));
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
//       Backup do curso
        $curso_backup = $this->curso->find(Crypt::decrypt($id));
        $curso_duplicidade = $this->curso->where('NOME', $request->NOME)->count();

        if ($request->NOME !== "$curso_backup->NOME") {
            if ($curso_duplicidade > 0) {
                return redirect()->back()->with('msg_3', 'A Duplicidade de Nome não é Permitida!');
            }
        }
        //
        $form = $request->except(['_token', '_method']);
//        Update dos dados do curso da tabel cursos
        $curso = $this->curso->find(Crypt::decrypt($id));
        $update = $curso->update($form);
//      Preparando para Limpar a tabela curso_disciplinas
//      Backup da Tabel da curso_disciplinas
        $curso_disciplinas = Curso::with(['curso_disciplinas'])->where('id', Crypt::decrypt($id))->get();

        $arrayDisciplinas[] = "";

        foreach ($curso_disciplinas as $disciplina) {
            foreach ($disciplina->curso_disciplinas as $disciplia_backup) {
                array_push($arrayDisciplinas, $disciplia_backup->id);
            }
        }
        array_shift($arrayDisciplinas);
        // Limpando a tabela em questão
        $disciplina_pivot = Curso::findOrfail(Crypt::decrypt($id));
        $disciplina_pivot->curso_disciplinas()->detach($arrayDisciplinas);
//                   
//        Inserindo da Tabela Pivot da disciplinas atuais// 
        $campo_disciplina = "";
        if (isset($request->disciplina_selecionada)) {
            foreach ($request->disciplina_selecionada as $key => $disciplina) {

                $curso_pivot = Curso::findOrfail(Crypt::decrypt($id));

                $disciplina_atual = Disciplina::findOrfail($disciplina);
                $disciplina_atual->cursos()->attach(Crypt::decrypt($id), array('CARGA_HORARIA' => $request->CARGA_HORARIA[$key], 'BOLETIM' => $request->BOLETIM[$key],
                    'BOLETIM_ORD' => $request->BOLETIM_ORD[$key], 'FICHA_DESCRITIVA' => $request->FICHA_DESCRITIVA[$key], 'FICHA_DESCRITIVA_ORD' => $request->FICHA_DESCRITIVA_ORD[$key],
                    'ATA' => $request->ATA[$key], 'ATA_ORD' => $request->ATA_ORD[$key], 'BNC' => $request->BNC[$key], 'BNC_ORD' => $request->BNC_ORD[$key], 'updated_at' => NOW()));

                $disciplinas_base = Disciplina::find($disciplina);
                $campo_disciplina .= "";
            }
        }
        //
//      Inserindo da Tabela Pivot da disciplinas novas
        if (isset($request->disciplina_selecionada_2)) {
            foreach ($request->disciplina_selecionada_2 as $key => $disciplina) {

                $curso_pivot = Curso::findOrfail(Crypt::decrypt($id));

                $disciplina_atual02 = Disciplina::findOrfail($disciplina);
                $disciplina_atual02->cursos()->attach(Crypt::decrypt($id), array('CARGA_HORARIA' => $request->CARGA_HORARIA_DOIS[$key], 'BOLETIM' => $request->BOLETIM_DOIS[$key],
                    'BOLETIM_ORD' => $request->BOLETIM_ORD_DOIS[$key], 'FICHA_DESCRITIVA' => $request->FICHA_DESCRITIVA_DOIS[$key], 'FICHA_DESCRITIVA_ORD' => $request->FICHA_DESCRITIVA_ORD_DOIS[$key],
                    'ATA' => $request->ATA_DOIS[$key], 'ATA_ORD' => $request->ATA_ORD_DOIS[$key], 'BNC' => $request->BNC_DOIS[$key], 'BNC_ORD' => $request->BNC_ORD_DOIS[$key], 'updated_at' => NOW()));
                //
                $disciplinas_base = Disciplina::find($disciplina);
                $campo_disciplina .= "";
            }
        }

        //Redireciona
        if ($update) {
            DB::commit();
            //Traz o usuario
            $usuario = \Auth::user()->name;
//          Faz o Log
            $insert = $this->log->create([
                'USUARIO' => $usuario,
                'TABELA' => 'CURSO_DISCIPLINAS',
                'ACAO' => 'ALTETAR',
                'DETALHES_ACAO' => "Inseriu disciplinas",
            ]);
            return redirect()->route('cursos.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            DB::rollback();
            return redirect()->route('cursos.index')->with('msg_2', 'Falha em Salvar as Alterações!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
//        Limpando os vinculos da Tabela Pivot Histórico
        DB::beginTransaction();
        $curso_dados_delete = DB::table('curso_disciplinas')->where('curso_id', Crypt::decrypt($id))->delete();
        $curso_delete = $this->curso->where('id', Crypt::decrypt($id))->delete();
        //
        if ($curso_delete && $curso_dados_delete) {
            DB::commit();
            // return redirect()->route('histórico', ['id' => $aluno_id, 'id_turma' => ''])->with('msg', 'Alterações Salvas com Sucesso!');
            return redirect()->route('cursos.index')->with('msg', 'Alterações Salvas com Sucesso!');
        } else {
            DB::rollback();
            return redirect()->back()->with('msg_2', 'Falha em Salvar os Dados!');
        }
    }

    //
}
