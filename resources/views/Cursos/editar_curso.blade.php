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
                        <th >BOLETIM    </th>
                        <th >BOLETIM_ORD</th>
                        <th>FICHA <br> DESCRITIVA</th>
                        <th>FICHA <br> DESCRITIVA_ORD</th>
                        <th>ATA</th>
                        <th>ATA ORD.</th>
                        <th>BNC</th>
                        <th>BNC ORD.</th>
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
                        <td><input type="number" name="CARGA_HORARIA[]" min="0" value="{{$disciplina->pivot->CARGA_HORARIA}}" style="width: 90px;"></td>    
                        <td>
                            <select name="BOLETIM[]"  >
                                @if($disciplina->pivot->BOLETIM == "SIM")
                                <option selected="">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option selected="NAO">NÃO</option>
                                <option>SIM</option>
                                @endif
                            </select>                               
                        </td>
                        <td>
                            <select name="BOLETIM_ORD[]" >
                                @for ($i = 0; $i < 21; $i++)
                                @if($disciplina->pivot->BOLETIM_ORD == "$i")
                                <option value="{{ $i }}" selected="">{{ $i }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>                                
                                @endif
                                @endfor                              
                            </select>
                        </td>                            
                        <td>
                            <select name="FICHA_DESCRITIVA[]"  >
                                @if($disciplina->pivot->FICHA_DESCRITIVA == "SIM")
                                <option selected="">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option selected="NAO">NÃO</option>
                                <option>SIM</option>
                                @endif
                            </select>                               
                        </td>                            
                        <td>
                            <select name="FICHA_DESCRITIVA_ORD[]" >
                                @for ($i = 0; $i < 21; $i++)
                                @if($disciplina->pivot->FICHA_DESCRITIVA_ORD == "$i")
                                <option value="{{ $i }}" selected="">{{ $i }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                                @endfor                              
                            </select>
                        </td>
                        <td>
                            <select name="ATA[]"  >
                                @if($disciplina->pivot->ATA == "SIM")
                                <option selected="">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option selected="NAO">NÃO</option>
                                <option>SIM</option>
                                @endif
                            </select>                               
                        </td>                            
                        <td>
                            <select name="ATA_ORD[]" >
                                @for ($i = 0; $i < 21; $i++)
                                @if($disciplina->pivot->ATA_ORD == "$i")
                                <option value="{{ $i }}" selected="">{{ $i }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                                @endfor                              
                            </select>
                        </td>
                        <td>
                            <select name="BNC[]"  >
                                @if($disciplina->pivot->BNC == "SIM")
                                <option selected="">SIM</option>
                                <option value="NAO">NÃO</option>
                                @else
                                <option selected="NAO">NÃO</option>
                                <option>SIM</option>
                                @endif
                            </select>                               
                        </td>                            
                        <td>
                            <select name="BNC_ORD[]" >
                                @for ($i = 0; $i < 21; $i++)
                                @if($disciplina->pivot->BNC_ORD == "$i")
                                <option value="{{ $i }}" selected="">{{ $i }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                                @endfor                              
                            </select>
                        </td>
                    </tr>
                    @endforeach                       
                    @endforeach                       
                </tbody>
            </table> 
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
<!--            <div class="row">
                <h4 style="text-align:center; ">Disciplinas ainda possível de Vincular</h4>
                <div class=" col-sm-2 btvalida">
                    <button type="button" id="btCH" class="btn btn-warning botoes btn-block ativar_CH ">CH</button>
                </div>
                <div class=" col-sm-2 btvalida">
                    <button type="button" id="btBoletim" class="btn btn-warning botoes btn-block ativar ">Boletim</button>
                </div>
                <div class=" col-sm-2 btvalida">
                    <button type="button" id="btFICHA_DESCRITIVA" class="btn btn-warning botoes btn-block ativar_FICHA_DESCRITIVA btvalida">Ficha Descritiva</button>
                </div>
                <div class=" col-sm-2">
                    <button type="button" id="btATA" class="btn btn-warning botoes btn-block ativar_BNC btvalida">Ata</button>
                </div>
                <div class=" col-sm-2">
                    <button type="button" id="btBNC" class="btn btn-warning botoes btn-block ativar_BNC btvalida">BNC</button>
                </div>
            </div>    -->
            <br>
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
                        <th class="CH">CARGA <br> HORARIA</th>
                        <th class ="BOLETIM"  >BOLETIM    </th>
                        <th class ="BOLETIM_ORD">BOLETIM_ORD</th>
                        <th class="FICHA_DESCRITIVA">FICHA <br> DESCRITIVA</th>
                        <th class="FICHA_DESCRITIVA">FICHA <br> DESCRITIVA_ORD</th>
                        <th class="ATA">ATA</th>
                        <th class="ATA">ATA_ORD</th>
                        <th class="BNC">BNC</th>
                        <th class="BNC">BNC_ORD</th> 

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
                        <td class="CH"><input type="number" name="CARGA_HORARIA_DOIS[]" min="0" value="" style="width: 90px;"></td>    

                        <td class="BOLETIM" >
                            <select name="BOLETIM_DOIS[]" class ="" style="width: 142px;">
                                <option>SIM</option>
                                <option>NAO</option>
                            </select>
                        </td>    
                        <td class="BOLETIM_ORD" >
                            <select name="BOLETIM_ORD_DOIS[]" class=""  style="width: 142px; ">
                                @for ($i = 0; $i < 21; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor                              
                            </select>
                        </td>
                        <td class="FICHA_DESCRITIVA">
                            <select name="FICHA_DESCRITIVA_DOIS[]">
                                <option>SIM</option>
                                <option>NAO</option>
                            </select>
                        </td>
                        <td class="FICHA_DESCRITIVA">
                            <select name="FICHA_DESCRITIVA_ORD_DOIS[]">
                                @for ($i = 0; $i < 21; $i++)
                                <option>{{ $i }}</option>
                                @endfor                              
                            </select>
                        </td>
                        <td class="ATA">
                            <select name="ATA_DOIS[]">
                                <option>SIM</option>
                                <option>NAO</option>
                            </select>
                        </td>
                        <td class="ATA">
                            <select name="ATA_ORD_DOIS[]">
                                @for ($i = 0; $i < 21; $i++)
                                <option>{{ $i }}</option>
                                @endfor                              
                            </select>
                        </td>
                        <td class="BNC">
                            <select name="BNC_DOIS[]">
                                <option>SIM</option>
                                <option>NAO</option>
                            </select>
                        </td>
                        <td class="BNC">
                            <select name="BNC_ORD_DOIS[]">
                                @for ($i = 0; $i < 21; $i++)
                                <option>{{ $i }}</option>
                                @endfor                              
                            </select>
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>    




        </div>
        @include('Cursos.tabela_editar_curso')
        @include('Cursos.tabela_editar_curso_2')
        
        
    </body>
</html>
