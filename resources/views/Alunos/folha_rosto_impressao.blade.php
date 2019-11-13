<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Folha de Rosto</title>
        <link href="{{url('/assets/css/folha_rosto_impressao.css')}}" rel="stylesheet" type="text/css"/>
    
    </head>
    <body>
        <div id="div" style="position: fixed;left: 0px;top: 0px; width: 600px">            
            <div class="" style="margin-top: 12px ">
                <a href="montar_transferencia_notas.php?id=" class="btn btn-info " >Montar as Notas</a>
            </div> <br>                    
            <div class="" style="margin-top: 12px ">
                <a href="{{route('rosto_tranferencia_pdf',['id' => $transferencia->id,'turma' => $turma])}}" class="btn btn-primary">Salvar o PDF</a>                
            </div>                     
        </div>  
        <div id="inicio">
            <h3>ESCOLA TABELIÃO RAUL GALINDO SOBRINHO</h3>
            <P>Nome do Estabelecimento de Ensino</P>
        </div>
        <div id="esquerda"><p>Rua Dr. Francisco Simões,S/N,Centro.</p></div>
        <div id="direita">
            <p>Cidade: ALAGOINHA</p>
            <p id="direita_P">UF:PE</p>
        </div>

        <div id="esquerda2"><p>Ato de Funcionamento: N° 7658 em 08/10/81</p></div>
        <div id="centro"><p>D.O. de: 09/10/81</p></div>
        <div id="direita2"><p>Cadastro Escolar:M-500028</p></div>

        <div id="centro2">CERTIFICADO E HISTÓRICO ESCOLAR DO ENSINO FUNDAMENTAL</div>

        <div id="centro3">            
            <p>Pelo presente Histórico certifico que,____________________________________________________________________<span id="linha1">{{$aluno->NOME}}</span></p>
            <p>Filho (a) de:________________________________________________________________________________________<span id="linha2">{{$aluno->MAE}} &nbsp;&nbsp; {{$pai_e}} &nbsp;&nbsp;{{$aluno->PAI}} </span></p>
            <p>Nascido(a) em: &nbsp;&nbsp;{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}&nbsp;&nbsp;&nbsp;&nbsp;Cidade: {{$aluno->NATURALIDADE}}&nbsp;&nbsp;&nbsp;&nbsp;UF: {{$aluno->ESTADO}}</p>
            <p>Nacionalidade:&nbsp;&nbsp;{{$aluno->NATURALIDADE}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RG:_______________ Órgão Expedifor:_______________</p>
            <p>Concluiu o:&nbsp;&nbsp; {{$turma}}  &nbsp;&nbsp; série / ano, / fase, ou ciclo do Ensino Fundamental, nos termos da Lei Federal 9.394/96,</p>
            <p> modificada pela Lei Federal n° 11.274/2006 DOU de 06/02/2006</p>
            <br>
        </div>

        <div id="centro4">
            <div id="dentro"><P>INFORMAÇÕES COMPLEMENTARES</P></div>
            <div style=" padding-top: 8px; margin-left: 24px;"><p>Forma de Acesso:</p>
                <div style="display: inline-block;margin-top: -50px;margin-left: 35px;"><p><b>CLASSIFICAÇÃO: _______________</b></p></div> 
                <div style="display: inline-block;margin-top: -50px;margin-left: 35px;"><p><b>RECLASSIFICAÇÃO: _______________</b></p></div> 
            </div>
            <div style="display: inline-block; margin-left: 6cm;">SÉRIE &nbsp;<input type="checkbox"></div>
            <div style="display: inline-block;margin-left: 1cm;">ANO &nbsp;<input type="checkbox" ></div>
            <div style="display: inline-block;margin-left: 1cm;">FASE &nbsp;<input type="checkbox"  ></div>

            <ol>              
<!--                <li>Modalidade de Ensino: Educação de Jovens e Adultos:<span id="input">SIM<input type="checkbox"  >&nbsp;&nbsp;&nbsp;&nbsp;NÃO<input type="checkbox"  ></span></li>-->
                <li>O mínimo exigido para promoção é:6,0 e 75% de frequência do total de horas letivas.</li>
                <li>Em caso de Progressão Parcial informamos que o(a) aluno(a) nas(s)_______________ série(s) obteve Progressão Parcial na(s) disciplinas(s)
                    _________________________________________________________________________________
                    de acordo com o Regimento desta Escola que admite o regime de Progressão Parcial em até 02 disciplinas  por série.
                </li>
                <!--<li>Ciclo de Aceleração:<span id="input">SIM<input type="checkbox" >&nbsp;&nbsp;&nbsp;&nbsp;NÃO<input type="checkbox" ></span></li>-->
<!--                <li>Progressão Parcial:<span id="input">SIM<input type="checkbox" >&nbsp;&nbsp;&nbsp;&nbsp;NÃO<input type="checkbox" >&nbsp;&nbsp;&nbsp;&nbsp;N° de Disciplinas<input type="checkbox" ></span></li>-->
                <li>Participante em Seminários de Ensino Religioso:<span id="input">SIM &nbsp;<input type="checkbox" >&nbsp;&nbsp;&nbsp;NÃO&nbsp;<input type="checkbox" ></span>
                    <p><b>Base Legal:</b>Art.33 da Lei 9.394/96 modificado pela Lei 9.475 de 22/07/1996 DOU.</p>
                </li>
                <li>Dispensa de Educação Física:<span id="input">SIM &nbsp;<input type="checkbox" >&nbsp;&nbsp;&nbsp;NÃO&nbsp;<input type="checkbox" ></span>
                    <p><b>Base Legal:</b>Lei 10.793 de 01/12/2003 DOU.</p>
                </li>
            </ol>  
        </div>
        <div id="centro5">
            <div id="dentro2"><P>OBSERVAÇÕES</P></div>     
            <input type="text" class="inputobs" name="t1" value="{{$transferencia->T1}}" maxlength="100">
            <input type="text" class="inputobs" name="t2" value="{{$transferencia->T2}}" maxlength="100">
            <input type="text" class="inputobs" name="t3" value="{{$transferencia->T3}}" maxlength="100">
            <input type="text" class="inputobs" name="t4" value="{{$transferencia->T4}}" maxlength="100">
            <input type="text" class="inputobs" name="t5" value="{{$transferencia->T5}}" maxlength="100">   
            <input type="text" class="inputobs" name="t6" value="{{$transferencia->T6}}" maxlength="100">   
            <input type="text" class="inputobs" name="t7" value="{{$transferencia->T7}}" maxlength="100">  
        </div>        
    </body>
</html>
