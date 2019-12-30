
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Colocar no Arquivo</title>
    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        @include('msg')
        @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>         
        @endif
        <div class="container">
            {!! Form::open(['url' => 'arquivado/aluno','class' => 'form-horizontal','name' => 'form1'])!!}  
            {!! Form::hidden('EXCLUIDO','SIM') !!}
            {!! Form::hidden('TURMA','10') !!}
            <h3>Adicionar o Aluno(a) para o Arquivo Passivo:</h3>
            <div class="row">
                <div class="form-group col-sm-12">                    
                    {!!Form::label('PASTA', 'Escolha a Pasta',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        <select name="EXCLUIDO_PASTA" class="form-control" required="" >                                
                            @foreach($pastas as $pasta)                                                                                      
                            <option value="{{$pasta->PASTA}}">{{$pasta->PASTA}}</option>                          
                            @endforeach 
                        </select>
                    </div>   
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-sm-12">
                    {!!Form::label('Nome do Aluno(a)', 'Nome do Aluno(a)',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('NOME',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false','required'])!!}  
                    </div>
                    {!!Form::label('Nascimento', 'Nascimento',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: date('NASCIMENTO',null,['class' => 'form-control', 'placeholder' =>'' ])!!}  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    {!!Form::label('Mãe', 'Mãe',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('MAE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    {!!Form::label('Profº da Mãe', 'Profº da Mãe',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('PROF_MAE',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>                                       
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    {!!Form::label('Pai', 'Pai',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('PAI',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>
                    {!!Form::label('Profº do Pai', 'Profº do Pai',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('PROF_PAI',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                    </div>                                       
                </div>
            </div>

            <button type="submit" name="botao" value="inserir" class="btn btn-success btn-block" onclick="return confirmar()">Salvar as Alterações</button>
            {!!Form::close()!!}
        </div>   
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
//           Confirmar se pode salvar
            function confirmar() {
                var u = $('#usuario').val();
                var r = confirm("Já Posso Enviar " + u + "? ");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>
