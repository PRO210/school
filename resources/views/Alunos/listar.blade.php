
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
        <script src="{{url('assets/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{url('assets/css/responsive.dataTables.min.css')}}">
      
        <link href="../../../public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">       
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

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
            <h3 style="text-align:center; ">Alunos</h3>
            <div class="container-fluid">       

                {{-- {{$impressao}}imprimir do php --}}
                {{-- {!!$xss!!} imprimir do java --}}              

                {!!Form::open(['url' => 'alunos/update/bloco','name' => 'form1'])!!}                          

                {{-- {!! Form::open(['route' => 'alunos.store','class' => 'form-control','name' => 'form1'])!!} --}}      
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
                            <th>NOME</th>
                            <th>TURMA</th>
                            <th>INEP</th>                           
                            <th>NASCIMENTO</th>
                            <th>MÃE</th>
                            <th>PAI</th>     
                            <th>MATRICULA DA CERTIDÃO</th>  
                            <th>NIS</th>
                            <th>BOLSA FAMÍLIA</th>
                            <th>ENDEREÇO</th>             
                            <th>CIDADE</th>  
                            <th>TRANSPORTE</th>  
                            <th>FONE(S)</th> 
                            <th>DECLARAÇÃO</th> 
                            <th>TRANSFERÊNCIA</th> 
                            <th>NECESSIDADES</th> 
                            <th>OBSERVAÇÕES</th> 
                            <th>STATUS</th> 

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alunos as $aluno)                    

                        <tr>      
                            <td></td>       
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        <li><a href='impressao.php?id={{$aluno->ID}}' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>
                                        <li><a href='folha_re_matricula.php?id={{$aluno->ID}}' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Ré Matricula</a></li>
                                        <li><a href='declaracoes_bolsa_familia.php?id={{$aluno->ID}}' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>
                                        <li><a href='{{route('alunos.edit',Crypt::encrypt($aluno->ID))}}' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                        <li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode({{$aluno->ID}}) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user text-warning' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>
                                        <li><a href='cadastrar_historico.php?id=" . base64_encode({{$aluno->ID}}) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book text-primary' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>
                                    </ul>                              
                                    &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$aluno->ID}}'></span>
                                    &nbsp;<span id = "nome">{{$aluno->NOME}}</span>
                                </div>                           
                            </td>
                            <td>{{$aluno->TURMA}}</td>
                            <td>{{$aluno->INEP}}</td>                  
                            <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                            <td>{{$aluno->MAE}}</td>
                            <td>{{$aluno->PAI}}</td>
                            <td>{{$aluno->MATRICULA_CERTIDAO}}</td>
                            <td>{{$aluno->NIS}}</td>
                            <td>{{$aluno->BOLSA_FAMILIA}}</td>
                            <td>{{$aluno->ENDERECO}}</td>
                            <td>{{$aluno->CIDADE}}</td>
                            <td>{{$aluno->TRANSPORTE}}</td>
                            <td>{{$aluno->FONE}} / {{ $aluno->FONE_II}}</td>
                            <td>{{$aluno->DECLARACAO}}</td>
                            <td>{{$aluno->TRANSFERENCIA}}</td>
                            <td>{{$aluno->NECESSIDADES_ESPECIAIS}}</td>
                            <td>{{$aluno->OBSERVACOES}}</td>
                            <td>{{$aluno->STATUS}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>      
                            <th></th>                
                            <th>NOME</th>
                            <th>TURMA</th>
                            <th>INEP</th>                         
                            <th>NASCIMENTO</th>
                            <th>MÃE</th>
                            <th>PAI</th> 
                            <th>MATRICULA DA CERTIDÃO</th>  
                            <th>NIS</th>
                            <th>BOLSA FAMÍLIA</th>             
                            <th>ENDEREÇO</th>             
                            <th>CIDADE</th>
                            <th>TRANSPORTE</th>  
                            <th>FONE(S)</th> 
                            <th>DECLARAÇÃO</th> 
                            <th>TRANSFERÊNCIA</th> 
                            <th>NECESSIDADES</th> 
                            <th>OBSERVAÇÕES</th> 
                             <th>STATUS</th> 
                        </tr>
                    </tfoot>        
                </table> 
                {{-- <input type="hidden" name="_token" value="{{csrf_token()}}">                
            </form> --}}
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
                        "lengthMenu": " _MENU_ <?php
echo"&nbsp;<a href='alunos/create' target='_self' class = 'btn btn-success' id = 'esconder_bt'><span class = 'glyphicon glyphicon-plus'>&nbsp;Cadastrar</span></a>"
// . "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Turmas' id = 'esconder_list'></button>"
 . "&nbsp;<input type='submit' title = 'Selecione ao menos um aluno(a)'  value='Editar em Bloco' class = 'btn btn-primary' id = 'btEditBloc' onclick= 'return validaCheckbox()' disabled>"
;
?>
                                ",                  
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