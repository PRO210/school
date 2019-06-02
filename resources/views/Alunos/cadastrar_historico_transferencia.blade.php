<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>{{$title or 'Scholl 2019'}}</title>
        <style>
            #input_escola{width: 100%}

        </style>
    </head>
    <body>
        @include('Alunos.alunos_css');
        @include('Menu.menu');
        <div class="container-fluid"> 
            <form class="form-inline" action="" method="post" name="form">
                {{-- {!! Form::open(['route' => 'alunos.store','class' => 'form-control','name' => 'form1'])!!} --}}    
                <input type="hidden" class="form-control" id="" name="inputId" value="" >
                <h4 style="text-align: center">HISTÓRICO DO(A) ALUNO(A): &nbsp;&nbsp; {{$aluno->NOME}}&nbsp;&nbsp;<b></b>Turma Atual:&nbsp;&nbsp;{{$turma_atual}}  <b></b></h4>
                <div class="col-md-6">                   
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center" colspan="2">CADASTRAR NOVO HISTÓRICO</th>
                            </tr>
                        </thead>                               
                        <tbody>
                            <tr>                                
                                <th colspan="2">
                                    <select class="form-control" name="ANO" id="Ano"  style="width: 100% !important">
                                        <option  selected="" value="Selecione o Ano">Selecione o Ano </option>
                                        @foreach($anos as $ano)
                                        <option>{{$ano}}</option>
                                        @endforeach
                                    </select>
                                </th>                                
                            </tr> 
                            <tr>
                                <td id = 'thNome' colspan="2"><input id = 'input_escola' type = 'text' name = 'inputEscola' placeholder = 'Nome da Escola' onkeyup='maiuscula(this)'></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputCidade' placeholder = 'Cidade' onkeyup='maiuscula(this)'></td>                              
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputUf' placeholder = 'Estado' onkeyup='maiuscula(this)'></td>                            
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputTurma' placeholder = 'Turma' onkeyup='maiuscula(this)'></td>                             
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputTurno' placeholder = 'Turno' onkeyup='maiuscula(this)'></td>                             
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputUnica' placeholder = 'Única' onkeyup='maiuscula(this)'></td>                            
                            </tr>
                            <tr>                                
                                <?php
                                echo "<th>"
                                . "&nbsp;&nbsp;<button disabled = '' id = 'criar_historico' type='submit' value='criar' name = 'botao' class='btn btn-success  btn-block' onclick = 'return confirmarExclusao2()' >CRIAR NOVO HISTÓRICO</button>"
                                . "</th>";
                                ?>                       
                                <?php
                                echo "<th>"
                                . "&nbsp;&nbsp;<button type='reset' value='' name ='botao' class='btn btn-danger  btn-block'>&nbsp;&nbsp;LIMPAR OS CAMPOS DIGITADOS</button>"
                                . "</th>";
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div> 
                <!--Busca Por historicos//-->
                <div class="col-md-6">                           
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center" colspan="2">HISTÓRICOS JÁ CADASTRADOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <select class='form-control' name='inputAno1' style="width: 100% !important" id="inputAno1">   

                                    </select>                                        
                                </td>
                            </tr>
                            <tr>                                        
                                <td>&nbsp;&nbsp;
                                    {!! Form:: submit('Pesquiar',['class' => 'btn btn-success btn-block','name' =>'botao','value'=>'pesquisar','onclick'=>'return confirmarAtualizacao()'])!!}  
                                </td>
                                <td>&nbsp;&nbsp;                                                                                          
                                    {!! Form:: submit('Excluir',['class' => 'btn btn-danger btn-block','name' =>'botao','value'=>'exclui_historico','onclick'=>'return confirmarAtualizacao()','id' => 'exclui_historico'])!!}  
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                    <br>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center; " colspan="3">SOLICITAR TRANSFERÊNCIA</th>
                            </tr>
                        </thead>
                        <tr>
                            <th colspan="3" style="height:48px;">                                    
                                Não Existe Pedidos de Transferência(s) para Esse Aluno(a)!
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                <input style="width: 100%" type="text" name="inputSolicitante" id="idSolicitante" placeholder="Nome do(a) Solicitante" onkeyup="maiuscula(this)">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                <input id="idData" type="date" name="inputData">
                            </th>
                        </tr>
                        <tr>
                            <th >&nbsp;
                                {!! Form:: submit('Pesquiar',['class' => 'btn btn-success btn-block','name' =>'botao','value'=>'pesquisar','onclick'=>'return confirmarAtualizacao()'])!!}
                            </th>
                            <th>&nbsp;&nbsp; 
                                {!! Form:: submit('Consultar',['class' => 'btn btn-success btn-block','name' =>'botao','value'=>'consultar','onclick'=>'return confirmarAtualizacao()'])!!}  
                            </th>
                            <th>&nbsp;&nbsp;<button type='reset' value='' name ='botao' class='btn btn-danger btn-block '>&nbsp;&nbsp;Limprar&nbsp;&nbsp;</button></th>
                        </tr>
                    </table>

                </div>  
            </form>
        </div>
        <script src="{{url('js/alunos/historico_transferencia.js')}}" type="text/javascript"></script>
    </body>
</html>
