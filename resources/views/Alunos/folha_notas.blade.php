<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Notas</title>
        <style>
            @media (max-width: 720px) {.btvalida{margin-bottom: 12px !important}};
           
        </style>
    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        {!!Form::open(['url' => 'alunos/solicitações/transferência/update','class' => 'form-horizontal','name' => 'form1'])!!}
         <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}"> 
        <div class="container">          
           <p style="margin: 36px; font-size: 14px">Montar a Transferência de: {{$aluno->NOME}},TURMA: {{$turma_atual}},CURSO: {{$cursos->NOME}}</p>
            @foreach($todas_turmas as $turma)
            <div class="row">
                <div class="form-group col-sm-12">                   
                    {!!Form::label("{$turma}", "{$turma}",['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-5">
                        <select class='form-control' name="CODIGO[]" style="width: 100% !important">  
                            <option  selected="" value="">Escolha um do(s) Histórico Aqui!</option>
                            @forelse ($historico_dados as $key => $value)
                            @foreach ($todos_cursos as $curso)
                            @if($value->curso_id =="$curso->id")                         
                            <option value="{{$value->CODIGO}}">Ano: {{$value->ANO}} , Semestre/Ano: {{$value->SEMESTRE}} , Curso: {{$curso->NOME}}</option>
                            @endif
                            @endforeach
                            @empty
                            <option>O Aluno(a) não tem Histórico Cadastrado!</option>
                            @endforelse
                        </select>
                    </div>                  
                </div>
            </div>
            @endforeach 
            <div class="row">
                <div class="form-group col-sm-12"> 
                    <label for="" class="col-sm-2 control-label">Ações</label>
                    <div class="col-sm-2">
                        <button type="submit" name="botao" value="folha_notas_visualizar" class="btn btn-success btn-block btvalida" >Visualizar</button>                           
                    </div>
                    <div class="col-sm-2">                                                  
                        <button type="submit" name="botao"  value="folha_notas_pdf" class="btn btn-primary btn-block btvalida" >PDF</button>                
                    </div> 
                    <div class="col-sm-2">                                                  
                        <a href="javascript:history.back()" class="btn btn-warning btn-block btvalida">Voltar</a>
                    </div> 
                    <div class="col-sm-2">                           
                        <button type="reset" class="btn btn-danger btn-block btvalida">Limpar</button>
                    </div>
                </div>
            </div>



        </div>
        {!! Form:: close()!!}      
    </body>
</html>
