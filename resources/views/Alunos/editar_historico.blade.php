
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>{{$title or 'Scholl 2019'}}</title>
        <style>
            .text-on-pannel { 
                background: #fff none repeat scroll 0 0; 
                height: auto; margin-left: 20px; 
                padding: 3px 5px; position: absolute; margin-top: -47px; border: 1px solid #337ab7; border-radius: 8px;
            } 
            .panel { margin-top: 27px !important; } 
            .panel-body { padding-top: 30px !important; } 
            .label_margin{margin-top: 12px !important}
        </style>
    </head>
    <body>
        @include('Alunos.alunos_css');
        @include('Menu.menu')
        {!! Form::model($aluno,['route' => ['historicos.update',$aluno->id],'class' => '','name' => 'form1','method'=> 'put'])!!}

        <div class="container-fluid col-sm-12"> 
            <h4 style="text-align: center">Aluno:</h4>

            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-body"> 
                        <h4 class="text-on-pannel">
                            <strong class="text-uppercase"> Dados do aluno </strong>
                        </h4> 
                        <div class="form-row">
                            <div class="form-group col-sm-4">                                
                                {!!Form::label('TURMA', 'TURMA',['class' => ''])!!}
                                {!! Form:: text('TURMA',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                            <div class="form-group col-sm-5">  
                                {!!Form::label('TURNO', 'TURNO',['class' => ''])!!}
                                {!! Form:: text('TURNO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            {!!Form::label('UNICO', 'UNICO',['class' => ''])!!}
                            {!! Form:: text('UNICO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('DIAS LETIVOS', 'DIAS LETIVOS',['class' => ''])!!}
                                {!! Form:: text('DIAS_LETIVOS',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('FREQUÊNCIA', 'FREQUÊNCIA',['class' => ''])!!}
                                {!! Form:: text('FREQUENCIA',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('RECUPERAÇÃO', 'RECUPERAÇÃO',['class' => ''])!!}
                                {!! Form:: text('ESCOLA',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('RESULTADO', 'RESULTADO',['class' => ''])!!}
                                {!! Form:: text('RESULTADO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-body"> 
                        <h4 class="text-on-pannel">
                            <strong class="text-uppercase"> Dados da Escola </strong>
                        </h4> 
                        <div class="form-row">
                            <div class="form-group col-sm-8">                                
                                {!!Form::label('ESCOLA', 'ESCOLA',['class' => ''])!!}
                                {!! Form:: text('RECUPERACAO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                            <div class="form-group col-sm-4">  
                                {!!Form::label('ANO', 'ANO',['class' => ''])!!}
                                {!! Form:: text('ANO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('DIAS LETIVOS', 'DIAS LETIVOS',['class' => ''])!!}
                                {!! Form:: text('ESCOLA_DIAS',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('HORAS LETIVAS', 'HORAS LETIVAS',['class' => ''])!!}
                                {!! Form:: text('ESCOLA_HORAS',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                        </div>                       
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('CIDADE', 'CIDADE',['class' => ''])!!}
                                {!! Form:: text('CIDADE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('ESTADO', 'ESTADO',['class' => ''])!!}
                                {!! Form:: text('ESTADO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
            <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>BIMESTRES</th>
                        @foreach ($aluno->historicos_alunos as $disciplina) 
                        @if ($disciplina->pivot->BIMESTRE == 1)
                        <th>{{$disciplina->DISCIPLINA}}</th>
                        @endif
                        @endforeach  
                    </tr>

                    <tr>
                        @foreach($bimestres as $bimestre)                                            
                        <th>{{$bimestre}}</th>
                        
                        @foreach ($aluno->historicos_alunos as $disciplina) 

                        @if ($disciplina->pivot->BIMESTRE == $bimestre)
                        <th><input type="number" min="0" name=" {{$disciplina->pivot->disciplina_id }}">{{$disciplina->pivot->disciplina_id }}</th>  

                        @endif

                        @endforeach 
                    </tr>
                    @endforeach    

                </thead>

                <tbody>  
                    <tr>

                    </tr>
                </tbody>

            </table>














        </div>
        {!! Form:: close()!!}       
    </body>
</html>
