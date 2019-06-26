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

            @if(session('msg'))
            <!--Modal-->                <!--Modal-->            <!--Modal-->        
            <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                            <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" style=" color:black" >
                                {{session('msg')}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-danger " data-dismiss="modal">Prosseguir</button>-->
                        </div>
                    </div>
                </div>
            </div> 
            <script type='text/javascript'>
                $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                });
                var intervalo = window.setInterval(fechar, 5000);
                function fechar() {
                    $('.modal').modal('hide');
                }
                @endif
            </script>  

            <div class="container-fluid">     

                {{-- {{$impressao}}imprimir do php --}}
                {{-- {!!$xss!!} imprimir do java --}}          

                {!!Form::open(['url' => 'disciplinas/update/bloco','name' => 'form1'])!!}                        
                {{-- {!! Form::open(['route' => 'disciplinas.store','class' => 'form-control','name' => 'form1'])!!} --}}      
                <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>
                        <tr> 

                            <th> 
                                <div class='dropdown'>
                                    <span><input type='checkbox'  class = 'selecionar'/></span>
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        <li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Básica</a></li>
                                        <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Geral</a></li>
                                    </ul>
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
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                    </ul>                              
                                    &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$disciplina->id}}'></span>
                                    &nbsp;<span id = "nome">{{$disciplina->DISCIPLINA}}</span>
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
                            "lengthMenu": "_MENU_",
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
        </body>
    </html>