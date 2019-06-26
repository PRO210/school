<?php

namespace App\Http\Controllers\Disciplinas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Disciplinas\Disciplina;

class DisciplinaController extends Controller {

    private $disciplina;

    public function __construct(Disciplina $disciplina) {

        $this->disciplina = $disciplina;
    }

//
//    
    public function index() {

        $title = "Gerenciamento de Disciplinas";
        $disciplinas = $this->disciplina->all();

        return view('Disciplinas.listar_disciplinas', compact('disciplinas', 'title'));
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

    public function updatebloco(Request $request) {
        
//        return redirect()->route('disciplinas.index')->with('msg','Parabéns');
        return 'updatebloco';
    }

}
