<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>{{$title}}</title>
        <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .glyphicon-print{font-size: 16px !important;}
            .dropdown-menu > li > a {padding-bottom: 4px;}
            .checkbox{display: inline-block !important;} 
            @media (max-width: 720px) {#nome{white-space: normal;}};

        </style>   
    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        <script>
            $(document).ready(function () {
                $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
            });
        </script> 
        <style>
            @media (max-width: 720px) {.btvalida{margin-bottom: 12px !important}};
        </style>
        @include('msg')
        <div class="container-fluid">
            {!! Form::model($turma,['route' => ['turmas.update',Crypt::encrypt($turma->id)],'class' => 'form-horizontal','name' => 'form1','method'=> 'put'])!!}

            <h4 style="text-align:center; margin-top: 36px">{{$title or 'Gestão de Curso'}}</h4>
            <div class="row">
                <div class="form-group col-sm-12">                      
                    {!!Form::label('Turma', 'Turma',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('TURMA',null,['class' => 'form-control', 'placeholder' =>'' , 'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false', 'required'])!!}  
                    </div> 

                    {!!Form::label('Categória', 'Categória',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        <select name="CATEGORIA" class="form-control">  
                            @foreach($CATEGORIAS as $CATEGORIA)
                            @if($turma->CATEGORIA  == "$CATEGORIA")
                            <option value="{{$CATEGORIA}}" selected=""> {{$CATEGORIA}}</option>
                            @else                                                               
                            <option value="{{$CATEGORIA}}">{{$CATEGORIA}}</option>                          
                            @endif
                            @endforeach 
                        </select>
                    </div>                        
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">                      
                    {!!Form::label('Unico', 'Unico',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        {!! Form:: text('UNICO',null,['class' => 'form-control', 'placeholder' =>'' , 'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false', 'required'])!!}  
                    </div> 

                    {!!Form::label('Turno', 'Turno',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        <select name="TURNO" class="form-control">  
                            @foreach($TURNOS as $TURNO_UNICO)
                            @if($turma->TURNO  == "$TURNO_UNICO")
                            <option value="{{$TURNO_UNICO}}" selected=""> {{$TURNO_UNICO}}</option>
                            @else                                                               
                            <option value="{{$TURNO_UNICO}}">{{$TURNO_UNICO}}</option>                          
                            @endif
                            @endforeach 
                        </select>
                    </div>                        
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">                    

                    {!!Form::label('Turma Extra', 'Turma Extra',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-4">
                        <select name="TURMA_EXTRA" class="form-control">  
                            @foreach($SIM_NAO as $SIM)
                            @if($turma->TURMA_EXTRA  == "$SIM")
                            <option value="{{$SIM}}" selected=""> {{$SIM}}</option>
                            @else                                                               
                            <option value="{{$SIM}}">{{$SIM}}</option>                          
                            @endif
                            @endforeach 
                        </select>
                    </div>                  
                    {!!Form::label('Idade Mínima/Ano', 'Idade Mínima/Ano',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-2">
                        {!! Form:: number('TURMA_IDADE',null,['class' => 'form-control', 'placeholder' =>'' , 'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false', 'required'])!!}  
                    </div> 
                    <div class="col-sm-2">
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}" readonly="">
                    </div>

                </div>
            </div>



            <div class="row">
                <div class="form-group col-sm-12">                         
                    <div class="col-sm-4 col-sm-offset-2">                       
                        {!! Form:: submit('Atualizar',['class' => 'btn btn-success btn-block btvalida','onclick'=>'return confirmar()', 'id'=> 'btSubmit'])!!}  
                    </div> 
                    <div class="col-sm-4 col-sm-offset-2">                            
                        <a href="javascript:history.back()" class="btn btn-primary btn-block " id="bt_voltar">Voltar Para a Página Anterior</a>
                    </div> 

                </div>
            </div> 










































































            {!! Form:: close()!!}     
        </div>
        <script type="text/javascript">
            $('input').on("input", function (e) {
                $(this).val($(this).val().replace('"', ""));
                $(this).val($(this).val().replace("'", ""));

            });
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
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
    </body>
</html>
