
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Declaração de Transfrequência</title>
        <style>
            h4{
                margin-left: 24px
            }
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
        @include('bootstrap4');
            {!! Form::open(['url'=>  'alunos/solicitações/transferência/declaração/impressao','class' => 'form-horizontal','name' => 'form1','method'=> 'post'])!!}          
           
            <div class="container-fluid col-sm-12"> 
                @foreach($alunos as $aluno)    
                 <input type="hidden" name="aluno_id" value="{{Crypt::encrypt($aluno->id)}}">
                @foreach($aluno->turmas as $turma)     
                <h4>Aluno: {{$aluno->NOME}},Turma: {{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}} foi ou está?</h4>
                @endforeach                     
                @endforeach 
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-body"> 
                            <h5 class="text-on-pannel">
                                <strong class="text-uppercase"> Dados para a Transferência</strong>
                            </h5> 
                            <div class="form-row">
                                <div class="form-group col-sm-12">                                
                                    <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="CURSANDO">CURSANDO</label>
                                    <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="APROVADO">APROVADO</label>
                                    <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="REPROVADO">REPROVADO</label>
                                    <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="DESISTENTE">DESISTENTE</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">   
                                    {!!Form::label('TURMA', 'Tem direito a matricular-se:',['class' => 'col-sm-3 control-label'])!!}
                                    <div class="col-sm-4">
                                        <select name="turma_id" class="form-control" required="" >
                                            @foreach($aluno_turmas as $aluno)                     
                                            @foreach($aluno->turmas as $turma)   
                                            <option value="{{$turma->id}}">{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</option>
                                            @endforeach                     
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">   
                                    {!!Form::label('', 'Precisa de Transferência ?',['class' => 'col-sm-3 control-label'])!!}
                                    <div class="col-sm-4">
                                        <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="transferencia" value="SIM">SIM</label>
                                        <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="transferencia" value="NAO">NÃO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">                         
                                    <div class="col-sm-4 col-sm-offset-3">                                       
                                        {!! Form:: submit('Imprimir',['class' => 'btn btn-success btn-block','onclick'=>'return confirmar()'])!!}  
                                    </div> 
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        {!! Form:: close()!!} 
    </body>
</html>
