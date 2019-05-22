<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Gestão de Alunos'}}</title>

        <script src="{{url('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>           
        <script src="{{url('assets/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>

        <script src="{{url('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

        <link rel="stylesheet" href="{{url('assets/css/dataTables.bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" type="text/css">
        <script src="{{url('assets/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
        <script src="{{url('js/bootstrap.min.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{url('assets/css/responsive.dataTables.min.css')}}">

        <script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/js/jquery.maskedinput.js')}}" type="text/javascript"></script>

        <style>
            @media (max-width: 790px) {#FONE_II{margin-top: 12px}                                    
            </style>
        </head>
        <body>
            @include('Menu.menu');
            <div class="container-fluid">
                <h3 style="text-align:center;font">{{$title or 'Gestão de Alunos'}}</h3>

                @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
                </div>         
                @endif
                {{-- // --}}
                @if (isset($aluno))
                {!! Form::model($aluno,['route' => ['alunos.update',$aluno->ID],'class' => 'form-horizontal','name' => 'form1','method'=> 'put'])!!}
                @else
                {!! Form::open(['route' => 'alunos.store','class' => 'form-horizontal','name' => 'form1'])!!}          
                @endif
                <div class="row">
                    <div class="form-group col-sm-12">                    
                        {!!Form::label('TURMA', 'Escolha a Turma',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="TURMA" class="form-control" >
                                @if (isset($aluno))

                                @foreach($turmas as $turma_unica)
                                
                                    @if($turma_unica->id  == "$turma->id")
                                    <option>{{$turma_unica->TURMA}}</option>
                                    @else
                                    
                                    @endif
                                <option value="{{$turma_unica->id}}">{{$turma_unica->TURMA}}  {{$turma_unica->UNICO}} - {{$turma_unica->TURNO}}</option>                          
                                @endforeach 
                              



                                @else
                                @foreach($turmas as $turma_unica)                                  
                                <option value="{{$turma_unica->id}}">{{$turma_unica->TURMA}}  {{$turma_unica->UNICO}} - {{$turma_unica->TURNO}}</option>                          
                                @endforeach 


                                @endif
                            </select>
                        </div>                          
                        {!!Form::label('Status', 'Status',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">                           
                            <select name="STATUS" class="form-control" >                        

                                <option value=""></option>                          

                            </select>
                        </div> 
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Nome do Aluno(a)', 'Nome do Aluno(a)',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('NOME',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>
                        {!!Form::label('Nascimento', 'Nascimento',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: date('NASCIMENTO',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Inep', 'Inep',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: number('INEP',null,['class' => 'form-control', 'placeholder' => 'Use Somente Números', 'min' => '0','max' => '999999999999'])!!}  
                        </div>
                        {!!Form::label('Fones', 'Fones',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-2">
                            <script type="text/javascript">
$(function () {
    $("#FONE").mask("99-99999-9999");
});
                            </script>
                            {!! Form:: text('FONE',null,['class' => 'form-control', 'placeholder' => 'XX-XXXXX-XXXX','id'=>'FONE'])!!}  
                        </div>
                        <div class="col-sm-2">
                            <script type="text/javascript">
                                $(function () {
                                    $("#FONE_II").mask("99-99999-9999");
                                });
                            </script>
                            {!! Form:: text('FONE_II',null,['class' => 'form-control', 'placeholder' => 'XX-XXXXX-XXXX','id'=>'FONE_II'])!!}  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        {!!Form::label('Modelo da Certidão', 'Modelo da Certidão',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="MODELO_CERTIDAO" class="form-control" >
                                @if (isset($aluno))
                                @foreach($certidoes as $certidao)
                                @if($certidao == "$aluno->MODELO_CERTIDAO")
                                <option value="{{$certidao}}" selected="">{{$certidao}}</option>
                                @else
                                <option value="{{$certidao}}">{{$certidao}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($certidoes as $certidao)                           
                                <option value="{{$certidao}}">{{$certidao}}</option>                          
                                @endforeach 
                                @endif                             
                            </select>
                        </div>
                        {!!Form::label('Certidão Civil', 'Certidão Civil',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="CERTIDAO_CIVIL" class="form-control" >
                                @if (isset($aluno))

                                @foreach($tiposcertidoes as $tipocertidao)
                                @if($tipocertidao == "$aluno->CERTIDAO_CIVIL")
                                <option value="{{$tipocertidao}}" selected="">{{$tipocertidao}}</option>
                                @else
                                <option value="{{$tipocertidao}}">{{$tipocertidao}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($tiposcertidoes as $tipocertidao)
                                <option value="{{$tipocertidao}}" selected="">{{$tipocertidao}}</option>
                                @endforeach 
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Naturalidade', 'Naturalidade',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('NATURALIDADE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>
                        {!!Form::label('Estado', 'Estado',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('ESTADO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>                                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Nacionalidade', 'Nacionalidade',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('NACIONALIDADE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>
                        {!!Form::label('Sexo', 'Sexo',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="SEXO" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($sexos as $sexo)
                                @if($sexo == "$aluno->SEXO")
                                <option value="{{$sexo}}" selected="">{{$sexo}}</option>
                                @else
                                <option value="{{$sexo}}">{{$sexo}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($sexos as $sexo)
                                <option value="{{$sexo}}" selected="">{{$sexo}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">  
                        <script type="text/javascript" >
                            $(function () {
                                $("#NIS").mask("999.9999.9999", {reverse: true});
                            });
                        </script>
                        {!!Form::label('Nis', 'Nis',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('NIS',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','id' => 'NIS'])!!} 
                        </div>                     
                        {!!Form::label('Bolsa Família', 'Bolsa Família',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="BOLSA_FAMILIA" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($bolsas as $bolsa)
                                @if($bolsa == "$aluno->BOLSA_FAMILIA")
                                <option value="{{$bolsa}}" selected="">{{$bolsa}}</option>                         
                                @else
                                <option value="{{$bolsa}}">{{$bolsa}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($bolsas as $bolsa)
                                <option value="{{$bolsa}}" selected="">{{$bolsa}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        {!!Form::label('Endereço', 'Endereço',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('ENDERECO',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div> 
                        {!!Form::label('Urbano', 'Urbano',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="URBANO" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($urbanos as $urbano)
                                @if($urbano == "$aluno->URBANO")
                                <option value="{{$urbano}}" selected="">{{$urbano}}</option>                         
                                @else
                                <option value="{{$urbano}}">{{$urbano}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($urbanos as $urbano)
                                <option value="{{$urbano}}" selected="">{{$urbano}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        {!!Form::label('Cidade', 'Cidade',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('CIDADE',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div> 
                        {!!Form::label('Estado', 'Estado',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('CIDADE_ESTADO',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        {!!Form::label('Transporte', 'Transporte',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="TRANSPORTE" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($transportes as $transporte)
                                @if($transporte == "$aluno->TRANSPORTE")
                                <option value="{{$transporte}}" selected="">{{$transporte}}</option>                         
                                @else
                                <option value="{{$transporte}}">{{$transporte}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($transportes as $transporte)
                                <option value="{{$transporte}}" selected="">{{$transporte}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>
                        {!!Form::label('Cor', 'Cor',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="COR" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($cores as $cor)
                                @if($cor == "$aluno->COR")
                                <option value="{{$cor}}" selected="">{{$cor}}</option>                         
                                @else
                                <option value="{{$cor}}">{{$cor}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($cores as $cor)
                                <option value="{{$cor}}" selected="">{{$cor}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        {!!Form::label('Motorista', 'Motorista',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="MOTORISTA" class="form-control" >                        
                                <option>INCOMPLETO </option>
                            </select>
                        </div>
                        {!!Form::label('Motorista II', 'Motorista II',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="MOTORISTA_II" class="form-control" >                        
                                <option>INCOMPLETO II </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">                  
                        {!!Form::label('Pontos de Ônibus Conhecidos', 'Pontos de Ônibus Conhecidos',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="" class="form-control" >                        
                                <option>Pontos conhecidos </option>
                            </select>
                        </div>                    
                        {!!Form::label('Pontos de Ônibus Escolhido', 'Ponto de Ônibus Escolhido',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="PONTO_ONIBUS" class="form-control" >                        
                                <option>Ponto Escolhido </option>
                            </select>
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        {!!Form::label('Declaração', 'Declaração',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="DECLARACAO" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($declaracoes as $declaracao)
                                @if($declaracao == "$aluno->DECLARACAO")
                                <option value="{{$declaracao}}" selected="">{{$declaracao}}</option>                         
                                @else
                                <option value="{{$declaracao}}">{{$declaracao}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($declaracoes as $declaracao)
                                <option value="{{$declaracao}}" selected="">{{$declaracao}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>
                        {!!Form::label('Transferência', 'Transferência',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="TRANSFERENCIA" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($transferencias as $transferencia)
                                @if($transferencia == "$aluno->TRANSFERENCIA")
                                <option value="{{$transferencia}}" selected="">{{$transferencia}}</option>                         
                                @else
                                <option value="{{$transferencia}}">{{$transferencia}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($transferencias as $transferencia)
                                <option value="{{$transferencia}}" selected="">{{$transferencia}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Responsável pela Declaração', 'Responsável pela Declaração',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('DECLARACAO_RESPONSAVEL',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div>                      
                        {!!Form::label('Responsável pela Transferência', 'Responsável pela Transferência',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('TRANSFERENCIA_RESPONSAVEL',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div>                       
                    </div>
                </div>            
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Data da Declaração', 'Data da Declaração',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: date('DECLARACAO_DATA',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div> 
                        {!!Form::label('Data da Transferência', 'Data da Transferência',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: date('TRANSFERENCIA_DATA',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div>  
                    </div>
                </div>                
                <div class="row">
                    <div class="form-group col-sm-12">                        
                        {!!Form::label('Data da Matricula', 'Data da Matricula',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: date('MATRICULA',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div> 
                        {!!Form::label('Renovação da Matricula', 'Renovação da Matricula',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: date('MATRICULA_RENOVADA',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                        </div>  
                    </div>
                </div>                
                <div class="row">
                    <div class="form-group col-sm-12">                        
                        {!!Form::label('Ouvinte', 'Ouvinte',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="OUVINTE" class="form-control" >                        
                                @if (isset($aluno))
                                @foreach($ouvintes as $ouvinte)
                                @if($ouvinte == "$aluno->OUVINTE")
                                <option value="{{$ouvinte}}" selected="">{{$ouvinte}}</option>                         
                                @else
                                <option value="{{$ouvinte}}">{{$ouvinte}}</option>
                                @endif
                                @endforeach  
                                @else
                                @foreach($ouvintes as $ouvinte)
                                <option value="{{$ouvinte}}" selected="">{{$ouvinte}}</option>
                                @endforeach 
                                @endif                            
                            </select>
                        </div>                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">                       
                        {!!Form::label('Observações', '',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-10">
                            @if (isset($aluno))
                            {!!Form:: textarea('OBSERVACOES', "{$aluno->OBSERVACOES}",['class' => 'col-sm-2 form-control','rows'=>'4'])!!}
                            @else
                            {!!Form:: textarea('OBSERVACOES', null,['class' => 'col-sm-2 form-control','rows'=>'4'])!!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">                         
                        <div class="col-sm-4 col-sm-offset-2">
                            @if (isset($aluno))
                            {!! Form:: submit('Atualizar os Dados',['class' => 'btn btn-success btn-block','onclick'=>'return confirmarAtualizacao()'])!!}  
                            @else
                            {!! Form:: submit('Cadastrar',['class' => 'btn btn-success btn-block','onclick'=>'return confirmarAtualizacao()'])!!}  
                            @endif
                        </div> 
                        <div class="col-sm-4 col-sm-offset-2">                            
                            <a href="javascript:history.back()" class="btn btn-primary btn-block">Voltar Para a Página Anterior</a>
                        </div> 

                    </div>
                </div>    
                {!! Form:: close()!!}        
            </div>
            <script type="text/javascript">
                // INICIO FUNÇÃO DE MASCARA MAIUSCULA
                function maiuscula(z) {
                    v = z.value.toUpperCase();
                    z.value = v;
                }
            </script>
            <script type="text/javascript">
                $('input').on("input", function (e) {
                    $(this).val($(this).val().replace('"', ""));
                    $(this).val($(this).val().replace("'", ""));

                });
            </script>
            <script type="text/javascript">
                $(function () {
                    $("#alvo").keyup(function () {
                        var tamanho = $("#alvo").val().length;
                        $("#aqui").html(tamanho);
                    });
                });
            </script>
        </body>
    </html>