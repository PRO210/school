
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Scholl 2019'}}</title>

        <script src="{{url('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>           
        <script src="{{url('assets/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>

        <script src="{{url('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

        <link rel="stylesheet" href="{{url('assets/css/dataTables.bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" type="text/css">
        <script src="{{url('assets/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
        <script src="{{url('js/bootstrap.min.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{url('assets/css/responsive.dataTables.min.css')}}">  


        <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .glyphicon-print{font-size: 16px !important;}
            .dropdown-menu > li > a {padding-bottom: 4px;}
            .checkbox{display: inline-block !important;} 

            @media (max-width: 720px) {#nome{white-space: normal;}
            </style>
            <script>
$(document).ready(function () {
    $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
});
            </script>
        </head>

        <body>
            @include('Menu.menu');
            <h3 style="text-align:center; ">Ações Realizadas</h3>
            <div class="container-fluid">      

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
                            <th>USUÁRIO</th>                          
                            <th>AÇÃO</th>
                            <th>TABELA</th>
                            <th>DATA</th>    
                            <th>DETALHES DA AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)                   
                        <tr>      
                            <td></td>       
                            <td>                               
                                <span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$log->ID}}'></span>
                                &nbsp;<span id = "nome">{{$log->USUARIO}}</span>
                            </td>                                          
                            <td>{{$log->ACAO}}</td>                  
                            <td>{{$log->TABELA}}</td>                  
                            <td>{{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y h:i')}}</td>                           
                            <td style="white-space: normal">{{$log->DETALHES_ACAO}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>      
                            <th></th>                
                            <th>USUÁRIO</th>
                            <th>AÇÃO</th>
                            <th>TABELA</th>
'
                            <th>DATA</th>    
                            <th>DETALHES DA AÇÃO</th>
                        </tr>
                    </tfoot>        
                </table>                 
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
                            "lengthMenu": " _MENU_",
                            "zeroRecords": "Nenhum aluno encontrado",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sem registros",
                            "search": "Busca:",
                            "infoFiltered": "(filtrado de _MAX_ total de alunos)",
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
            <script type="text/javascript">
                //Marcar ou Desmarcar todos os checkbox
                $(document).ready(function () {

                    $('.selecionar').click(function () {
                        if (this.checked) {
                            $('.checkbox').each(function () {
                                this.checked = true;
                            });
                        } else {
                            $('.checkbox').each(function () {
                                this.checked = false;
                            });
                        }
                    });

                });
            </script>
            <script type="text/javascript">
                $('input[type=checkbox]').on('change', function () {
                    var total = $('input[type=checkbox]:checked').length;
                    if (total > 0) {
                        //alert(total);
                        $('#btEditBloc').removeAttr('disabled');

                    } else {
                        $('#btEditBloc').attr('disabled', 'disabled');
                    }
                });
            </script>
            <script language="javascript">
                function validaCheckbox() {
                    var frm = document.form1;
                    //Percorre os elementos do formulário
                    for (i = 0; i < frm.length; i++) {
                        //Verifica se o elemento do formulário corresponde a um checkbox 
                        if (frm.elements[i].type == "checkbox") {
                            //Verifica se o checkbox foi selecionado
                            if (frm.elements[i].checked) {
                                // alert("Exite ao menos um checkbox selecionado!");
                                return true;
                            }
                        }
                    }
                    alert("Nenhum Aluno foi selecionado!");
                    return false;
                }
            </script>    
        </body>
    </html>