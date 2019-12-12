<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Arquivo</title>
        <style>
            .pasta{width: 54px!important; margin-left: 8px}
            .checkbox{display: inline-block !important; }
            .tb_nova{width: 80% !important;}
            .excluir2{display: none}
        </style>
    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        @include('msg')
        <script>
            $(document).ready(function () {
                $(".checkbox").wrap("<span style='background-color:#d9534f;padding: 4px; border-radius: 3px;padding-top: 13px;padding-bottom: 1px !important;'>");
                $(".PastaCheckbox").wrap("<span style='background-color:#f0ad4e;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
            });
        </script>
        {!! Form::open(['route' => 'arquivos.store','class' => 'form-horizontal','name' => 'form1'])!!} 
        <h4 style=" text-align: center; margin-top: 24px">Arquivo Passivo</h4>
        
        <div class="container-fluid">
            <div class="col-sm-12 ">
                <div class="col-sm-4 " style="margin-bottom: 12px "><button type="button" id="adicionar" class=" btn btn-primary btn-block">Habilitar/Desab. Nova Pasta</button></div> 
                <div class="col-sm-4 " style="margin-bottom: 12px "><button type="button" id="editar" class=" btn btn-warning btn-block">Habilitar/Desab. Edição de Pasta</button></div>
                <div class="col-sm-4 " style="margin-bottom: 12px "><button type="button" id="excluir" class=" btn btn-danger btn-block">Habilitar/Desab. Exclusão de Pasta</button></div>
            </div>
        </div>

        <div class="container">
            <div class="col-sm-12 "  style="margin-top: 12px ">
                <button type="submit" name="botao" value="excluir" class=" excluir2 btn btn-danger btn-block">Salar Alterações</button>
                <button type="submit" name="botao" value="adicionar" class="adicionar2 btn btn-primary btn-block">Salva Nova Pasta</button>
                <button type="submit" name="botao" value="editar" class="editar2 btn btn-warning btn-block">Editar Pasta</button>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".excluir2").hide();
                $(".adicionar2").hide();
                $(".editar2").hide();
                //
                $("#excluir").click(function () {
                    $(".excluir2").toggle(2000);
                  

                });
                //
                $("#adicionar").click(function () {
                    $(".adicionar2").toggle(2000);
                    $(".adicionar3").toggle(2000);
                   // $("#original").toggle(2000);
                    //
                    var teste = $("#teste").hasClass("tb_nova");
                    if (teste) {
                        $(".tb_nova").attr('disabled', 'disabled');
                    } else {
                        $('#details-table').removeAttr('disabled');

                    }
                    //           
                });
                //
                $("#editar").click(function () {
                    $(".editar2").toggle(2000);
                    $(".editar3").toggle(2000);
                    $("#original").toggle(2000);

                });
                //
            });
        </script>  

        <div class="container">           
            <div class="col-md-4 " style=" margin-top: 12px" id="original">
                <table  class= "table table-striped table-bordered " style="width:100%;" cellspacing="0" >
                    <thead>
                        <tr>  
                            <th>PASTAS</th>
                            <th>CHEIA</th>   
                            <th style="width: 110px " class="excluir2">EXCLUIR</th>                    
                        </tr>                      
                    </thead>
                    <tbody>
                        @foreach($pastas as $key => $pasta)
                        <tr> 
                            <td>{{$pasta->PASTA}}</td>
                            <td>                             
                                @if($pasta->CHEIA == 'SIM')
                                <p>SIM</p>
                                @else
                                <p>NÃO</p>
                                @endif
                            </td>
                            <td class="excluir2"><input class="checkbox" type="checkbox" name="checkbox[]" value="{{$pasta->id}}"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>

            <div class="col-md-4 " style="margin-top:12px">
                <div class="table-responsive">
                    <table id = "details-table" class= "table table-hover table-striped adicionar3" style="display: none ">
                        <tbody>
                            <tr>  
                                <th class=""> &nbsp;&nbsp;PASTAS</th>
                                <th class="">CHEIA</th>                     
                                <th class="actions"><button type="button" title="Adicionar Linha" onclick="return addRow()" class="btn btn-primary glyphicon glyphicon-plus-sign"></button></th>                     
                            </tr>                      
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-md-4 " style=" margin-top: 12px">
                <table  class= "table table-striped table-bordered editar3" style="width:100%; display: none" cellspacing="0" >
                    <thead>
                        <tr>  
                            <th>PASTAS</th>
                            <th>CHEIA</th>                     
                            <!--<th style="width: 110px " class="excluir2"><input type='checkbox'  class = 'selecionar '/> &nbsp;&nbsp;EXCLUIR</th>-->                     
                        </tr>                       
                    </thead>
