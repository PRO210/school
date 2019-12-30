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
            @include('bootstrap4')
            @include('Menu.menu')
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
                });
            </script>            
            <h3 style="text-align:center; margin-top: 36px ">Alunos Cursando ou Admitidos Depois</h3>
            @include('msg')
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
                                        <li><a><button type='submit' value='geral' name = 'botao' class='btn btn-link '  onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'></span></button>Geral</a></li>
                                    </ul>
                                </div>
                            </th>                     
                            <th>NOME</th>
                            <th>TURMA</th>
                            <th>INEP</th>                           
                            <th>NASCIMENTO</th>
                            <th>MÃE</th>
                            <!--<th>PAI</th>-->     
                            <th>MATRICULA DA CERTIDÃO</th>  
                            <th>NIS</th>
                            <!--<th>BOLSA FAMÍLIA</th>-->
<!--                            <th>ENDEREÇO</th>             
                            <th>CIDADE</th>  -->
                            <th>TRANSPORTE</th>  
                            <th>FONE(S)</th> 
<!--                            <th>DECLARAÇÃO</th> 
                            <th>TRANSFERÊNCIA</th> -->
                            <th>NECESSIDADES</th> 
                            <th>OBSERVAÇÕES</th> 
                            <th>STATUS</th>

                        </tr>
                    </thead>
                    <tbody>  

                        @foreach($alunos as $aluno)                       
                        @foreach($aluno as $key=> $dados)                   
                        @if($key == 'NOME')
                        <?php $alunoNome = $dados ?>
                        @elseif($key == 'aluno_id')
                        <?php $alunoId = $dados ?>
                        @elseif($key == 'turma_id')
                        <?php $turmaId = $dados ?>
                        @elseif($key == 'TURMA')
                        <?php $turma = $dados ?>
                        @elseif($key == 'UNICO')
                        <?php $turmaUnico = $dados ?>
                        @elseif($key == 'TURNO')
                        <?php $turmaTurno = $dados ?>
                        @elseif($key == 'ANO')
                        <?php $turmaAno = $dados ?>
                        @elseif($key == 'INEP')
                        <?php $alunoInep = $dados ?>
                        @elseif($key == 'MAE')
                        <?php $alunoMae = $dados ?>
                        @elseif($key == 'MATRICULA_CERTIDAO')
                        <?php $alunoMatCert = $dados ?>
                        @elseif($key == 'NIS')
                        <?php $alunoNis = $dados ?>
                        @elseif($key == 'ENDERECO')
                        <?php $alunoEndereco = $dados ?>
                        @elseif($key == 'CIDADE')
                        <?php $alunoCidade = $dados ?>
                        @elseif($key == 'FONE')
                        <?php $alunoFone = $dados ?>
                        @elseif($key == 'FONE_II')
                        <?php $alunoFone_II = $dados ?>
                        @elseif($key == 'NECESSIDADES_ESPECIAIS')
                        <?php $alunoNecEsp = $dados ?>
                        @elseif($key == 'OBSERVACOES')
                        <?php $alunoObs = $dados ?>
                        @elseif($key == 'STATUS')
                        <?php $alunoStus = $dados ?>
                        @endif

                        @endforeach   
                        <tr>     
                            <td></td>       
                            <td>
                                <div class="dropdown">
                                    &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                        @can('EDITAR_ALUNOS')
                                        <li><a href='impressao.php?id={{''}}' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>
                                        <li><a href='declaracoes_bolsa_familia.php?id={{''}}' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>
                                        <li><a href="{{route('edição/aluno',['id' => Crypt::encrypt($alunoId),'id_turma' => $turmaId])}}" target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                        <li><a href="{{route('edição/turma',['id' => Crypt::encrypt($alunoId)])}}" target='_self' title='Incluir/Retirar da Turma'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Incluir/Retirar da Turma</a></li>
                                        <li><a href='{{route('transferência',['id' => Crypt::encrypt($alunoId),'id_turma' => $turmaId])}}' target='_self' title='Transferência/Solicitações'><span class='glyphicon glyphicon-sort text-warning' aria-hidden='true'>&nbsp;</span>Transferências</a></li> 
                                        <li><a href='{{route('histórico',['id' => Crypt::encrypt($alunoId),'id_turma' => $turmaId])}}' target='_self' title='Históricos'><span class='glyphicon glyphicon-book text-primary' aria-hidden='true'>&nbsp;</span>Históricos</a></li>
                                        <li><a href="{{route('aluno/deletar',['id' => Crypt::encrypt($alunoId),'botao'=>'cursando'])}}" target='_self' title='Deletar'onclick="return deletar()"><span class='glyphicon glyphicon-trash text-danger ' aria-hidden='true' >&nbsp;</span>Deletar Aluno Do Sistema</a></li>

                                        @endcan
                                        <li><a href='{{route('visualizar',['id' => Crypt::encrypt($alunoId),'id_turma' => ''])}}' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user text-info' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>
                                    </ul>                              
                                    &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{$alunoId}}/{{$turmaId}}'></span>
                                    &nbsp;<span id = "nome">{{$alunoNome}}</span>
                                </div>  
                            <td>{{$turma}} {{$turmaUnico}} ({{$turmaTurno}}) - {{\Carbon\Carbon::parse($turmaAno)->format('Y')}}</td>
                            <td>{{$alunoInep}}</td>                  
                            <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                            <td>{{$alunoMae}}</td>
                            <!--<td>{{$aluno->PAI}}</td>-->
                            <td>{{$alunoMatCert}}</td>
                            <td>{{$alunoNis}}</td>
                            <!--<td>{{$aluno->BOLSA_FAMILIA}}</td>-->
<!--                            <td>{{$alunoEndereco}}</td>
                            <td>{{$alunoCidade}}</td>-->
                            <td>{{$aluno->TRANSPORTE}}</td>
                            <td>{{$alunoFone}} / {{$alunoFone_II}}</td>
<!--                            <td>{{$aluno->DECLARACAO}}</td>
                            <td>{{$aluno->TRANSFERENCIA}}</td>-->
                            <td>{{$alunoNecEsp}}</td>
                            <td>{{$alunoObs}}</td>
                            <td>{{$alunoStus}}</td> 
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
                            <!--<th>PAI</th>--> 
                            <th>MATRICULA DA CERTIDÃO</th>  
                            <th>NIS</th>
                            <!--<th>BOLSA FAMÍLIA</th>-->             
<!--                            <th>ENDEREÇO</th>             
                            <th>CIDADE</th>-->
                            <th>TRANSPORTE</th>  
                            <th>FONE(S)</th> 
<!--                            <th>DECLARAÇÃO</th> 
                            <th>TRANSFERÊNCIA</th> -->
                            <th>NECESSIDADES</th> 
                            <th>OBSERVAÇÕES</th> 
                            <th>STATUS</th>
                        </tr>
                    </tfoot>        
                </table> 
                {{-- <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
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
                        echo"&nbsp;<a href='alunos/create' target='_self' class = 'btn btn-success' id = 'esconder_bt'><span class = 'glyphicon glyphicon-plus'>&nbsp;Cadastrar</span></a>"
// . "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Turmas' id = 'esconder_list'></button>"
                        . "&nbsp;<input type='submit' title = 'Selecione ao menos um aluno(a)' name = 'botao' value='Editar em Bloco' class = 'btn btn-primary' id = 'btEditBloc' onclick= 'return validaCheckbox()' disabled>"
                        ;
                        ?>@endcan",
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
            <script src="{{url('js/alunos/listar.js')}}" type="text/javascript"></script>
        </body>
    </html>