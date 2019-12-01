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
            .notas{max-width: 85px;min-height: 16px;}
            a{text-decoration: none !important;}

            .recuperacao{margin-top: 6px; min-width: 85px}
        </style>
    </head>
    <body>
        @include('Alunos.alunos_css');
        @include('Menu.menu')
        @include('msg')
        {!! Form::model($aluno,['route' => ['historicos.update',Crypt::encrypt($aluno->id)],'class' => '','name' => 'form1','method'=> 'put'])!!}
        <input type="hidden" name="NOME" value="{{$aluno->NOME}}">   
        <input type="hidden" name="CODIGO" value="{{$CODIGO}}">   
        <input type="hidden" name="SEMESTRE" value="{{$SEMESTRE}}">   

        <div class="container-fluid col-sm-12"> 
            <h4 style="text-align: center">Aluno: {{$aluno->NOME}},Turma: {{$turma_historico->TURMA}} - {{$turma_historico->UNICO}} ({{$turma_historico->TURNO}}), Ano: {{$ANO}}</h4>
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-body"> 
                        <h4 class="text-on-pannel">
                            <strong class="text-uppercase"> Dados do aluno </strong>
                        </h4> 
                        <div class="form-row">
                            <div class="form-group col-sm-4">                                
                                {!!Form::label('TURMA', 'TURMA',['class' => ''])!!}
                                {!! Form:: text('TURMA',"{$TURMA}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                            <div class="form-group col-sm-5">  
                                {!!Form::label('TURNO', 'TURNO',['class' => ''])!!}
                                {!! Form:: text('TURNO',"{$TURNO}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            {!!Form::label('UNICO', 'UNICO',['class' => ''])!!}
                            {!! Form:: text('UNICO',"{$UNICO}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('DIAS LETIVOS', 'DIAS LETIVOS',['class' => ''])!!}
                                {!! Form:: number('ALUNO_DIAS',"{$ALUNO_DIAS}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('FREQUÊNCIA', 'FREQUÊNCIA',['class' => ''])!!}
                                {!! Form:: number('ALUNO_FREQUENCIA',"{$ALUNO_FREQUENCIA}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">  
                                {!!Form::label('RECUPERAÇÃO', 'RECUPERAÇÃO',['class' => ''])!!}                               
                                <select name="RECUPERACAO" name ="RECUPERACAO" class="form-control" id="Selrecuperacao">
                                    @if($RECUPERACAO == "SIM") 
                                    <option selected="" value="SIM">SIM</option>                                   
                                    <option value="NAO">NAO</option>                                   
                                    @else 
                                    <option selected="" value="NAO">NAO</option>
                                    <option value="SIM">SIM</option> 
                                    @endif
                                </select>                        
                            </div>
                            <div class="form-group col-sm-6">             
                                {!!Form::label('RESULTADO', 'RESULTADO',['class' => ''])!!}                            
                                <select name="aluno_classificacao_id" class="form-control" > 
                                    @foreach($status as $status_unico)
                                    @if($aluno_classificacao_id == "$status_unico->id")
                                    <option value="{{$status_unico->id}}" selected="">{{$status_unico->STATUS}}</option>
                                    @else 
                                    <option value="{{$status_unico->id}}" >{{$status_unico->STATUS}}</option>
                                    @endif
                                    @endforeach                                                                                      
                                </select>                            
                            </div>

                            <div class="form-row">
                                <div class="form-group col-sm-12"> 
                                    {!!Form::label('Status ', 'Status Atual do Aluno',['class' => ''])!!}                                   
                                    <select name="STATUS" class="form-control" >                             
                                        @foreach($status as $status_unico)
                                        @if($aluno_turma->aluno_classificacao_id == "$status_unico->id")
                                        
                                        <option value="{{$status_unico->id}}" selected="">{{$status_unico->STATUS}}</option> 
                                        @else                               
                                        <option value="{{$status_unico->id}}" >{{$status_unico->STATUS}}</option>   
                                        @endif
                                        @endforeach                                                                                      
                                    </select>                      
                                </div>
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
                            <div class="form-group col-sm-9">                                
                                {!!Form::label('ESCOLA', 'ESCOLA',['class' => ''])!!}
                                {!! Form:: text('ESCOLA',"{$ESCOLA}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                            <div class="form-group col-sm-3">  
                                {!!Form::label('ANO', 'ANO',['class' => ''])!!}
                                {!! Form:: text('ANO',"{$ANO}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','readonly'])!!}  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('DIAS LETIVOS', 'DIAS LETIVOS',['class' => ''])!!}
                                {!! Form:: number('ESCOLA_DIAS',"{$ESCOLA_DIAS}",['class' => 'form-control', 'placeholder' =>'Esse Campo só Aceita Números' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','min'=> '0'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('HORAS LETIVAS', 'HORAS LETIVAS',['class' => ''])!!}
                                {!! Form:: number('ESCOLA_HORAS',"{$ESCOLA_HORAS}",['class' => 'form-control', 'placeholder' =>'Esse Campo só Aceita Números' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','min'=> '0'])!!}  
                            </div>
                        </div>                       
                        <div class="form-row">
                            <div class="form-group col-sm-6">                                
                                {!!Form::label('CIDADE', 'CIDADE',['class' => ''])!!}
                                {!! Form:: text('CIDADE',"{$CIDADE}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                            <div class="form-group col-sm-6">  
                                {!!Form::label('ESTADO', 'ESTADO',['class' => ''])!!}
                                {!! Form:: text('ESTADO',"{$ESTADO}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12"> 
                                {!!Form::label('CURSO', 'CURSO',['class' => ''])!!}
                                <select class='form-control' name='curso_id' style="width: 100% !important" id="" readonly = "">   
                                    @foreach ($cursos as $curso)
                                    @if($curso_id == "$curso->id")
                                    <option value="{{$curso->id}}" selected="" >{{$curso->NOME}}</option>                                
                                    @endif
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class=" col-sm-4" >
                    <a href='{{route('histórico',['id' => Crypt::encrypt($aluno->id)])}}' target='_self'  title='Históricos'> <button type="button" value="" title="" class="btn btn-primary btn-block" >Cadastrar Um Novo Histórico</button></a>                  
                </div>
                <div class=" col-sm-3" >
                    <button type="submit" value="Enviar" title="" class="btn btn-success btn-block" onclick="return validaCheckbox()" id="button">Atualizar Esse Histórico</button>                       
                </div>
                <div class=" col-sm-3" >
                    <a href="{{route('histórico_transferência',['id' => Crypt::encrypt($aluno->id)])}}"> <button type="button"  name=" " value="" title="" class="btn btn-warning btn-block" >Ir Para Solicitações de Transferências</button></a>                  
                </div>                  
                <div class=" col-sm-2" >
                    <a href='{{route('historico_excluir',['id' => $CODIGO,'aluno_id' => Crypt::encrypt($aluno->id)])}}' target='_self' title='Históricos'><button type="button"  name="botao" value="" title="Excluir Histórico Atual" class="btn btn-danger btn-block" >Exlcuir Histórico Atual</button> </a>                
                </div>      
            </div> <br> 
            <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>BIMESTRES</th>
                        @foreach ($curso_disciplinas as $disciplina_id)

                        @foreach ($aluno->historicos_alunos as $disciplina) 
                        @if ($disciplina->pivot->BIMESTRE == 1 && $disciplina->pivot->disciplina_id == $disciplina_id->disciplina_id)

                        <th>{{$disciplina->DISCIPLINA}}</th>
                <input name="DISCIPLINAS[]" hidden="" value="{{$disciplina->pivot->disciplina_id}}">
                @endif
                @endforeach 

                @endforeach  
                <th>FALTAS</th>
                </tr>
                </thead>
                <tr>
                    @foreach($bimestres as $bimestre) 

                    @if($bimestre=="1")                   
                    <th>B - I</th>
                    @elseif($bimestre=="2")
                    <th>B - II</th>
                    @elseif($bimestre=="3")
                    <th>B - III</th>
                    @elseif($bimestre=="4")
                    <th>B - IV</th>
                    @elseif($bimestre=="media")
                    <th>B - Media</th>
                    @elseif($bimestre=="final")
                    <th> Final</th>
                    @elseif($bimestre=="media_final")
                    <th> Media Final</th>                 
                    @endif

                    @foreach ($curso_disciplinas as $disciplina_id) 

                    @foreach ($aluno->historicos_alunos as $disciplina) 

                    @if ($disciplina->pivot->BIMESTRE == $bimestre && $disciplina->pivot->disciplina_id == $disciplina_id->disciplina_id)
                    @if($bimestre=="1")
                    <th>
                        <input class="notas" type="number" min="0" step="0.01" name="1[]" value="{{$disciplina->pivot->NOTA}}">
                    </th>   
                    @elseif($bimestre=="2")
                    <th>
                        <input class="notas"  type="number" min="0" step="0.01" name="2[]" value="{{$disciplina->pivot->NOTA}}">
                    </th> 
                    @elseif($bimestre=="3")
                    <th>
                        <input class="notas"  type="number" min="0" step="0.01" name="3[]" value="{{$disciplina->pivot->NOTA}}">
                    </th> 
                    @elseif($bimestre=="4")
                    <th>
                        <input class="notas"  type="number" min="0" step="0.01" name="4[]" value="{{$disciplina->pivot->NOTA}}">
                    </th> 
                    @elseif($bimestre=="media")
                    <th>
                        <input class="notas"  type="number" min="0" step="0.01" name="media[]" value="{{$disciplina->pivot->NOTA}}">
                    </th> 
                    @elseif($bimestre=="final")
                    <th>
                        <input class="notas"  type="number" min="0" step="0.01" name="final[]" value="{{$disciplina->pivot->NOTA}}">
                    </th> 
                    @elseif($bimestre=="media_final")
                    <th>
                        <input class="notas"  type="number" min="0" step="0.01" name="media_final[]" value="{{$disciplina->pivot->NOTA}}">
                        <br>
                        <select name="recuperacao[]" class="recuperacao">                            
                            @if($disciplina->pivot->RECUPERACAO == "SIM")                            
                            <option selected="">SIM</option>
                            <option>NAO</option>                            
                            @else                            
                            <option selected="">NAO</option>
                            <option>SIM</option>                            
                            @endif                            
                        </select>
                    </th>

                    @endif

                    @endif

                    @endforeach 

                    @endforeach 

                    @foreach ($historicos_alunos_group as $key => $value) 
                    @if ($key == $bimestre)
                    @foreach ($value as $key2 => $faltas) 
                    @if ($key2 == 0)                    
                    <th>
                        <input class="notas"  type="number" min="0" step="1" name="FALTAS[]" value="{{$faltas->FALTAS}}">
                    </th>
                    @endif
                    @endforeach  
                    @endif
                    @endforeach 
                </tr>

                @endforeach  
                <tbody>  
                    <tr>

                    </tr>
                </tbody>
            </table>
            <div class="col-sm-12" id="observacao">
                <div class="panel panel-primary">
                    <div class="panel-body"> 
                        <h4 class="text-on-pannel">
                            <strong class="text-uppercase">Observações:</strong>
                        </h4> 
                        <div class="form-row">
                            <div class=" col-sm-12">                                
                                {!! Form:: text('T1',"{$T1}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class=" col-sm-12">                                
                                {!! Form:: text('T2',"{$T2}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class="col-sm-12">                                
                                {!! Form:: text('T3',"{$T3}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class=" col-sm-12">                                
                                {!! Form:: text('T4',"{$T4}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class=" col-sm-12">                                
                                {!! Form:: text('T5',"{$T5}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class="col-sm-12">                                
                                {!! Form:: text('T6',"{$T6}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class=" col-sm-12">                                
                                {!! Form:: text('T7',"{$T7}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                            <div class="col-sm-12">                                
                                {!! Form:: text('T8',"{$T8}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength' => '52'])!!}  
                            </div>                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        {!! Form:: close()!!} 
        @include('Alunos.editar_historico_tabela')
    </body>
    <script type="text/javascript">
        $(document).ready(function () {


//            if ($('#Selrecuperacao').val() == 'NAO') {
//                $(".recuperacao").hide(2000);
//            } else {
//                $(".recuperacao").show(2000);
//            }
//            //
//            $('#Selrecuperacao').change(function () {
//                if ($('#Selrecuperacao').val() == 'NAO') {
//                    $(".recuperacao").hide(2000);
//                } else {
//                    $(".recuperacao").toggle(2000);
//                }
//            });
        });
    </script>
</html>
