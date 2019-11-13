<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            #inputobs{
                width: 100%;
            }
        </style>
    </head>
    <body>
        @include('Alunos.alunos_css')
        @include('Menu.menu')
        {!!Form::open(['url' => 'alunos/solicitações/transferência/update','name' => 'form1','class'=>'form-control'])!!}  
        <div class="container">           
            <h4 style="text-align:center; margin-top: 36px">Folha de Rosto da Transferência</h4>
            <div class="row">
                <div class="form-group col-sm-12">
                    {!!Form::label('Nome do Aluno(a)', 'Nome do Aluno(a)',['class' => 'col-sm-3 control-label'])!!}
                    <div class="col-sm-8">
                        {!! Form:: text('NOME',"{$aluno->NOME}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  

                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">                   
                    {!!Form::label('Nascimento', 'Nascimento',['class' => 'col-sm-3 control-label'])!!}
                    <div class="col-sm-8">
                        {!! Form:: date('NASCIMENTO',"{$aluno->NASCIMENTO}",['class' => 'form-control', 'placeholder' =>'' ])!!}  
                    </div>
                </div>
            </div>           
            <div class="row">
                <div class="form-group col-sm-12">                    
                    {!!Form::label('TURMA', 'Concluiu a Turma',['class' => 'col-sm-3 control-label'])!!}
                    <div class="col-sm-8">
                        <select name="TURMA" class="form-control" required="" id="inputTurma">   
                            <option  selected value = '' id = 'branco'>SELECIONE A TURMA DESEJADA AQUI ! </option>
                            @foreach($turmas as $turma_unica) 
                            <option value="{{$turma_unica->TURMA}}">{{$turma_unica->TURMA}}  {{$turma_unica->UNICO}} - {{$turma_unica->TURNO}}</option>                          
                            @endforeach 
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="hidden" value="{{$transferencia->id}}" name="id">
                <input type="hidden" value="{{$transferencia->aluno_id}}" name="aluno_id">
                <div class="form-group col-sm-12"> 
                    <label for="" class="col-sm-3 control-label">Observações</label>
                    <div class="col-sm-8">                             
                        {!! Form:: text('T1',"{$transferencia->T1}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                        {!! Form:: text('T2',"{$transferencia->T2}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                        {!! Form:: text('T3',"{$transferencia->T3}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                        {!! Form:: text('T4',"{$transferencia->T4}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                        {!! Form:: text('T5',"{$transferencia->T5}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                        {!! Form:: text('T6',"{$transferencia->T6}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                        {!! Form:: text('T7',"{$transferencia->T7}",['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','maxlength'=>'86'])!!}  
                    </div>
                </div>                  
            </div>             
            <div class="row">
                <div class="form-group col-sm-12"> 
                    <label for="" class="col-sm-3 control-label">Ações</label> 
                    <div class="col-sm-3">                                                  
                        <button type="submit"  name = "botao" value="folha_rosto_servidor" class="btn btn-success btn-block" id = "folha_rosto" disabled="" title = "Para Desbloquear Esse Botão Informe o Último Ano de Conclusão:) ">Salvar</button>
                    </div>    
                    <div class="col-sm-2">                                                  
                        <a href="javascript:history.back()" class="btn btn-warning btn-block">Voltar</a>
                    </div>    
                    <div class="col-sm-3">                           
                        <button type="reset" class="btn btn-danger btn-block" id="reset" >Limpar</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form:: close()!!}    
        <script type="text/javascript">
            $(document).ready(function () {
                $('#inputTurma').change(function () {
                    if ($('#inputTurma').val() !== 'branco') {
                        $('#folha_rosto').removeAttr('disabled');
                    }
                });
            });
        </script>   
    </body>
</html>
