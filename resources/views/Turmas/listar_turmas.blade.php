<!DOCTYPE html>
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
            @include('bootstrap4')
            @include('Menu.menu')
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
                });
            </script>            
            <h3 style="text-align:center; margin-top: 36px ">{{$title}}</h3>
            @include('msg')            
            <div class="container">     
                {{-- {{$impressao}}imprimir do php --}}
                {{-- {!!$xss!!} imprimir do java --}}          

                {!!Form::open(['url' => 'turmas/update/bloco','name' => 'form1'])!!}                        
                <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>
                        <tr> 

                            <th> 
                                <div class='dropdown'>
                                    @if($obs == "")                                   
                                    @else
                                    <span><input type='checkbox'  class = 'selecionar' /></span>                                  
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        <li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Básica</a></li>
                                        <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Geral</a></li>
                                    </ul>
                                    @endif
                                </div>
                            </th>   

                            <th>TURMA</th>
                            <th>TURNO</th>
                            <th>ANO</th>

                        </tr>
                    </thead>
                    <tbody>                                   
                        @foreach($turmas as $turma)    
                        <tr>
                            <td></td>       
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'  ></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        @can('EDITAR_ALUNOS')
                                        <li><a href="{{route('turmas/edit',['id' => Crypt::encrypt($turma->id)])}}" target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                        <li><a href="{{route('turmas/destory',['id' => Crypt::encrypt($turma->id)])}}" target='_self' title='Deletar'><span class='glyphicon glyphicon-remove text-danger' aria-hidden='true' onclick="return deletar()">&nbsp;Deletar a Turma</span></a></li>

                                        @endcan
                                    </ul>                              
                                    &nbsp;&nbsp;

                                    <span><input type='checkbox' name='turma_selecionada[]' class = 'checkbox' id="{{$turma->id}}" value='{{$turma->id}}'>
                                        <label class="form-check-label" style="margin-bottom: 0px !important;" for="{{$turma->id}}">{{$turma->TURMA}}</label>
                                    </span>
                                </div>                           
                            </td> 
                            <td>{{$turma->TURNO}}</td>
                            <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>

                        </tr>                                        

                        @endforeach                     
                    </tbody>
                    <tfoot>
                        <tr>  
                            <th></th>
                            <th>TURMA</th>
                            <th>TURNO</th>
                            <th>ANO</th>



                        </tr>
                    </tfoot>        
                </table>                  
                {!! Form:: close()!!}        
            </div> 
            @include ('Turmas.tabela_e_extras_listar_turmas')
            
        </body>
    </html>