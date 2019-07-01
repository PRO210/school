<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Gestão de Disciplinas'}}</title>
        <style>
            @media (max-width: 790px) {#bt_voltar{margin-top: 12px};  
            </style>
        </head>
        <body>
            @include('Disciplinas.disciplinas_css')
            @include('Menu.menu')
            @if (isset($errors) && count($errors) > 0)
            
            <div class="alert alert-danger" style="margin-top: 36px">
                @foreach ($errors->all() as $error)                
                  <strong>Erro!</strong> {{$error}}
                @endforeach
            </div>         
            @endif
            {!! Form::open(['route' => 'disciplinas.store','class' => 'form-horizontal','name' => 'form1'])!!}  
            <div class="container-fluid">
                <h4 style="text-align:center; margin-top: 36px">{{$title or 'Gestão de Disciplinas'}}</h4>

                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Disciplina', 'Disciplina',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('DISCIPLINA',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>
                        {!!Form::label('Carga Horária', 'Carga Horária',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('CARGA_HORARIA',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>                                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">                         
                        <div class="col-sm-4 col-sm-offset-2">                       
                            {!! Form:: submit('Cadastrar',['class' => 'btn btn-success btn-block','onclick'=>'return confirmar()'])!!}  
                        </div> 
                        <div class="col-sm-4 col-sm-offset-2">                            
                            <a href="javascript:history.back()" class="btn btn-primary btn-block" id="bt_voltar">Voltar Para a Página Anterior</a>
                        </div> 

                    </div>
                </div> 
                {!! Form:: close()!!}   
            </div>
        </body>
        <script type=text/javascript>
            $('input').on("input", function (e) {
                $(this).val($(this).val().replace('"', ""));
                $(this).val($(this).val().replace("'", ""));

            });
        </script>
        <script type=text/javascript>
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>
        <script type=text/javascript>
            //Confirmar se pode salvar
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
    </html>
