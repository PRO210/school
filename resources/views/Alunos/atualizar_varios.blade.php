<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or ''}}</title>
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">  
    <script src="{{url('js/jquery-1.12.4.js')}}" type="text/javascript"></script>           
    <script src="{{url('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{url('css/dataTables.bootstrap.min.css')}}">
    <script src="{{url('js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{url('css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
    <script>
            $(document).ready(function(){
                $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 5px;'>");
            });
    </script>
    <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .checkbox{display: inline-block !important;}    
            @media (max-width: 720px) {#nome{white-space: normal;}   
    </style>
    </head>
    <body>     
                 @include('Menu.menu');
            <div class="container-fluid">  
                <h3 style=" text-align: center;">Atualizar</h3> 
            <p>
                <button id="btnMostrarEsconderBtnTurmas" class="btn btn-warning botoes">Mostrar Turmas</button>
                <button id="btnMostrarEsconderBtnBolsa" class="btn btn-primary botoes" >Bolsa Família</button>                  
                <button id="btnMostrarEsconderBtnTransporte" class="btn btn-success botoes" >Transporte</button>
                <button id="btnMostrarEsconderBtnCoringa" class="btn btn-info botoes" >Outros</button>
               
                <button id='btnMostrarEsconderBtnTurmaExtra' class='btn btn-danger botoes'>Turmas Extra</button>
                <button id="btnMostrarEsconderBtnTransferir" class="btn btn-marron botoes" >Transferir</button>
            </p> <br>
        <form name="cadastrar" action="{{url('alunos/update/agora')}}" method="post" class="form-horizontal" > 
                <input type="hidden" name="_token" value="{{csrf_token()}}">                  
                <div id="divConteudoBtnTurmas" style="background-color: #cc7700; "><br>
                    <div class="form-group">
                        <label for="inputTurma" class="col-sm-3 control-label">Turmas</label>
                        <div class="col-sm-5" >
                            <select class="form-control" name="inputTurma" id="inputTurma" >
                               <option value="1">1</option>
                               <option value="2">2</option>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group" >
                        <div class="col-sm-offset-5 col-sm-9">
                            <button type="submit" name="turma" title = "Selecione ao menos um aluno(a) Antes de Clicar" value="turma" class="btn btn-success btEditBloc" onclick='return confirmarAtualizacao()' >Atualizar</button>
                        </div>
                    </div><br>
                </div> 
                 <!-- Div Bolsa Família-->
                 <div id="divBolsa_Familia">
                    <div  style=" background-color: #286090;"><br>
                        <div class="form-group" >
                            <label for="" class="col-sm-3 control-label">Bolsa Família</label>
                            <div class= "col-sm-offset-3 col-sm-9" >
                                    <label class="radio-inline"><input type="radio" name="optradio" value="SIM">Inserir no Bolsa</label>
                                    <label class="radio-inline"><input type="radio" name="optradio" value="NÃO">Retirar do Bolsa</label><br><br>
                                <button type="submit"  name="bf" title = "Selecione ao menos um aluno(a) Antes de Clicar" value="bf" class="btn btn-success btEditBloc" onclick='return confirmarAtualizacao()' >Atualizar</button>
                            </div>
                        </div><br>
                    </div>
                </div>
                <br>
                <table  id = "example" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>                       
                        <tr>  
                            <th><span><input type="checkbox" class="selecionar" id="check" ></span></th>                     
                            <th>NOME</th>
                            <th>TURMA</th>
                            <th>INEP</th>
                            <th>NASCIMENTO</th>
                            <th>MÃE</th>
                            <th>BOLSA FAMÍLIA</th>
                        </tr>                       
                    </thead>
                       <tbody>
                           @foreach ($teste as $aluno)  
                           <tr>      
                            <td></td>       
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        <li><a href='impressao.php?id={{$aluno->id}}' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>
                                        <li><a href='folha_re_matricula.php?id={{$aluno->id}}' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Ré Matricula</a></li>
                                        <li><a href='declaracoes_bolsa_familia.php?id={{$aluno->id}}' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>
                                        <li><a href='{{route('alunos.edit',$aluno->id)}}' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                        <li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode({{$aluno->id}}) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user text-warning' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>
                                        <li><a href='cadastrar_historico.php?id=" . base64_encode({{$aluno->id}}) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book text-primary' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>
                                    </ul>                              
                                    &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$aluno->id}}'></span>
                                    &nbsp;<span id = "nome">{{$aluno->nome}}</span>
                                </div>                           
                            </td>
                            <td>{{$aluno->id_turma}}</td>
                            <td>{{$aluno->inep}}</td>                   
                            <td>{{\Carbon\Carbon::parse($aluno->nascimento)->format('d/m/Y')}}</td>
                            <td>{{$aluno->mae}}</td>
                            <td>{{$aluno->bf}}</td>
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
                        <th>BOLSA FAMÍLIA</th>             
                    </tr>
                       </tfoot>        
                   </table> 
                   <input type="hidden" name="_token" value="{{csrf_token()}}">                
             </form>     
            </div>      
            <script type="text/javascript">
                function onload() {
                    var c = document.getElementById("check")
                    c.checked = true;
                    $('.checkbox').each(function () {
                            this.checked = true;
                        });
                }
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
                    $('.btEditBloc').removeAttr('disabled');
                }else{
                    $('.btEditBloc').attr('disabled','disabled');
                } 
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
                        "lengthMenu": [[8, 20, 30, 40, 50, 70, 100, -1], [8, 20, 30, 40, 50, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": " _MENU_ ",                  
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
            <!--Div Turmas-->                   <!--Div Turmas-->
        <script type="text/javascript">
            $(document).ready(function () {

                $("#divConteudoBtnTurmas").hide();
                $("#btnMostrarEsconderBtnTurmas").click(function () {
                    $("#divConteudoBtnTurmas").toggle(2000);
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoTurma_Extra").hide();
                $("#btnMostrarEsconderBtnTurmaExtra").click(function () {
                    $("#divConteudoTurma_Extra").toggle(2000);
                });
            });
        </script>        
        <!--Div Turmas Bolsa Família-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divBolsa_Familia").hide();
                $("#btnMostrarEsconderBtnBolsa").click(function () {
                    $("#divBolsa_Familia").toggle(2000);
                });
            });
        </script>
        <!--Div Arquivo Passivo-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoArquivo").hide();
                $("#btnMostrarEsconderBtnArquivo").click(function () {
                    $("#divConteudoArquivo").toggle(2000);
                });
            });
        </script>
        <!--Div Transporte-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoTransporte").hide();
                $("#btnMostrarEsconderBtnTransporte").click(function () {
                    $("#divConteudoTransporte").toggle(2000);
                });
            });
        </script>
        <!--Div Coringa-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#coringa").hide();
                $("#btnMostrarEsconderBtnCoringa").click(function () {
                    $("#coringa").toggle(2000);
                });
            });
        </script>
        <!--Div Transferir-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#transferir").hide();
                $("#btnMostrarEsconderBtnTransferir").click(function () {
                    $("#transferir").toggle(2000);
                });
            });
        </script>
        <script type="text/javascript">
            function confirmarMover() {
                var r = confirm("Realmente deseja Atualizar os Dados?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>       
    </body>
</html>