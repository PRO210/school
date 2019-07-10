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
        @include('Menu.menu')

        <div class="container-fluid"> 
            <form name="cadastrar" action="{{url('aluno/históricos')}}" method="post" class="form-horizontal btn-block" > 
                <input type="hidden" name="_token" value="{{csrf_token()}}">                
                <input type="hidden" class="form-control"  name="aluno_id" value="{{$id}}" >
                <input type="hidden" class="form-control"  name="turma_id" value="{{$id_turma}}" >
                <input type="hidden" class="form-control"  name="aluno_classificacao_id" value="{{$aluno_classificacao_id}}" >
                <div class="col-md-12"><p style="margin-top: 12px ">HISTÓRICO DO(A) ALUNO(A):&nbsp; {{$aluno->NOME}},&nbsp;&nbsp;<b></b>Turma(s) Cadastrada(s):&nbsp;&nbsp;{{$turma_atual}}  <b></b></p>
                </div>

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
                                <td id = 'thNome' colspan="2"><input id = 'input_escola' type = 'text' name = 'ESCOLA' placeholder = 'Nome da Escola' onkeyup='maiuscula(this)'></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'CIDADE' placeholder = 'Cidade' onkeyup='maiuscula(this)'></td>                              
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'ESTADO' placeholder = 'Estado' onkeyup='maiuscula(this)'></td>                            
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'TURMA' placeholder = 'Turma' onkeyup='maiuscula(this)'></td>                             
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'TURNO' placeholder = 'Turno' onkeyup='maiuscula(this)'></td>                             
                            </tr>
                            <tr>
                                <td colspan="2"><input id = 'input_escola' type = 'text' name = 'UNICO' placeholder = 'Única' onkeyup='maiuscula(this)'></td>                            
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
                </div> <br>
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
                                    <select class='form-control' name='ANO2' style="width: 100% !important" id="inputAno1">   
                                        @forelse ($aluno_historicos as $aluno_historico)
                                        <option>{{$aluno_historico->ANO}}</option>
                                        @empty
                                        <option>Não Existe Histórico Cadastrado</option>   
                                        @endforelse
                                    </select>                                        
                                </td>
                            </tr>
                            <tr>                                        
                                <td>&nbsp;&nbsp;
                                    <button type="submit" name="botao" value="pesquisar" class="btn btn-success btn-block" onclick="return confirmarAtualizacao()">Pesquisar</button>
                                    </a>

                                </td>
                                <td>&nbsp;&nbsp;                                                                                          
                                    {!! Form:: submit('Excluir',['class' => 'btn btn-danger btn-block','name' =>'botao','value'=>'exclui_historico','onclick'=>'return confirmarAtualizacao()','id' => 'exclui_historico'])!!}  

                                </td>
                            </tr>
                        </tbody>
                    </table>  
                    <br>                   
                </div>  
            </form>
        </div>
        <script src="{{url('js/alunos/historico_transferencia.js')}}" type="text/javascript"></script>
    </body>
</html>
