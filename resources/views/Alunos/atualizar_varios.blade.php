<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or ''}}</title>

        <script src="{{url('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>           
        <script src="{{url('assets/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>

        <script src="{{url('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

        <link rel="stylesheet" href="{{url('assets/css/dataTables.bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" type="text/css">
        <script src="{{url('assets/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
        <script src="{{url('js/bootstrap.min.js')}}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{url('assets/css/responsive.dataTables.min.css')}}">

        <script>
$(document).ready(function () {
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
                    <table  id = "" class="nowrap table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead>                       
                            <tr>  
                                <th><span><input type="checkbox" class="selecionar" id="check" checked = "" ></span></th>                     
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
                        <div class="dropdown">
                            <td>                                                        
                                &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$aluno->ID}}' checked></span>
                                &nbsp;<span id = "nome">{{$aluno->NOME}}</span>
                            </td>
                        </div>                           

                        <td>{{$aluno->TURMA}}</td>
                        <td>{{$aluno->INEP}}</td>                   
                        <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                        <td>{{$aluno->MAE}}</td>
                        <td>{{$aluno->BOLSA_FAMILIA}}</td>

                        </tr>
                        @endforeach
                        </tbody>                              
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
                    } else {
                        $('.btEditBloc').attr('disabled', 'disabled');
                    }
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