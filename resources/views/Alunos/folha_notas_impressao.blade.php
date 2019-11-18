<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Notas Impressão</title>
        <style>            
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
                            <p> 1° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                            <p>1° ANO (&nbsp;&nbsp;) </p>                         
                        </div>                     
                    </th>
                </tr> 
                <th>Notas</th>
                @foreach ($arrayNota as $nota)
                <th>{{$nota}}</th>


                @endforeach  
                <tr>     
                    <th>CH</th>
                    <th class="numero"></th>
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










            </table>
        </div>      
    </body>
</html>
