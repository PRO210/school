<?php

namespace App\Http\Controllers\Arquivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Arquivos\Arquivo;
use App\Models\Alunos\Aluno;
use Illuminate\Support\Facades\DB;
use App\Models\Logs\Log;
use Illuminate\Support\Facades\Crypt;

class ArquivoController extends Controller {

    private $arquivo;
    private $aluno;
    private $log;

    //
    public function __construct(Arquivo $arquivo, Aluno $aluno, Log $log) {
        //
        $this->arquivo = $arquivo;
        $this->aluno = $aluno;
        $this->log = $log;
    }

    public function index() {
        //
        // $alunos = $this->aluno->where('EXCLUIDO', 'SIM');
        $arquivado = Aluno::with('grupos')->where('EXCLUIDO', 'SIM')->get()->first();
        $arquivados = Aluno::with('grupos')->where('EXCLUIDO', 'SIM')->get();

        $string = "olá à mim! ñ";

        function tirarAcentos($string) {
            return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
        }

        if ($arquivado == null) {
            $teste = 0;
        } else {
            $teste = 1;
        }
        $pastas = $this->arquivo->all();
        $arrayPasta = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        //       
        return view('Arquivos.listar_arquivo', compact('pastas', 'arquivados', 'arquivado', 'teste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $pastas = $this->arquivo->all();
       // dd($pastas);

        return view('Arquivos.editar_arquivo', compact('pastas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        dd($request);
        
        
        
        
        
        
        
        
        
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        if ($request->botao == "retirar") {
            foreach ($request->aluno_selecionado as $id) {
                $ids = explode('/', $id);
                $id_aluno = $ids[0];
                $id_turma = $ids[1];
                $aluno_update = \DB::table('alunos')->where('id', $id_aluno)->update(['EXCLUIDO' => 'NAO', 'EXCLUIDO_PASTA' => '']);
            }
            //O id_turma é para montar view, mas o id usado é o de sem turma nesse caso  id = 0;Para evitar a duplicidad de turma.
            if ($aluno_update) {
                return redirect()->action('Alunos\AlunoController@editar', ['id' => Crypt::encrypt($id_aluno), 'id_turma' => $id_turma])->with('msg', 'Por Favor Atualize os Campos se Necessário!');
            } else {
                return redirect()->back()->with('erro', 'As Alterações Não Foram Salvas !');
            }
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
