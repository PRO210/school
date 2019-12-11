
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Arquivo</title>
        <style>
            .pasta{width: 54px!important; margin-left: 8px}
            .checkbox{display: inline-block !important; }
            .tb_nova{width: 80% !important;}           
        </style>

    </head>
    <body>
        @include('bootstrap4')
        @include('Menu.menu')
        @include('msg')
        <script>
            $(document).ready(function () {
                $(".checkbox").wrap("<span style='background-color:#d9534f;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
                $(".PastaCheckbox").wrap("<span style='background-color:#f0ad4e;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
            });
        </script>
        {!! Form::open(['route' => 'arquivos.store','class' => 'form-horizontal','name' => 'form1'])!!} 

        <h4 style=" text-align: center; margin-top: 24px">Arquivo Passivo</h4>
        <div class="col-sm-3 "><button type="button" id="btn-add-item" class=" btn btn-primary btn-block">Adcionar Nova Pasta</button></div>
        <div class="col-sm-3 "><button type="submit" name="botao" value="adicionar" class=" btn btn-success btn-block">Salva Nova Pasta</button></div>
        <div class="col-sm-3 "><button type="submit" name="botao" value="editar" class=" btn btn-warning btn-block">Editar Pasta</button></div>
        <div class="col-sm-3 "><button type="submit" name="botao" value="excluir" class=" btn btn-danger btn-block">Excluir Pasta</button></div>
        <div class="container-fluid">           
            <div class="col-md-4 " style=" margin-top: 12px">
                <table id = "" class= " table table-striped table-bordered" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>  
                            <th>PASTAS</th>
                            <th>CHEIA</th>                     
                            <th style="width: 110px "><input type='checkbox'  class = 'selecionar '/> &nbsp;&nbsp;EXCLUIR</th>                     
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
                            <td><input class="checkbox" type="checkbox" name="checkbox[]" value="{{$pasta->id}}"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4" style="margin-top:12px">
                <div class="table-responsive">
                    <table id = "details-table" class= "table table-hover table-striped" style="display: none ">
                        <tbody>
                            <tr>  
                                <th class=""> &nbsp;&nbsp;PASTAS</th>
                                <th class="">CHEIA</th>                     
                                <th class="actions"><button type="button" title="Esconder" id="bt_esc" class="btn btn-primary glyphicon glyphicon-eye-close"></button></th>                     
                            </tr>                      
                        </tbody>
                    </table>
                </div>
            </div>





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
                    $("#details-table").hide(2000);
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
                    input = $('<input>').attr('name', 'data[PASTA][' + counter + '][pasta]').prop('required', true).addClass('form-control tb_nova').val(counter);
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
