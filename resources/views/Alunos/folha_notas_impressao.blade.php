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
            .rodape{
                position: relative;
                float: left;
                width: 9cm;
                text-align: center;
                text-decoration: overline;
                font-size: 12px;
                padding-top: 0.3cm;

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
                    <th rowspan="7" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">
                            <p>1° FASE (&nbsp;&nbsp;{{$marcarXEja or ''}}&nbsp;&nbsp;) </p> 
                            <p> 2° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>2° ANO (&nbsp;&nbsp;{{$marcarX2 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>                                         </th>
                </tr> 
                <th>Notas</th>
                @if ($teste2)
                @foreach ($arrayNota2 as $nota2)                
                <th>{{$nota2}}</th>
                @endforeach  
                @else
                @foreach ($arrayNotaEja as $notaEja)
                <th>{{$notaEja}}</th>
                @endforeach  
                @endif                  
                <tr>     
                    <th>CH</th>
                    <th class="numero">
                        @if ($teste2)
                        {{$aluno_historico_dados2->ESCOLA_DIAS or ""}}
                        @else
                        {{$aluno_historico_dadosEja->ESCOLA_DIAS or ""}}
                        @endif
                    </th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;
                        @if ($teste2)
                        {{$aluno_historico_dados2->ESCOLA_HORAS or ""}}
                        @else
                        {{$aluno_historico_dadosEja->ESCOLA_HORAS or ""}}
                        @endif
                    </th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;
                        @if ($teste2)
                        {{$aluno_historico_dados2->ALUNO_FREQUENCIA or ""}}%
                        @else
                        {{$aluno_historico_dadosEja->ALUNO_FREQUENCIA or ""}}%
                        @endif
                    </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: 
                        @if ($teste2)
                        {{$aluno_historico_dados2->ESCOLA or ""}} 
                        @else
                        {{$aluno_historico_dadosEja->ESCOLA or ""}} 
                        @endif
                    </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: 
                            @if ($teste2)
                            {{$aluno_historico_dados2->ANO or ""}}
                            @else
                            {{$aluno_historico_dadosEja->ANO or ""}}
                            @endif
                        </p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: 
                            @if ($teste2)
                            {{$aluno_historico_dados2->CIDADE or ""}}
                            @else
                            {{$aluno_historico_dadosEja->CIDADE or ""}}
                            @endif
                        </p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: 
                            @if ($teste2)                            
                            {{$aluno_historico_dados2->ESTADO or ""}}
                            @else
                            {{$aluno_historico_dadosEja->ESTADO or ""}}
                            @endif
                        </p></th> 
                </tr>
                <tr>
                    <th colspan="16" style="text-align: left;">RESULTADO APOS A PROGRESSÃO PARCIAL:(&nbsp;&nbsp;&nbsp;)Plena &nbsp;&nbsp;&nbsp;Ano:</th>
                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 3 ano--> 
                <tr>                  
                    <th rowspan="7" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">
                            <p>1° FASE (&nbsp;&nbsp;{{'' or ''}}&nbsp;&nbsp;) </p>                           
                            <p>3° ANO (&nbsp;&nbsp;{{$marcarX3 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>                                         </th>
                </tr> 
                <th>Notas</th>
                @foreach ($arrayNota3 as $nota3)
                <th>{{$nota3}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados3->ESCOLA_DIAS or ""}}</th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados3->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados3->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados3->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados3->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados3->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados3->ESTADO or ""}}</p></th> 

                </tr>
                <tr>
                    <th colspan="16" style="text-align: left;">RESULTADO APOS A PROGRESSÃO PARCIAL:(&nbsp;&nbsp;&nbsp;)Plena &nbsp;&nbsp;&nbsp;Ano:</th>
                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 4 ano--> 
                <tr>                  
                    <th rowspan="7" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">
                            <p>II° FASE (&nbsp;&nbsp;{{$marcarXEjaII or ''}}&nbsp;&nbsp;) </p>        
                            <p> 4° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>4° ANO (&nbsp;&nbsp;{{$marcarX4 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>                                         </th>
                </tr> 
                <th>Notas</th>
                @if($testeEja2)
                @foreach ($arrayNota4 as $nota4)
                <th>{{$nota4}}</th>
                @endforeach  
                @else
                @foreach ($arrayNotaEjaII as $notaEjaII)
                <th>{{$notaEjaII}}</th>
                @endforeach  
                @endif
                <tr>     
                    <th>CH</th>
                    <th class="numero">
                        @if ($testeEja2)
                        {{$aluno_historico_dados4->ESCOLA_DIAS or ""}}
                        @else
                        {{$aluno_historico_dadosEjaII->ESCOLA_DIAS or ""}}
                        @endif
                    </th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;
                        @if ($testeEja2)
                        {{$aluno_historico_dados4->ESCOLA_HORAS or ""}}
                        @else
                        {{$aluno_historico_dadosEjaII->ESCOLA_HORAS or ""}}
                        @endif
                    </th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;
                        @if ($testeEja2)
                        {{$aluno_historico_dados4->ALUNO_FREQUENCIA or ""}}%
                        @else
                        {{$aluno_historico_dadosEjaII->ALUNO_FREQUENCIA or ""}}%
                        @endif
                    </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>   
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: 
                        @if ($testeEja2)
                        {{$aluno_historico_dados4->ESCOLA or ""}} 
                        @else
                        {{$aluno_historico_dadosEjaII->ESCOLA or ""}} 
                        @endif
                    </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: 
                            @if ($testeEja2)
                            {{$aluno_historico_dados4->ANO or ""}}
                            @else
                            {{$aluno_historico_dadosEjaII->ANO or ""}}
                            @endif
                        </p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: 
                            @if ($testeEja2)
                            {{$aluno_historico_dados4->CIDADE or ""}}
                            @else
                            {{$aluno_historico_dadosEjaII->CIDADE or ""}}
                            @endif
                        </p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: 
                            @if ($testeEja2)                            
                            {{$aluno_historico_dados4->ESTADO or ""}}
                            @else
                            {{$aluno_historico_dadosEjaII->ESTADO or ""}}
                            @endif
                        </p></th> 
                </tr>
                <tr>
                    <th colspan="16" style="text-align: left;">RESULTADO APOS A PROGRESSÃO PARCIAL:(&nbsp;&nbsp;&nbsp;)Plena &nbsp;&nbsp;&nbsp;Ano:</th>
                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 5 ano--> 
                <tr>                  
                    <th rowspan="7" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">                               
                            <p> 5° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>5° ANO (&nbsp;&nbsp;{{$marcarX5 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>                                         </th>
                </tr> 
                <th>Notas</th>
                @foreach ($arrayNota5 as $nota5)
                <th>{{$nota5}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados5->ESCOLA_DIAS or ""}}</th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados5->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados5->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados5->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados5->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados5->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados5->ESTADO or ""}}</p></th> 
                </tr>
                <tr>
                    <th colspan="16" style="text-align: left;">RESULTADO APOS A PROGRESSÃO PARCIAL:(&nbsp;&nbsp;&nbsp;)Plena &nbsp;&nbsp;&nbsp;Ano:</th>
                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 6 ano--> 
                <tr>                  
                    <th rowspan="7" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">   
                            <p>III FASE (&nbsp;&nbsp;{{'' or ''}}&nbsp;&nbsp;) </p>                            
                            <p> 6° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>6° ANO (&nbsp;&nbsp;{{$marcarX6 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>             
                    </th>
                </tr> 
                <th>Notas</th>                
                @foreach ($arrayNota6 as $nota6)
                <th>{{$nota6}}</th>
                @endforeach  

                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados6->ESCOLA_DIAS or ""}}</th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados6->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados6->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados6->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados6->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados6->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados6->ESTADO or ""}}</p></th> 

                </tr>
                <tr>
                    <th colspan="16" style="text-align: left;">RESULTADO APOS A PROGRESSÃO PARCIAL:(&nbsp;&nbsp;&nbsp;)Plena &nbsp;&nbsp;&nbsp;Ano:</th>
                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 7 ano--> 
                <tr>                  
                    <th rowspan="6" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">   
                            <p> 7° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>7° ANO (&nbsp;&nbsp;{{$marcarX7 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>             
                    </th>
                </tr> 
                <th>Notas</th>                
                @foreach ($arrayNota7 as $nota7)
                <th>{{$nota7}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados7->ESCOLA_DIAS or ""}}</th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados7->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados7->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados7->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados7->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados7->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados7->ESTADO or ""}}</p></th> 

                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 8 ano--> 
                <tr>                  
                    <th rowspan="7" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;"> 
                            <p>IV° FASE (&nbsp;&nbsp;{{'' or ''}}&nbsp;&nbsp;) </p>                       
                            <p> 8° SÉRIE (&nbsp;&nbsp;&nbsp;&nbsp;) </p>
                            <p>8° ANO (&nbsp;&nbsp;{{$marcarX8 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>             
                    </th>
                </tr> 
                <th>Notas</th>                
                @foreach ($arrayNota8 as $nota8)
                <th>{{$nota8}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados8->ESCOLA_DIAS or ""}}</th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados8->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados8->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados8->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados8->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados8->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados8->ESTADO or ""}}</p></th> 
                </tr>
                <tr>
                    <th colspan="16" style="text-align: left;">RESULTADO APOS A PROGRESSÃO PARCIAL:(&nbsp;&nbsp;&nbsp;)Plena &nbsp;&nbsp;&nbsp;Ano:</th>
                </tr>
                <!--//-->
                <!--//-->
                <!--Começo do 9 ano--> 
                <tr>                  
                    <th rowspan="6" >
                        <div class="disciplina margin_p" style="min-height: 18mm !important;">                          
                            <p>9° ANO (&nbsp;&nbsp;{{$marcarX9 or ''}}&nbsp;&nbsp;) </p>                        
                        </div>             
                    </th>
                </tr> 
                <th>Notas</th>                
                @foreach ($arrayNota9 as $nota9)
                <th>{{$nota9}}</th>
                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero">{{$aluno_historico_dados9->ESCOLA_DIAS or ""}}</th>
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
                    <th colspan="3" class="texto">&nbsp;Horas letivas:&nbsp;{{$aluno_historico_dados9->ESCOLA_HORAS or ""}}</th>
                    <th colspan="3" class="texto">&nbsp;Frequência:&nbsp;{{$aluno_historico_dados9->ALUNO_FREQUENCIA or ""}} %</th>
                    <th colspan="3" class="texto">&nbsp;Progressão Plena &nbsp;(&nbsp; ) </th>
                    <th colspan="3" class="texto">&nbsp;Progressão Parcial &nbsp;( &nbsp;)</th>
                    <th colspan="4" class="texto">&nbsp;Reprovado&nbsp;( &nbsp;)</th>
                </tr>  
                <tr>
                    <th colspan="16" class="texto">&nbsp;Estabelcimento: {{$aluno_historico_dados9->ESCOLA or ""}} </th> 
                </tr>
                <tr>
                    <th colspan="4" class="texto"><p>&nbsp;Ano: {{$aluno_historico_dados9->ANO or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Cidade: {{$aluno_historico_dados9->CIDADE or ""}}</p></th> 
                    <th colspan="6" class="texto"><p>&nbsp;Estado: {{$aluno_historico_dados9->ESTADO or ""}}</p></th> 

                </tr>    
            </table>
            <p style="text-align: center; margin: 0 auto;  margin-top: 6px; font-size: 10px" >REGISTRO DA PROGRESSÃO PARCIAL E EXAME ESPECIAL</p>
            <style>
                .tb_dois{
                    border: solid black thin;    
                    font-size: 9px;  
                    width: 1cm;   
                    border-bottom-width: 0px;
                    border-left-width: 0px;   
                    height: 4.1mm !important;

                }   

            </style>
            <table width="100%" cellspacing="0" style="border: solid thin black;">
                <tr>
                    <th class="tb_dois">ANO</th>
                    <th>SÉRIE</th>
                    <th>DISCIPLINA</th>              
                    <th>NOTA</th>
                    <th>RESULTADO</th>
                    <th>UNIDADE DE ENSINO</th>              
                </tr>     
                <tr>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
                    <td class="tb_dois">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> </td>
                    <td class="tb_dois"> </td>
                    <td class="tb_dois"> </td>        
                </tr>
                <tr>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"></td>
                    <td class="tb_dois"></td>
                    <td class="tb_dois"></td>                 
                </tr>
                <tr>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"></td>
                    <td class="tb_dois"></td>
                    <td class="tb_dois"></td>                 
                </tr>
                <tr>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                    <td class="tb_dois"></td>
                    <td class="tb_dois"></td>
                    <td class="tb_dois"></td>                
                </tr>
            </table>
            <p style="margin: auto; font-size: 12px;  text-align: center; ">Alagoinha,&nbsp; {{$dia or ''}} &nbsp;de &nbsp;{{$mes or ''}} &nbsp; de &nbsp; {{$ano or ''}} .</p>       
            <div class = "rodape">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Secretário - Registro ou Matrícula
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>
            <div class= "rodape">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Diretor - Registro ou Matrícula
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>
        </div>      
    </body>
</html>
