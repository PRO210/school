
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Colocar no Aruivo</title>
    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        @include('msg')
        <div class="container">
            {!! Form::model($aluno,['route' => ['arquivos.update',Crypt::encrypt($aluno->id)],'class' => 'form-horizontal','name' => 'form1', 'method'=> 'put'])!!} 
            <h3>Mover o Aluno(a) {{$aluno->NOME}} para o Arquivo Passivo:</h3>
            <div class="row">
                <div class="form-group col-sm-12">                    
                    {!!Form::label('PASTA', 'Escolha a Pasta',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        <select name="PASTA" class="form-control" required="" >                                
                            @foreach($pastas as $pasta)                                                                                      
                            <option value="{{$pasta->PASTA}}">{{$pasta->PASTA}}</option>                          
                            @endforeach 
                        </select>
                    </div>   
                </div>
            </div> 
            <button type="submit" name="botao" value="inserir" class="btn btn-success btn-block" onclick="return confirmar()">Salvar as Alterações</button>
            {!!Form::close()!!}
        </div>   
    </body>
</html>
