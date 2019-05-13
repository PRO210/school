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
        <script src="{{url('assets/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{url('assets/css/responsive.dataTables.min.css')}}">

        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme.min.css')}}" type="text/css"> 
        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme.min.css.map')}}" type="text/css"> 
        <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" type="text/css" > 

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">       
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        
        <script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
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
            {!! Form::model($aluno,['route' => ['alunos.update',$aluno->id],'class' => 'form-horizontal','name' => 'form1','method'=> 'put'])!!}

            @else
            {!! Form::open(['route' => 'alunos.store','class' => 'form-horizontal','name' => 'form1'])!!}           

            @endif
            <div class="row">
                <div class="form-group col-sm-12">
                    {!!Form::label('TURMA', 'Escolha a Turma',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('TURMA',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                    </div>
                    {!!Form::label('INEP', 'INEP',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: number('inep',null,['class' => 'form-control', 'placeholder' => 'Use Somente Números', 'min' => '0','max' => '999999999999'])!!}  
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
                    @if (isset($aluno))

                    @if($aluno->CERTIDAO_CIVIL == "RG")
                    {!!Form::label('Número do RG', 'Número do RG',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('NUMERO_RG',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    {!!Form::label('Orgão Expedidor', 'Orgão Expedidor',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('ORGAO_EXPEDIDOR_RG',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    @else  
                    @if($aluno->MODELO_CERTIDAO == "NOVO")
                    {!!Form::label('Matricula da Certidão', 'Matricula da Certidão',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('MATRICULA_CERTIDAO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    @else 
                    {!!Form::label('Dados da Certidão', 'Dados da Certidão',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('DADOS_CERTIDAO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    @endif

                    @endif

                    {!!Form::label('Data de Expedição', 'Data de Expedição',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: date('EXPEDICAO_CERTIDAO',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                    </div>

                    @else

                    {!!Form::label('Matricula da Certidão', 'Matricula da Certidão',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('MATRICULA_CERTIDAO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    {!!Form::label('Dados da Certidão', 'Dados da Certidão',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('DADOS_CERTIDAO',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    {!!Form::label('Data de Expedição', 'Data de Expedição',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: date('EXPEDICAO_CERTIDAO',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                    </div>

                    @endif

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
            <script type="text/javascript" >
$(function () {
    $("#NIS").mask("999.9999.9999", {reverse: true});
});
            </script>
            <div class="row">
                <div class="form-group col-sm-12">   
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
                    {!!Form::label('Nis', 'Nis',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('NIS',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','id' => 'NIS'])!!}  
                    </div>










                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">                
                    {!!Form::label('Nome da Mãe', 'Nome da Mãe',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('MAE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)'])!!}  
                    </div>
                    {!!Form::label('Profissão da Mãe', 'Profissão da Mãe',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('PROF_MAE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)'])!!}  
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">                
                    {!!Form::label('Nome da Pai', 'Nome da Pai',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('PAI',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)'])!!}  
                    </div>
                    {!!Form::label('Profissão da Pai', 'Profissão da Pai',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('PROF_PAI',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)'])!!}  
                    </div>

                </div>
            </div>
            <div class="form-group col-sm-6">
                {!! Form:: submit('Enviar',['class' => 'btn btn-primary'])!!}  
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