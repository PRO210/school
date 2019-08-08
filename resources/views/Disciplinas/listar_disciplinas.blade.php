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
            @include('Disciplinas.disciplinas_css')
            @include('Menu.menu')
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
                });
            </script>            
            <h3 style="text-align:center; margin-top: 36px ">Disciplinas</h3>
            @include('msg')            
            <div class="container">     
                {{-- {{$impressao}}imprimir do php --}}
                {{-- {!!$xss!!} imprimir do java --}}          

                {!!Form::open(['url' => 'disciplinas/update/bloco','name' => 'form1'])!!}                        
                {{-- {!! Form::open(['route' => 'disciplinas.store','class' => 'form-control','name' => 'form1'])!!} --}}      
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

                            <th>DISCIPLINA</th>

                        </tr>
                    </thead>
                    <tbody>                                   
                        @foreach($disciplinas as $disciplina)    
                        <tr>


                            <td></td>       
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'  ></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        @can('EDITAR_ALUNOS')
                                        <li><a href="{{route('edição/disciplina',['id' => Crypt::encrypt($disciplina->id)])}}" target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                        <li><a href="{{route('deletar',['id' => Crypt::encrypt($disciplina->id)])}}" target='_self' title='Deletar'><span class='glyphicon glyphicon-remove text-danger' aria-hidden='true' onclick="return deletar()">&nbsp;Deletar a Disciplina</span></a></li>

                                        @endcan
                                    </ul>                              
                                    &nbsp;&nbsp;

                                    <span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' id="{{$disciplina->id}}" value='{{$disciplina->id}}'>
                                        <label class="form-check-label" style="margin-bottom: 0px !important;" for="{{$disciplina->id}}">{{$disciplina->DISCIPLINA}}</label>
                                    </span>
                                </div>                           
                            </td>  

                        </tr>                                        

                        @endforeach                     
                    </tbody>
                    <tfoot>
                        <tr>  
                            <th></th>
                            <th>DISCIPLINA</th>



                        </tr>
                    </tfoot>        
                </table>                  
                {!! Form:: close()!!}        
            </div>   
            <script>
                $(document).ready(function () {
                    // Setup - add a text input to each footer cell
                    $('#example tfoot th').each(function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder="' + title + '" />');
                    });
                    //Data Table
                    var table = $('#example').DataTable({
                        //
                        "columnDefs": [{
                                "targets": 0,
                                "orderable": false
                            }],
                        "lengthMenu": [[8, 20, 30, 40, 50, 70, 100, -1], [8, 20, 30, 40, 50, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": "_MENU_ @can('EDITAR_ALUNOS')<?php
echo "&nbsp;<a href='disciplinas/create' target='_self' class = 'btn btn-success'><span class = 'glyphicon glyphicon-plus'>&nbsp;Cadastrar</span></a>"
 . "&nbsp;<button type='submit' name ='botao' value='varios'  class='btn btn-primary btn-block ' style= 'display: inline-block !important; width:auto !important;' onclick='return confirmarAtualizacao()' id = 'btEditBloc' title = 'Selecione ao menos uma Disciplina' disabled>Atualizar Vários</button>"
;
?>@endcan      ",
                            "zeroRecords": "Nenhum aluno encontrado",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sem registros",
                            "search": "Busca:",
                            "infoFiltered": "(filtrado de _MAX_ total de Disciplinas)",
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
                    // Apply the search
                    table.columns().every(function () {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that
                                        .search(this.value)
                                        .draw();
                            }
                        });
                    });
                });
            </script>
            <script src="{{url('js/disciplinas/listar_disciplinas.js')}}" type="text/javascript"></script>
        </body>
    </html>