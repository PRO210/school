<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Arquivo Passivo</title>
        <style>
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
            @include('msg')
            @if($teste == 1)     
            {!! Form::model($arquivado,['route' => ['arquivos.update',$arquivado->id],'class' => 'form-horizontal','name' => 'form1', 'method'=> 'put'])!!} 
            @else
            <!--{!! Form::open(['route' => 'arquivos.store','class' => 'form-horizontal','name' => 'form1'])!!}-->         
            @endif
            <div class="container-fluid"> 
                <h3 style="text-align:center; ">Arquivo Passivo </h3>
                <div class="col-sm-4" style="margin-bottom: 12px">
                    @if($teste == 1) 
                    <button type="submit" name="botao" value="retirar"  class=" btn btn-success btn-block ">Retirar do Aquivo</button>
                    @else
                    <button type="submit" name="botao" value="retirar"  class=" btn btn-success btn-block" disabled="">Retirar do Aquivo</button>
                    @endif
                </div>
                <div class="col-sm-4" style="margin-bottom: 12px">                    
                    <a href='arquivos/create' target='_self' id = 'esconder_bt' class=" btn btn-warning btn-block ">Editar o Aquivo</a>
                </div>
                <div class="col-sm-4" style="margin-bottom: 12px">                    
                    <a href='{{route('arquivado')}}' target='_self' id = 'esconder_bt' class=" btn btn-primary btn-block ">Colocar no Arquivo</a>
                </div>
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
                            <th>NASCIMENTO</th>
                            <th>PASTA</th>
                            <th>MÃE</th>
                            <th>PAI</th> 
                        </tr>
                    </thead>
                    <tbody>            
                        @if($teste == 1)    
                        @foreach($arquivados as $aluno)  
                        @foreach($aluno->turmas as $key=> $turma) 
                        @endforeach  
                        <tr>     
                            <td></td>       
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        @can('EDITAR_ALUNOS')
                                        <li><a href='impressao.php?id={{''}}' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>
                                        <!--<li><a href='declaracoes_bolsa_familia.php?id={{''}}' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>-->
                                        <li><a href="{{route('edição/aluno',['id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}" target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                        <!--<li><a href="{{route('edição/turma',['id' => Crypt::encrypt($aluno->id)])}}" target='_self' title='Incluir/Retirar da Turma'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Incluir/Retirar da Turma</a></li>-->
                                        <!--<li><a href='{{route('transferência',['id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}' target='_self' title='Transferência/Solicitações'><span class='glyphicon glyphicon-sort text-warning' aria-hidden='true'>&nbsp;</span>Transferências</a></li>--> 
                                        <li><a href='{{route('histórico',['id' => Crypt::encrypt($aluno->id)])}}' target='_self' title='Históricos'><span class='glyphicon glyphicon-book text-primary' aria-hidden='true'>&nbsp;</span>Históricos</a></li>
                                        <li><a href="{{route('arquivos/deletar',['id' => Crypt::encrypt($aluno->id)])}}" target='_self' title='Deletar'onclick="return deletar()"><span class='glyphicon glyphicon-trash text-danger ' aria-hidden='true' >&nbsp;</span>Deletar Aluno Do Sistema</a></li>
                                        @endcan
                                        <li><a href='{{route('visualizar',['id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user text-info' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>
                                    </ul>                              
                                    &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$aluno->id}}/{{$turma->id}}'></span>
                                    &nbsp;<span id = "nome">{{$aluno->NOME}}</span>
                                </div>                           
                            </td>  
                            <!--<td>{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>-->
                            <!--<td>{{$aluno->INEP}}</td>-->               
                            <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                            <td>{{$aluno->EXCLUIDO_PASTA}}</td>    
                            <td>{{$aluno->MAE}}</td>
                            <td>{{$aluno->PAI}}</td>
                        </tr>
                        @endforeach 
                    </tbody>
                    @else
                    <tr><td colspan="6">NADA ENCONTRADO</td></tr>
                    @endif
                    <tfoot>
                        <tr>      
                            <th></th>               
                            <th>NOME</th>
                            <th>NASCIMENTO</th>
                            <th>PASTA</th>
                            <th>MÃE</th>
                            <th>PAI</th>
                        </tr>
                    </tfoot>
                </table>

                @include('Arquivos.tabela_listar_arquivo')
            </div>
            {!! Form:: close()!!} 
            <script type="text/javascript">
         //Confirmar deletar
                function deletar() {
                    var u = $('#usuario').val();
                    var r = confirm("Já Posso Deletar " + u + "? ");
                    if (r == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
        </body>
    </html>