<!--                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>-->
                    <tbody>
                        @foreach($pastas as $key => $pasta)
                        <tr>
                            <td><input class="PastaCheckbox" type="checkbox" name="PastaCheckbox[]" value="{{$pasta->id}}/{{$key}}">
                                <input class="pasta" type="text" name="PASTA[]" id="{{$pasta->id}}" value="{{$pasta->PASTA}}">
                            </td>
                            <td>                               
                                <select name="CHEIA[]" class="form-control">
                                    @if($pasta->CHEIA == 'SIM')
                                    <option selected="">SIM</option>
                                    <option>NAO</option>
                                    @else
                                    <option selected="">NAO</option>
                                    <option>SIM</option>
                                </select>                           
                                @endif
                            </td>
                            <!--<td class="excluir2"><input class="checkbox" type="checkbox" name="checkbox[]" value="{{$pasta->id}}"></td>-->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--            <div class="col-md-4 " style="margin-top:12px">
                            <div class="table-responsive">
                                <table id = "details-table" class= "table table-hover table-striped adicionar3" style="display: none ">
                                    <tbody>
                                        <tr>  
                                            <th class=""> &nbsp;&nbsp;PASTAS</th>
                                            <th class="">CHEIA</th>                     
                                            <th class="actions"><button type="button" title="Adicionar Linha" onclick="return addRow()" class="btn btn-primary glyphicon glyphicon-plus-sign"></button></th>                     
                                        </tr>                      
                                    </tbody>
                                </table>
                            </div>
                        </div>-->





        </div>   
        {!! Form:: close()!!} 
        <script type="text/javascript">
            $(document).ready(function () {
                // $("#details-table").hide();
                $("#btn-add-item").click(function () {
                    $("#details-table").show(2000);
                    $('#details-table').removeAttr('disabled');
                });
                $("#bt_esc").click(function () {
                    $("#details-table").hide(5000);
                    $(".tb_nova").attr('disabled', 'disabled');


                });
            });
        </script>  
        <script>
            (function ($) {
                var counter = -1;
                addRow = function () {
                    $("#details-table").show(2000);

                    var table = $('#details-table');
                    var input = null;

                    var row = $('<tr>');
                    var cols = [];

                    counter++;

                    // Coluna 1
                    input = $('<input>').attr('name', 'data[PASTA][' + counter + '][pasta]').attr('id', 'teste').prop('required', true).addClass('form-control tb_nova').val(counter);
                    cols.push(
                            $('<td>').append(
                            $('<div>').addClass('form-group').append(input)
                            )
                            );

                    // Coluna 2
                    //  input = $('<input>').attr('name', 'data[ExampleItems][' + counter + '][name]').addClass('form-control tb_nova');
                    input = $('<select>').append('<option value="NAO">NÃO</option>', '<option value="SIM">SIM</option>').attr('name', 'data[CHEIA][' + counter + '][opt]').addClass('form-control tb_nova');

                    cols.push(
                            $('<td>').append(
                            $('<div>').addClass('form-group').append(input)
                            )
                            );

                    // Button Remove
                    cols.push(
                            $('<td>').addClass('actions').append(
                            $('<button>').addClass('btn btn-danger glyphicon glyphicon-trash').attr('type', 'button').attr('title', 'Remover Linha').on('click', removeRow)
                            )
                            );

                    row.append(cols);
                    table.append(row);

                    return false;
                }

                removeRow = function () {

                    var tr = $(this).closest('tr');

                    tr.fadeOut(400, function () {
                        tr.remove();
                    });

                    return false;
                }

                $('#btn-add-item').click(addRow);
            })(jQuery);
        </script>
        <script>
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
    </body>
</html>
