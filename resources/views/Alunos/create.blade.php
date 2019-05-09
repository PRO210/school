<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title or 'Gestão de Alunos'}}</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">  
    <script src="{{url('js/jquery-1.12.4.js')}}" type="text/javascript"></script>           
    <script src="{{url('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{url('css/dataTables.bootstrap.min.css')}}">
    <script src="{{url('js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{url('css/responsive.dataTables.min.css')}}">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     Optional theme 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
     Latest compiled and minified JavaScript 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
    -->
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
                {!!Form::label('turma', 'Escolha a Turma',['class' => 'col-sm-2 control-label'])!!}
                <div class="col-sm-4">
                    {!! Form:: text('id_turma',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                </div>
                {!!Form::label('inep', 'Inep',['class' => 'col-sm-2 control-label'])!!}
                <div class="col-sm-4">
                    {!! Form:: number('inep',null,['class' => 'form-control', 'placeholder' => 'Use Somente Números', 'min' => '0','max' => '999999999999'])!!}  
                </div>
            </div>
        </div>     

        <div class="row">
            <div class="form-group col-sm-12">
                {!!Form::label('Nome do Aluno(a)', 'Nome do Aluno(a)',['class' => 'col-sm-2 control-label'])!!}
                <div class="col-sm-4">
                    {!! Form:: text('nome',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                </div>
                {!!Form::label('Nascimento', 'Nascimento',['class' => 'col-sm-2 control-label'])!!}
                <div class="col-sm-4">
                    {!! Form:: date('nascimento',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        <div class="row">
            <div class="form-group col-sm-12">                
                    {!!Form::label('Nome da Mãe', 'Nome da Mãe',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                    {!! Form:: text('mae',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)'])!!}  
                </div>
                {!!Form::label('Profissão da Mãe', 'Profissão da Mãe',['class' => 'col-sm-2 control-label'])!!}
                <div class="col-sm-4">
                    {!! Form:: text('prof_mae',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)'])!!}  
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
        $(function() {
            $("#alvo").keyup(function() {
                var tamanho = $("#alvo").val().length;
                $("#aqui").html(tamanho);
            });
        });
    </script>
</body>
</html>