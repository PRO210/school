<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Scholl 2019'}}</title> 
        <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .glyphicon-print{font-size: 16px !important;}
            .dropdown-menu > li > a {padding-bottom: 4px;}
            .checkbox{display: inline-block !important;} 
            @media (max-width: 720px) {#nome{white-space: normal};
            </style> 
        </head>
        <body>
            @include('Disciplinas.disciplinas_css')
            @include('Menu.menu')
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
                });
            </script>
            <h3 style="text-align:center; margin-top: 36px ">Atualizar Varias Disciplinas</h3>
            <div class="container-fluid">                 

                {{-- {{$impressao}}imprimir do php --}}
                {{-- {!!$xss!!} imprimir do java --}}          

                {!!Form::open(['url' => 'disciplinas/update/bloco/server','name' => 'form1'])!!}                        
                {{-- {!! Form::open(['route' => 'disciplinas.store','class' => 'form-control','name' => 'form1'])!!} --}} 

                <div class="row">
                    <div class=" col-sm-2">
                        <button type="button" id="btBoletim" class="btn btn-warning botoes btn-block ativar">Boletim</button>
                        <button type="submit" id="" class="btn btn-warning botoes btn-block BOLETIM" style="display: none">Salvar as Alterações</button>
                    </div>
                </div>
                <br>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#btBoletim').click(function () {
                            var ativar = $("#btBoletim").hasClass("ativar");
                            if (ativar) {

                                $("#btBoletim").removeClass("btn-warning ativar");
                                $("#btBoletim").addClass("btn-primay desativar");
                                $(".BOLETIM").show('slow');
                                $('.BOLETIM_ORD').show('slow');
                                //                                   
                            } else {

                                $("#btBoletim").removeClass("btn-primay desativar");
                                $("#btBoletim").addClass("btn-warning ativar");
                                $(".BOLETIM").hide('slow');
                                $('.BOLETIM_ORD').hide('slow');
                            }
                        });
                    });
                </script> 
                <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>
                        <tr> 

                            <th> 
                                <div class='dropdown'>
                                    <span><input type='checkbox'  class = 'selecionar'/></span>
    <!--                                &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        <li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Básica</a></li>
                                        <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Geral</a></li>
                                    </ul>-->
                                </div>
                            </th> 
                            <th>DISCIPLINA</th>
                            <th>EM_DESUSO</th>
                            <th>CARGA <br> HORARIA</th>
                            <th>BOLETIM</th>
                            <th>BOLETIM_ORD</th>
                            <th>FICHA <br> DESCRITIVA</th>
                            <th>FICHA <br> DESCRITIVA_ORD</th>
                            <th>ATA</th>
                            <th>ATA_ORD</th>
                            <th>BNC</th>
                            <th>BNC_ORD</th>                       
                        </tr>
                    </thead>                    
                    <tbody>                                   
                        @foreach($disciplinas as $disciplina)                    
                        <tr>     
                            <td></td>       
                            <td>
                                <div class="dropdown">
    <!--                                &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>-->
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                    </ul>                              
                                    &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]'  class = 'checkbox' id="{{$disciplina->id}}" value='{{$disciplina->id}}'>
                                        <label class="form-check-label" for="{{$disciplina->id}}">{{$disciplina->DISCIPLINA}}</label>
                                    </span>
                                </div>                           
                            </td>                      
                            <td>
                                <select name="EM_DESUSO">
                                    <option>NAO</option>
                                    <option>SIM</option>

                                </select>
                            </td>
                            <td><input type="number" min="0" placeholder="Carg.Hor" style="width: 120px"></td>
                            <td>
                                <select name="BOLETIM[]" class ="BOLETIM" style="width: 142px;display: none">
                                    <option>SIM</option>
                                    <option>NAO</option>
                                </select>
                            </td>    
                            <td>
                                <select name="BOLETIM_ORD[]" class="BOLETIM_ORD"  style="width: 142px;display: none">
                                    @for ($i = 0; $i < 21; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor                              
                                </select>
                            </td>
                            <td>
                                <select name="FICHA_DESCRITIVA">
                                    <option>SIM</option>
                                    <option>NAO</option>
                                </select>
                            </td>
                            <td>
                                <select name="FICHA_DESCRITIVA_ORD">
                                    @for ($i = 0; $i < 21; $i++)
                                    <option>{{ $i }}</option>
                                    @endfor                              
                                </select>
                            </td>
                            <td>
                                <select name="ATA">
                                    <option>SIM</option>
                                    <option>NAO</option>
                                </select>
                            </td>
                            <td>
                                <select name="ATA_ORD">
                                    @for ($i = 0; $i < 21; $i++)
                                    <option>{{ $i }}</option>
                                    @endfor                              
                                </select>
                            </td>
                            <td>
                                <select name="BNC">
                                    <option>SIM</option>
                                    <option>NAO</option>
                                </select>
                            </td>
                            <td>
                                <select name="BNC_ORD">
                                    @for ($i = 0; $i < 21; $i++)
                                    <option>{{ $i }}</option>
                                    @endfor                              
                                </select>
                            </td>
                        </tr>                                        
                        @endforeach                     
                    </tbody>
                    <tfoot>
                        <tr>  
                            <th></th>
                            <th>DISCIPLINA</th>                       
                            <th>EM_DESUSO</th>
                            <th>CARGA <br>HORARIA</th>
                            <th>BOLETIM</th>
                            <th>BOLETIM_ORD</th>
                            <th>FICHA <br>DESCRITIVA</th>
                            <th>FICHA <br> DESCRITIVA_ORD</th>
                            <th>ATA</th>
                            <th>ATA_ORD</th>
                            <th>BNC</th>
                            <th>BNC_ORD</th>  
                        </tr>
                    </tfoot>        
                </table>             
                {!! Form:: close()!!}        
            </div> 
            @include('Disciplinas.tabela_disciplinas')
        </body>
    </html>
