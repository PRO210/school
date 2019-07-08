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
            <form name="cadastrar" action="{{url('aluno/solicitação/transferência')}}" method="post" class="form-horizontal btn-block" > 
                <input type="hidden" name="_token" value="{{csrf_token()}}">                
                <input type="hidden" class="form-control"  name="aluno_id" value="{{$id}}" >
                <input type="hidden" class="form-control"  name="turma_id" value="{{$id_turma}}" >
                <input type="hidden" class="form-control"  name="aluno_classificacao_id" value="{{$id_classificacao}}" >
                <h3 style="text-align: center">ALUNO(A): &nbsp;&nbsp; {{$aluno->NOME}}&nbsp;&nbsp;<b></b>Turma Atual:&nbsp;&nbsp;{{$turma_atual}}  <b></b></h3>
              
                    <!--Solicitar ou pesquisar transferencias//-->
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
                                <input style="width: 100%" type="text" name="SOLICITANTE" id="" placeholder="Nome do(a) Solicitante" onkeyup="maiuscula(this)">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                <input id="idData" type="date" name="DATA_SOLICITACAO" >
                            </th>
                        </tr>
                        <tr>
                            <th >&nbsp;
                                <button name="botao" value="pesquisar_transferencia" class="btn btn-success btn-block" onclick="return confirmarAtualizacao()">Pesquisar</button>
                            </th>
                            <th>&nbsp;&nbsp; 
                                <button name="botao" value="solicitar_transferencia" class="btn btn-primary btn-block" onclick="return confirmarAtualizacao()">Solicitar</button>
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
