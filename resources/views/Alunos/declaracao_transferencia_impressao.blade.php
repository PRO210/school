<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #corpo{
                width: 18cm;height: 27cm;
                /*border: solid black thin;*/
                margin: 0 auto;
            }
            #timbre{width: 18cm; height: 4cm; }
            h2{font-size: 22px;text-align: center}
            h3{text-align: center}
            .resultado{display: inline-block;margin-left: 2.2cm}

        </style>
    </head>
    <body>
        <div id="corpo">
            <div id="timbre">
                Timbre
            </div>
            <h2>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</h2><br>
            <h3>DECLARAÇÃO DE TRANSFERÊNCIA</h3><br>
            @foreach($alunos as $aluno)   
            @foreach($aluno->turmas as $turma)
                                    
            <p style="text-align: justify;margin: 12px;text-indent: 1.5cm;">Declaro que <b>{{$aluno->NOME}}</b>, filho (a) de {{$aluno->MAE}}  {{$aluno->PAI}}, nascido(a) no dia {{\Carbon\Carbon::parse($turma->ANO)->format('d/m/Y')}}, na
                cidade de {{$aluno->NATURALIDADE}}, Estado: {{$aluno->ESTADO}}. Tem direito a matricular-se no <b>{{$turma->TURMA}}</b>  do (&nbsp;&nbsp;)série &nbsp;(&nbsp;{{$grau}}&nbsp;)ano&nbsp; (&nbsp;{{$fase}}&nbsp;)fase, do curso de {{$categoria}}. 
            </p>                       
            @endforeach                     
            @endforeach 
            <br><br>
            <h3>Desde que obteve na série anterior o seguinte resultado :</h3><br>
            <div class="resultado">
                <p>(&nbsp;&nbsp;{{$aprovado}}) APROVADO</p>               
            </div>
            <div  class="resultado">
                <p>(&nbsp;&nbsp;{{$reprovado}}) REPROVADO</p>
            </div>
            <div  class="resultado">
                <p>(&nbsp;&nbsp;{{$desistente}}) DESISTENTE</p>
            </div><br><br>
            @if($transferencia =='SIM')
            <p style="text-align: justify;margin: 12px;text-indent: 1.5cm;">
                O Diretor deste estabelecimento compromete-se a fornecer no prazo de 15 dias o Histórico Escolar do referido aluno, atendendo as exigências prescritas nos Artigos 23, 24 da Resolução 10/73 do Conselho Estadual de Pernambuco. 
            </p>
            @else
            <p style=" width: 18cm;height: 1cm"></p>
            @endif
            <br><br>
            <p style="text-align: center">
                Alagoinha, {{$dia}} de {{$mes}} de {{$ano}} .
            </p><br><br>
            <p style="text-align: center">_____________________________________________________</p>
            <p style="text-align: center;margin-top: -12px">DIRETORA</p>
            <div style="width: 18cm;height: 3.7cm "></div>
            <b>
                <p style="font-size: 9px; text-align: center">Rua Dr. Francisco Simões,S/N,Centro. ALAGOINHA - PE, CEP:55260-000<br>
                    E-mail.:tabeliaoraul2017@gmail.com
                </p>
            </b>


        </div>
    </body>
</html>
