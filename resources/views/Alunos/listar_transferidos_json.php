<!-- Modal -->          <!-- Modal -->   <!-- Modal -->          <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Atualizar Pedido</h4>
            </div>                    
            <div class="modal-body">                       
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-4 control-label">Requerente</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="ALTERE O NOME DO REQUERENTE SE DESEJAR" class="form-control" name="SOLICITANTE" id="SOLICITANTE" onkeyup="maiuscula(this)">
                        </div>                               
                    </div>  
                </div> 
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for=""  class="col-sm-4 control-label" >Status da Transferência</label>
                        <div class="col-sm-8">                                    
                            <select name="TRANSFERENCIA_STATUS" class="form-control" id="TRANSFERENCIA_STATUS">
                                <option value="ENTREGUE">ENTREGUE</option>
                                <option value="PRONTA">PRONTA</option>
                                <option value="PENDENTE">PENDENTE</option>                                        
                            </select> 
                        </div>                            
                    </div>
                </div>                   
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="" class="col-sm-4 control-label" id="labelDataEntregue">Entrega ou Pronta</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="DATA_TRANSFERENCIA_STATUS" id="DATA_TRANSFERENCIA_STATUS">
                        </div>
                    </div>  
                </div><br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-4 control-label">Declaração</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="DECLARACAO" id="DECLARACAO">                               
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputRD" class="col-sm-4 control-label">Responsável pela Declaração</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="RESPONSAVEL_DECLARACAO" name="RESPONSAVEL_DECLARACAO" value="" onkeyup="maiuscula(this)">
                        </div>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="" class="col-sm-4 control-label">Data Declaração</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="DATA_DECLARACAO" id="DATA_DECLARACAO">
                        </div>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-4 control-label">Transferência</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="TRANSFERENCIA" id="TRANSFERENCIA">                                
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-4 control-label">Responsável pela Transferência</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="RESPONSAVEL_TRANSFERENCIA" name="RESPONSAVEL_TRANSFERENCIA" onkeyup="maiuscula(this)">
                        </div>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="form-group col-sm-12">                               
                        <label for="" class="col-sm-4 control-label" id="">Data Transferência</label>
                        <div class="col-sm-8">                                    
                            <input type="date" class="form-control" name="DATA_TRANSFERENCIA" id="DATA_TRANSFERENCIA">
                        </div>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for=""  class="col-sm-4 control-label" >Status Atual do Aluno</label>
                        <div class="col-sm-8">                                  
                            <select class="form-control" name="aluno_classificacao_id" id="aluno_classificacaos_id">
                                <option value="0" disabled="">ESCOLHA UMA DAS OPÇÕES ABAIXO</option>
                                <option value="1" disabled="">APROVADO</option>
                                <option value="2">CURSANDO</option>
                                <option value="3">DESISTENTE</option>                                  
                                <option value="4">ADIMITIDO DEPOIS</option>
                                <option value="5">TRANSFERIDO</option>
                                <option value="6" disabled="">REPROVADO</option>
                            </select>                 
                        </div>                            
                    </div>
                </div>   
                <button type="submit" name ="botao" value="unico"  class="btn btn-success btn-block" onclick="return confirmar()" >Salvar as Alterações </button> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Voltar para as Solicitações</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->          <!-- Modal -->   <!-- Modal -->          <!-- Modal -->
<!--//-->
<script>
    function json() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //
        camposMarcados = new Array();
        $("input[type=checkbox][name='aluno_selecionado[]']:checked").each(function () {
            camposMarcados.push($(this).val());
            // alert(camposMarcados);
        });
        //e.preventDefault();  CAso queira impedir o submit       
        $.ajax({
            type: 'POST',
            url: 'http://localhost/laravel/school/public/alunos/solicitações/transferência/editar',
//            url: "{{url('alunos/solicitações/transferência/json')}}",Se for Blade use essa
            dataType: 'html',
            data: {
                'id': camposMarcados, _token: $('#signup-token').val()
            },
            success: function (data)
            {
                $txt = JSON.parse(data);
                for (var i in $txt) {
                    var nome = $txt[i]["NOME"];
                    var SOLICITANTE = $txt[i]["SOLICITANTE"];

                    //  var DATA_SOLICITACAO = $txt[i]["DATA_SOLICITACAO"];
                    var TRANSFERENCIA_STATUS = $txt[i]["TRANSFERENCIA_STATUS"];
                    var DATA_TRANSFERENCIA_STATUS = $txt[i]["DATA_TRANSFERENCIA_STATUS"];

                    var DECLARACAO = $txt[i]["DECLARACAO"];
                    var RESPONSAVEL_DECLARACAO = $txt[i]["RESPONSAVEL_DECLARACAO"];
                    var DATA_DECLARACAO = $txt[i]["DATA_DECLARACAO"];

                    var TRANSFERENCIA = $txt[i]["TRANSFERENCIA"];
                    var RESPONSAVEL_TRANSFERENCIA = $txt[i]["RESPONSAVEL_TRANSFERENCIA"];
                    var DATA_TRANSFERENCIA = $txt[i]["DATA_TRANSFERENCIA"];

                    var aluno_classificacaos_id = $txt[i]["aluno_classificacao_id"];
                }
                // alert(DATA_DECLARACAO);                      
                $('#SOLICITANTE').val(SOLICITANTE);
                // $('#DATA_SOLICITACAO').val(DATA_SOLICITACAO);
                $('#TRANSFERENCIA_STATUS').val(TRANSFERENCIA_STATUS);
                $('#DATA_TRANSFERENCIA_STATUS').val(DATA_TRANSFERENCIA_STATUS);
                //         
                $('#DECLARACAO').val(DECLARACAO);
                $('#RESPONSAVEL_DECLARACAO').val(RESPONSAVEL_DECLARACAO);
                $('#DATA_DECLARACAO').val(DATA_DECLARACAO);
                //
                $('#TRANSFERENCIA').val(TRANSFERENCIA);
                $('#RESPONSAVEL_TRANSFERENCIA').val(RESPONSAVEL_TRANSFERENCIA);
                $('#DATA_TRANSFERENCIA').val(DATA_TRANSFERENCIA);
                //              
                document.getElementById("aluno_classificacaos_id").selectedIndex = aluno_classificacaos_id;
//                $('#aluno_classificacaos_id :selected').text(aluno_classificacaos_id);

            },
            error: function () {
                alert('Erro');
            }
        });
    }
    ;
</script>
<script type="text/javascript">
    $('input[type=checkbox]').on('change', function () {
        var total = $('input[type=checkbox]:checked').length;
        if (total > 0) {
//alert(total);
            $('#btEditBloc').removeAttr('disabled');
        } else {
            $('#btEditBloc').attr('disabled', 'disabled');
        }
        //
        if (total === 1) {
            $('.btvalida').removeAttr('disabled');
        } else {
            $('.btvalida').attr('disabled', 'disabled');
        }
    });
</script>
<script type="text/javascript">
//Marcar ou Desmarcar todos os checkbox
    $(document).ready(function () {
        $('.selecionar').click(function () {
            if (this.checked) {
                $('.checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    });
</script>
<script type="text/javascript">
    // INICIO FUNÇÃO DE MASCARA MAIUSCULA
    function maiuscula(z) {
        v = z.value.toUpperCase();
        z.value = v;
    }
</script>
<!--Confimar se pode Salvar-->
<script type="text/javascript">
    function confirmar() {
        var u = $('#usuario_logado').val();
        var r = confirm("Já Posso Enviar " + u + "? ");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>