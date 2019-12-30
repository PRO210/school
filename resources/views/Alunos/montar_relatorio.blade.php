
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Montar Relatório</title>
        <style>
            th{
                text-align: center !important;
            }
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
            <h3 style="text-align:center; margin-top: 36px ">Montar Relatórios</h3>
            @include('msg')
            {!!Form::open(['url' => '/alunos/gerar/relatório','name' => 'form1'])!!}                        

            <div class="col-md-12">
                <div class ="row">
                    
                    <div class="col-md-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="selecionar_status"> &nbsp;&nbsp;STATUS</th>
                                </tr>
                            </thead>
                            @foreach($status as $status_unico)                   
                            <tr>
                                <td><input name="STATUS[]" type="checkbox" class="checkbox_status" value="{{$status_unico->id}}">&nbsp;&nbsp;{{$status_unico->STATUS}}</td> 
                            </tr>
                            @endforeach   
                        </table>
                    </div>
                    
                    <div class="col-md-2">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>ADMITIDOS COMO <br> OUVINTES</th></tr>                                
                            </thead>
                            <tbody>  
                                <tr>                                   
                                    <td><input type = 'radio' name='OUVINTE' value = '' checked="">&nbsp;&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='OUVINTE' value = 'SIM'>&nbsp;&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='OUVINTE'  value = 'NAO'/>&nbsp;&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>

                    <div class="col-md-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>COM NECESSIDADES <br> ESPECIAIS</th></tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = 'radio' name='NECESSIDADES_ESPECIAIS' value = '' checked>&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='NECESSIDADES_ESPECIAIS' value = 'SIM'>&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='NECESSIDADES_ESPECIAIS'  value = 'NÃO'/>&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>                         
                    </div>
                    
                    <div class="col-md-2">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>TRANSPORTE</th></tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = 'radio' name='TRANSPORTE' value = '' checked>&nbsp;&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='TRANSPORTE' value = 'SIM'>&nbsp;&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='TRANSPORTE'  value = 'NÃO'/>&nbsp;&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>   
                    </div>
                    
                    <div class="col-md-2">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>URBANO</th></tr>                                
                            </thead>
                            <tbody>  
                                <tr>                                   
                                    <td><input type = 'radio' name='URBANO' value = '' checked="">&nbsp;&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='URBANO' value = 'SIM'>&nbsp;&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='URBANO'  value = 'NAO'/>&nbsp;&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>                         
                    </div> 
                </div>    










            <div class="row">
                <div class="col-sm-offset-2 col-sm-4" style=" margin-bottom: 12px; ">                    
                    <button type="submit" value="inputNome" class="btn btn-success btn-block" id="inputNome" onclick="return validaCheckbox()">Gerar Relatório</button>  
                </div>
                <div class="col-sm-4" >                        
                    <button type="reset" class="btn btn-danger btn-block">Limpar os Campos</button>
                </div>
            </div> 
            <div class ="row">
                <div class="col-md-12">
                    <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>  
                                <th> 
                                    <div class='dropdown'>                                  
                                        &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    </div>
                                </th>                    
                                <th>TURMA</th>
                                <th>TURMA_EXTRA</th>                        
                                <th>TURNO</th>
                                <th>UNICO</th>
                                <th>ANO</th>
                                <th>CATEGORIA</th>                         
                            </tr>
                        </thead>
                        <tbody>                                   
                            @foreach($turmas as $turma) 
                            <tr>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        &nbsp;&nbsp;<span><input type='checkbox' name='turma_id[]' class = 'checkbox' value='{{$turma->id}}' ></span>
                                        &nbsp;<span id = "nome">{{$turma->TURMA}}</span>
                                    </div>
                                </td>
                                <td>{{$turma->TURMA_EXTRA}}</td>                          

                                <td>{{$turma->TURNO}}</td>
                                <td>{{$turma->UNICO}}</td>
                                <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                                <td>{{$turma->CATEGORIA}}</td>                          
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>  
                                <th></th>                    
                                <th>TURMA</th>
                                <th>TURMA_EXTRA</th>                        
                                <th>TURNO</th>
                                <th>UNICO</th>
                                <th>ANO</th>
                                <th>CATEGORIA</th>                         
                            </tr>
                        </tfoot>
                    </table>    
                </div>
            </div>
        </div>
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
        {!! Form:: close()!!}  
        <script>
            //Marcar ou Desmarcar todos os checkbox do Status
            $(document).ready(function () {
                $('.selecionar_status').click(function () {
                    if (this.checked) {
                        $('.checkbox_status').each(function () {
                            this.checked = true;
                        });
                    } else {
                        $('.checkbox_status').each(function () {
                            this.checked = false;
                        });
                    }
                });

            });
        </script>
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
