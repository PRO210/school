<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Notas Impressão</title>
        <style>   
            body{background-color: gray}
            #corpo{
                width: 18.8cm;
                height: 27.5cm;
                border: solid black thin;
                margin: 0 auto;
            }
            th{
                border: solid black thin;    
                font-size: 9px;  
                width: 1cm;   
                border-bottom-width: 0px;
                border-left-width: 0px;   
                height: 4.1mm !important;

            }            
            .disciplina{    
                writing-mode: vertical-lr;
                transform: rotate(180deg);   
                min-height: 2.7cm;
                font-size: 8.5px !Important;

            }
            .vertical{
                writing-mode: vertical-lr;
                transform: rotate(180deg);   
                min-height: 2.7cm;
            }
            .margin_p p{
                margin: 1px; 
            } 
            .texto{   
                text-align: left;
            }
        </style>
    </head>
    <body>     
        <div id="corpo">   
            <table width="100%" cellspacing="0" style='border: solid black thin; border-collapse: collapse;'>
                <tr>
                    <th colspan="2" style='border: solid black thin ; border-collapse: collapse;'>
                        <div class="vertical" >
                            <p>COMPONENTES</p>
                            <p>CURRICULARES</p>                                                       
                        </div>                 
                    </th>
                    @foreach($arrayDisciplinas as $Disciplinas)

                    @if($Disciplinas == "CIÊNCIAS FÍSICA,BIO. E PROGRAMAS DE SAÚDE")
                    <th><div class="disciplina"><p>{{$res_dis}} <br>{{$res_dis1}} <br> {{$res_dis2}}</p></div></th> 

                    @elseif($Disciplinas == "LINGUA ESTRANGEIRA MODERNA (INGLÊS)")
                    <th><div class="disciplina"><p>{{$res_dis4}} <br> {{$res_dis3}}</p></div></th>

                    @elseif($Disciplinas == "ELEMENTOS DE DESENHOS GEOMÉTRICOS")
                    <th><div class="disciplina"><p>{{$res_dis5}} <br> {{$res_dis6}}<br> {{$res_dis7}}</p></div></th>

                    @else
                    <th><div class="disciplina"><p>{{$Disciplinas}}</p></div></th>

                    @endif

                    @endforeach                   
                </tr>

                <tr>                  
                    <th rowspan="6" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">
                            <p> 1° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>1° ANO (&nbsp;&nbsp;{{$marcarX or ''}}&nbsp;&nbsp;) </p>                         
                        </div>                     
                    </th>
                </tr> 
                <th>Notas</th>
                @foreach ($arrayNota as $nota)
                <th>{{$nota}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados->ESCOLA_DIAS or ""}}</th>
                    <th class="numero">D</th>
                    <th class="numero">I</th>
                    <th class="numero">A</th>
                    <th class="numero">S</th>
                    <th class="numero"></th>
                    <th class="numero">L</th>
                    <th class="numero">E</th>
                    <th class="numero">T</th>
                    <th class="numero">I</th>
                    <th class="numero">V</th>
                    <th class="numero">O</th>
                    <th class="numero">S</th>
                    <th class="numero"></th>
                    <th></th>
                </tr>  

                <tr>
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  

                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados->ESTADO or ""}}</p></th> 

                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 2 ano--> 
                <tr>                  
                    <th rowspan="6" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">
                            <p>1° FASE (&nbsp;&nbsp;{{$marcarX21 or ''}}&nbsp;&nbsp;) </p> 
                            <p> 1° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>2° ANO (&nbsp;&nbsp;{{$marcarX2 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>                                         </th>
                </tr> 
                <th>Notas</th>
                @foreach ($arrayNota2 as $nota2)
                <th>{{$nota2}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados2->ESCOLA_DIAS or ""}}</th>
                    <th class="numero">D</th>
                    <th class="numero">I</th>
                    <th class="numero">A</th>
                    <th class="numero">S</th>
                    <th class="numero"></th>
                    <th class="numero">L</th>
                    <th class="numero">E</th>
                    <th class="numero">T</th>
                    <th class="numero">I</th>
                    <th class="numero">V</th>
                    <th class="numero">O</th>
                    <th class="numero">S</th>
                    <th class="numero"></th>
                    <th></th>
                </tr>  

                <tr>
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados2->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados2->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  

                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados2->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados2->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados2->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados2->ESTADO or ""}}</p></th> 

                </tr>






            </table>
        </div>      
    </body>
</html>
