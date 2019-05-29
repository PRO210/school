<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Turmas'}}</title> 
        <style>
            .checkbox{display: inline-block !important;} 
        </style>
    </head>
    <body>
        @include('Alunos.alunos_css');
        @include('Menu.menu');
        <form name="cadastrar" action="{{url('alunos/update/turma')}}" method="post" class="form-horizontal" > 
            <input type="hidden" name="_token" value="{{csrf_token()}}">                  
            <input type="hidden" name="id" value="{{$aluno->id}}">                  
            <h3 style="text-align:center; ">Turma(s) em que  {{$nome}} está Inscrito(a)</h3>
            <div class="container-fluid">   
                <!--Turmas que o Aluno está matriculado-->
                <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
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
                            <th>STATUS</th>
                            <th>OUVINTE</th>
                            <th>TURNO</th>
                            <th>UNICO</th>
                            <th>ANO</th>
                            <th>CATEGORIA</th>
                        </tr>
                    </thead>
                    <tbody>                                   
                        @foreach($aluno->turmas as $turma) 
                        <tr>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span><input type='checkbox' name='turma_selecionada[]' class = 'checkbox' value='{{$turma->id}}' checked=""></span>
                                    &nbsp;<span id = "nome">{{$turma->TURMA}}</span>
                                </div>
                            </td>
                            <td>{{$turma->TURMA_EXTRA}}</td>
                            <td>{{$turma->pivot->STATUS}}</td>    
                            <td>
                                <select name="OUVINTE_UM" class="form-control" >                       
                                    @foreach($ouvintes as $ouvinte)
                                    @if($turma->pivot->OUVINTE == "$ouvinte")
                                    <option value="{{$ouvinte}}" selected="">{{$ouvinte}}</option>                         
                                    @else
                                    <option value="{{$ouvinte}}">{{$ouvinte}}</option>
                                    @endif                                                               
                                    @endforeach                                                               
                                </select>                             
                            </td>
                            <td>{{$turma->TURNO}}</td>
                            <td>{{$turma->UNICO}}</td>
                            <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                            <td>{{$turma->CATEGORIA}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="col-sm-4">                            
                            <a href="javascript:history.back()" class="btn btn-primary btn-block">Voltar Para a Página Anterior</a>
                        </div> 
                        <div class="col-sm-4">
                            <button type="submit" value="Enviar" class="btn btn-success btn-block" onclick="return confirmar()" >Salvar as Alterações</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="reset" class="btn btn-danger btn-block">Deixar Tudo com Original</button>
                        </div>
                    </div>
                </div>
                <!--Turmas Cadastradas no Sistema-->
                <h3 style="text-align:center; ">Turmas Cadastradas no Sistema </h3>
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
                            <th>OUVINTE</th>
                            <th>TURNO</th>
                            <th>UNICO</th>
                            <th>ANO</th>
                            <th>CATEGORIA</th>
                        </tr>
                    </thead>
                    <tbody>                                   
                        @foreach($turmas_base as $turma) 
                        <tr>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span><input type='checkbox' name='turma_selecionada_2[]' class = 'checkbox' value='{{$turma->id}}' ></span>
                                    &nbsp;<span id = "nome">{{$turma->TURMA}}</span>
                                </div>
                            </td>
                            <td>{{$turma->TURMA_EXTRA}}</td>                          
                            <td>
                                <select name="OUVINTE_DOIS" class="form-control" > 
                                    @foreach($ouvintes as $ouvinte)
                                    <option value="{{$ouvinte}}" >{{$ouvinte}}</option>
                                    @endforeach 
                                </select>
                            </td>
                            <td>{{$turma->TURNO}}</td>
                            <td>{{$turma->UNICO}}</td>
                            <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                            <td>{{$turma->CATEGORIA}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>                 
            </div>
        </form>
        <script>
            $(document).ready(function () {
                //Data Table
                var table = $('#example').DataTable({
                    //
                    "columnDefs": [{
                            "targets": 0,
                            "orderable": false
                        }],
                    "lengthMenu": [[5, 10, 20, 30, 40, 50, 70, 100, -1], [5, 10, 20, 30, 40, 50, 70, 100, "All"]],
                    "language": {
                        "lengthMenu": " _MENU_",
                        "zeroRecords": "Nenhum aluno encontrado",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Sem registros",
                        "search": "Busca:",
                        "infoFiltered": "(filtrado de _MAX_ total de Turmas)",
                        "paginate": {
                            "first": "Primeira",
                            "last": "Ultima",
                            "next": "Proxima",
                            "previous": "Anterior"
                        },
                        "aria": {
                            "sortAscending": ": ative a ordenação cressente",
                            "sortDescending": ": ative a ordenação decressente"
                        }

                    },
                    responsive: true
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                //Data Table
                var table = $('#example_II').DataTable({
                    //
                    "columnDefs": [{
                            "targets": 0,
                            "orderable": false
                        }],
                    "lengthMenu": [[5, 10, 20, 30, 40, 50, 70, 100, -1], [5, 10, 20, 30, 40, 50, 70, 100, "All"]],
                    "language": {
                        "lengthMenu": " _MENU_",
                        "zeroRecords": "Nenhum aluno encontrado",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Sem registros",
                        "search": "Busca:",
                        "infoFiltered": "(filtrado de _MAX_ total de Turmas)",
                        "paginate": {
                            "first": "Primeira",
                            "last": "Ultima",
                            "next": "Proxima",
                            "previous": "Anterior"
                        },
                        "aria": {
                            "sortAscending": ": ative a ordenação cressente",
                            "sortDescending": ": ative a ordenação decressente"
                        }

                    },
                    responsive: true
                });
            });
        </script>
    </body>
</html>
