<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>{{$title}}</title>
        <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .glyphicon-print{font-size: 16px !important;}
            .dropdown-menu > li > a {padding-bottom: 4px;}
            .checkbox{display: inline-block !important;} 
            @media (max-width: 720px) {#nome{white-space: normal};
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
            @include('msg')

            <div class="container-fluid">
                {!! Form::model($curso,['route' => ['cursos.update',Crypt::encrypt($curso->id)],'class' => 'form-horizontal','name' => 'form1','method'=> 'put'])!!}

                <h4 style="text-align:center; margin-top: 36px">{{$title or 'Gestão de Curso'}}</h4>
                <div class="row">
                    <div class="form-group col-sm-12">                      
                        {!!Form::label('Nome', 'Nome',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            {!! Form:: text('NOME',null,['class' => 'form-control', 'placeholder' =>'' , 'onkeyup' => 'maiuscula(this)','onpaste' => 'return false;','ondrop' => 'return false', 'required'])!!}  
                        </div> 

                        {!!Form::label('Mediação Pedagógica', 'Mediação Pedagógica',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="MEDIACAO_PEDAGOGICA" class="form-control">  
                                @foreach($MEDIACOES as $MEDIACOE)
                                @if($curso->MEDIACAO_PEDAGOGICA  == "$MEDIACOE")
                                <option value="{{$MEDIACOE}}" selected=""> {{$MEDIACOE}}</option>
                                @else                                                               
                                <option value="{{$MEDIACOE}}">{{$MEDIACOE}}</option>                          
                                @endif
                                @endforeach 
                            </select>
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!!Form::label('Modalidade', 'Modalidade',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="MODALIDADE" class="form-control">  
                                @foreach($MODALIDADES as $MODALIDADE)
                                @if($curso->MODALIDADE  == "$MODALIDADE")
                                <option value="{{$MODALIDADE}}" selected=""> {{$MODALIDADE}}</option>
                                @else                                                               
                                <option value="{{$MODALIDADE}}">{{$MODALIDADE}}</option>                          
                                @endif
                                @endforeach 
                            </select>
                        </div>                        
                        {!!Form::label('Etapa', 'Etapa',['class' => 'col-sm-2 control-label'])!!}
                        <div class="col-sm-4">
                            <select name="ETAPA" class="form-control">  
                                @foreach($ETAPAS as $ETAPA)
                                @if($curso->ETAPA  == "$ETAPA")
                                <option value="{{$ETAPA}}" selected=""> {{$ETAPA}}</option>
                                @else                                                               
                                <option value="{{$ETAPA}}">{{$ETAPA}}</option>                          
                                @endif
                                @endforeach 
                            </select>
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
                <h4 style="text-align:center; ">Disciplina(s) em que o curso está Vinculado</h4>
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
                            <th>Disciplina</th>
                            <th>CH</th>

                        </tr>
                    </thead>
                    <tbody>                              
                        @foreach($disciplinas_curso as $disciplinas)       
                        @foreach($disciplinas->curso_disciplinas as $disciplina)
                        <tr>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;
                                    <span>
                                        <input type='checkbox' name='disciplina_selecionada[]' class = 'checkbox' id="{{$disciplina->id}}" value='{{$disciplina->id}}' checked="">
                                        <label class="form-check-label" style="margin-bottom: 0px !important;" for="{{$disciplina->id}}">{{$disciplina->DISCIPLINA}}</label>
                                    </span>
                                </div>
                            </td>                                                

                            <td><input type="number" name="CARGA_HORARIA[]" min="0" value="{{$disciplina->pivot->CARGA_HORARIA}}"></td>                          
                        </tr>
                        @endforeach                       
                        @endforeach                       
                    </tbody>
                </table> 



                <h4 style="text-align:center; ">Disciplinas ainda possível de Vincular</h4>
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
                            <th>Disciplina</th>
                            <th>CH</th>

                        </tr>
                    </thead>
                    <tbody>                                   
                        @foreach($disciplinas_nao_vinculadas as $disciplina) 
                        <tr>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;
                                    <span>
                                        <input type='checkbox' name='disciplina_selecionada_2[]' id="{{$disciplina->id}}" class = 'checkbox' value='{{$disciplina->id}}'>
                                        <label class="form-check-label" style="margin-bottom: 0px !important;" for="{{$disciplina->id}}">{{$disciplina->DISCIPLINA}}</label>
                                    </span>
                                </div>
                            </td>
                            <td><input type="number" name="CARGA_HORARIA_DOIS[]" min="0" value=""></td>     


                        </tr>
                        @endforeach
                    </tbody>
                </table>    




            </div>
            @include('Cursos.tabela_editar_curso')
            @include('Cursos.tabela_editar_curso_2')
        </body>
    </html>
