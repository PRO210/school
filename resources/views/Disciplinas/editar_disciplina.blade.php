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
            {!! Form::model($disciplina,['route' => ['disciplinas.update',Crypt::encrypt($disciplina->id)],'class' => 'form-horizontal','name' => 'form1','method'=> 'put'])!!}

            <div class="container-fluid">
                <h4 style="text-align:center; margin-top: 36px">{{$title or 'Gestão de Disciplinas'}}</h4>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Disciplina', 'Disciplina',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('DISCIPLINA',null,['class' => 'form-control', 'placeholder' =>'' ,'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false'])!!}  
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">                         
                        <div class="col-sm-4 col-sm-offset-2">                       
                            {!! Form:: submit('Atualizar',['class' => 'btn btn-success btn-block','onclick'=>'return confirmar()'])!!}  
                        </div> 
                        <div class="col-sm-4 col-sm-offset-2">                            
                            <a href="javascript:history.back()" class="btn btn-primary btn-block" id="bt_voltar">Voltar Para a Página Anterior</a>
                        </div> 

                    </div>
                </div> 
                <h4 style="text-align:center; ">Turmas em que a Disciplina está Vinculada</h4>
                <!--Turmas em que a disciplina está vinculada-->
                <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>  
                            <th> 
                                <div class='dropdown'>
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspo                                                            pup='true' aria-expanded='true'></span>
                                    <!--                                                                                                           <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                                                        <li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden                                                                                                                ='true'></span></button>Básica</a></li>
                                                                        <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidde                                                                                                            n='true'></span></button>Geral</a></li>
                                                                    </ul>-->
                                </div>
                            </th>                    
                            <th>TURMA</th>
                            <th>TURMA_EXTRA</th>                          
                            <th>TURNO</th>
                            <th>UNICO</th>
                            <th>ANO</th>
                            <th>CATEGORIA</th>                          
                            <th>CARGA HORÁRIA</th>                          
                        </tr>
                    </thead>
                    <tbody>                              
                        @foreach($disciplinas_turmas as $disciplina)  
                        @foreach($disciplina->disciplinas_turmas as $turma)  

                        <tr>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span><input type='checkbox' name='turma_selecionada[]' class = 'checkbox' value='{{$turma->id}}' checked=""></span>
                                    &nbsp;<span id = "nome">{{$turma->TURMA}}</span>
                                </div>
                            </td>
                            <td>{{$turma->TURMA_EXTRA}}</td>                           
                            <td>{{$turma->TURNO}}</td>
                            <td>{{$turma->UNICO}}</td>
                            <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                            <td>{{$turma->CATEGORIA}}</td>                          
                            <td><input type="number" name="CARGA_HORARIA[]" min="0" value="{{$turma->pivot->CARGA_HORARIA}}"></td>                          
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table> 
                <h4 style="text-align:center; ">Turmas ainda possível de Vincular</h4>
                <!--Turmas ainda possível de Vincular-->
                <table  id = "example_II" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>  
                            <th> 
                                <div class='dropdown'>                                  
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <!--                                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                                                        <li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Básica</a></li>
                                                                        <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Geral</a></li>
                                                                    </ul>-->
                                </div>
                            </th>                    
                            <th>TURMA</th>
                            <th>TURMA_EXTRA</th>                        
                            <th>TURNO</th>
                            <th>UNICO</th>
                            <th>ANO</th>
                            <th>CATEGORIA</th>  
                            <th>CARGA HORÁRIA</th>    
                        </tr>
                    </thead>
                    <tbody>                                   
                        @foreach($turmas_base as $turma) 
                        <tr>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span><input type='checkbox' name='turma_selecionada_dois[]' class = 'checkbox' value='{{$turma->id}}' ></span>
                                    &nbsp;<span id = "nome">{{$turma->TURMA}}</span>
                                </div>
                            </td>
                            <td>{{$turma->TURMA_EXTRA}}</td>                         
                            <td>{{$turma->TURNO}}</td>
                            <td>{{$turma->UNICO}}</td>
                            <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                            <td>{{$turma->CATEGORIA}}</td>                          
                            <td><input type="number" name="CARGA_HORARIA_DOIS[]" min="0" value=""></td>                          

                        </tr>
                        @endforeach
                    </tbody>
                </table>        
                {!! Form:: close()!!}   
            </div>
        </body>
        @include('Disciplinas.tabela_editar_disciplina')
        @include('Disciplinas.tabela_editar_disciplina_2')

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
