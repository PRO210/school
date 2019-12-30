<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title or 'Scholl 2019'}}</title>  
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            .glyphicon-print{font-size: 16px !important;}
            .dropdown-menu > li > a {padding-bottom: 4px;}
            .checkbox{display: inline-block !important;} 
            @media (max-width: 720px) {#nome{white-space: normal};
                                       @media (max-width: 720px) {.btvalida{margin-bottom: 12px !important};
                                                                  .spb{ margin-right: 12px !important;};

                                       </style>            
            </head>
            <body>
                @include('Alunos.alunos_css')
                @include('Menu.menu')
                <script>
                    $(document).ready(function () {
                        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
                    });
                </script>            
                <h3 style="text-align:center; margin-top: 36px ">Transferências </h3>

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
                            $('#exemplomodal').modal('hide');
                        }
                        @endif
                    </script>  

                    <div class="container-fluid">      

                        {{-- {{$impressao}}imprimir do php --}}
                        {{-- {!!$xss!!} imprimir do java --}}          

                        {!!Form::open(['url' => 'alunos/solicitações/transferência/update','name' => 'form1'])!!}                        
                        {{-- {!! Form::open(['route' => 'alunos.store','class' => 'form-control','name' => 'form1'])!!} --}}      
                        <!--<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">--> 
                        <div class = "row" style = "margin-bottom:12px">
                            <div class="col-sm-4" >
                                <!--<a href="" target="_self"><button type="submit" value="" class="btn btn-warning btn-block botoes"><span class='glyphicon glyphicon-print text-success' aria-hidden='true' style="margin-right: 12px;color: white"></span>Capa da Transferência</button></a>-->      
                                <button type="submit" style="margin-bottom: 12px" name="botao" value="folha_rosto" class="btn btn-warning btn-block btvalida" disabled=""><span class='glyphicon glyphicon-print text-success' aria-hidden='true' style="margin-right: 12px;color: white"></span>Capa da Transferência</button>    
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" style="margin-bottom: 12px" name="botao" value="folha_notas" class="btn btn-primary btn-block btvalida" disabled=""><span class='glyphicon glyphicon-print text-success' aria-hidden='true' style="margin-right: 12px;color: white"></span>Notas para a Transferência</button>    
                            </div>
                            <div class="col-sm-4">                
                                <button type="button" style="margin-bottom: 12px" class="btn btn-success btn-block btvalida"  data-toggle="modal" data-target="#myModal" disabled="" onclick="json()" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Atualizar a Transferência</button>
                            </div>
                            <!--                            <div class="col-sm-3">
                                                            <button type="submit" style="margin-bottom: 12px" name ="botao" value="retirar" class="btn btn-danger btn-block btvalida" disabled="" onclick="return confirmarExclusao()" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Retirar Pedido De Transferência</button>
                                                        </div>-->
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
                                    <th>STATUS DO ALUNO</th> 
                                    <th>TURMA</th>
                                    <th>SOLICITANTE</th>                             
                                    <th>SOLICITAÇÃO</th>                              
                                    <th>STATUS DA <br> TRANSFERÊNCIA</th>                    
                                    <th>ENTREGUE/PRONTA</th>    
                                    <th>OBSERVAÇÕES</th> 
                                </tr>
                            </thead>
                            <tbody>                                   
                                @foreach($alunos as $aluno)                     
                                @foreach($aluno->transferidos as $key => $turma)                     
                                <tr>     
                                    <td></td>       
                                    <td>
                                        <div class="dropdown">
                                            &nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                            <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                                @can('EDITAR_ALUNOS')
                                                <li><a href='impressao.php?id={{''}}' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print text-success' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>

                                                @if($aluno->status[$key]->STATUS =="TRANSFERIDO")
                                                <li><a href='{{route('declaração/transferência',['aluno_id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print text-success ' aria-hidden='true'>&nbsp;</span>Declaração de Transferência</a></li>
                                                @else
                                                <li><a href="#"><span  class='glyphicon glyphicon-minus '  aria-hidden='true'>&nbsp;</span>Aluno não Tranferido Ainda<br>Impossível Declaração de Transferência</a></li>
                                                @endif

                                                <li><a href="{{route('edição/aluno',['id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}" target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil ' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>
                                                <li><a href="{{route('pedido/deletar',['id' => Crypt::encrypt($turma->pivot->id)])}}" target='_self' title='Deletar'><span class='glyphicon glyphicon-trash text-danger ' aria-hidden='true' >&nbsp;</span>Deletar Pedido de Transferência</a></li>
                                                <li><a href='{{route('histórico',['id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}' target='_self' title='Histórico/Transferência/Solicitações'><span class='glyphicon glyphicon-book text-primary' aria-hidden='true'>&nbsp;</span>Históricos</a></li>

                                                @if($aluno->status[$key]->STATUS =="TRANSFERIDO")
                                                <li><a href="{{route('arquivo',['aluno_id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}" target='_self' title='Arquivar Aluno'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' >&nbsp;</span>Mover Aluno(a) para o Arquivo</a></li>
                                                @else
                                                <li><a href="#" target='_self' title=''><span class='glyphicon glyphicon-minus' aria-hidden='true' >&nbsp;</span>Aluno Não Tranferido Ainda<br>Impossível Mover para o Arquivo</a></li>
                                                @endif



                                                @endcan
                                                <li><a href='{{route('visualizar',['id' => Crypt::encrypt($aluno->id),'id_turma' => $turma->id])}}' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user text-warning' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>
                                            </ul>                              
                                            &nbsp;&nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='{{Crypt::encrypt($aluno->id)}}/{{$turma->id}}/{{$turma->pivot->aluno_classificacao_id}}/{{$turma->pivot->id}}'></span>
                                            &nbsp;<span id = "nome">{{$aluno->NOME}}</span>
                                        </div>                           
                                    </td>  
                                    <td>{{$aluno->status[$key]->STATUS}}</td>                            
                                    <td>{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>


                                    <td>{{$turma->pivot->SOLICITANTE}}</td>                  
                                    <td>{{\Carbon\Carbon::parse($turma->pivot->DATA_SOLICITACAO)->format('d/m/Y')}}</td>
                                    <td>{{$turma->pivot->TRANSFERENCIA_STATUS}}</td>  

                                    <td>{{\Carbon\Carbon::parse($turma->pivot->DATA_TRANSFERENCIA_STATUS)->format('d/m/Y')}}</td>

                                    <td>{{$aluno->OBSERVACOES}}</td>

                                </tr>
                                @endforeach                     
                                @endforeach                     
                            </tbody>
                            <tfoot>
                                <tr>      
                                    <th></th>                
                                    <th>NOME</th>
                                    <th>STATUS DO ALUNO</th> 
                                    <th>TURMA</th>  
                                    <th>STATUS DA <br>TRANSFERÊNCIA</th>                     
                                    <th>SOLICITANTE</th>
                                    <th>SOLICITAÇÃO</th>
                                    <th>ENTREGUE/PRONTA</th>    
                                    <th>OBSERVAÇÕES</th> 
                                </tr>
                            </tfoot>        
                        </table> 
                        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}">--}}     
                        @include('Alunos.listar_transferidos_json')
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
                                    "lengthMenu": "_MENU_ ",
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
                </body>
            </html>