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
                "lengthMenu": "_MENU_ @can('EDITAR_ALUNOS')<?php
echo "&nbsp;<a href='turmas/create' target='_self' class = 'btn btn-success'><span class = 'glyphicon glyphicon-plus'>&nbsp;Cadastrar</span></a>"
 . "&nbsp;<button type='submit' name ='botao' value='varios'  class='btn btn-primary btn-block ' style= 'display: inline-block !important; width:auto !important;' onclick='return confirmarAtualizacao()' id = 'btEditBloc' title = 'Selecione ao menos uma Disciplina' disabled>Atualizar Vários</button>"
;
?>@endcan      ",
                "zeroRecords": "Nenhum aluno encontrado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ total de Turmas)",
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

    $('input[type=checkbox]').on('change', function () {
        var total = $('input[type=checkbox]:checked').length;
        if (total > 0) {
//alert(total);
            $('#btEditBloc').removeAttr('disabled');
        } else {
            $('#btEditBloc').attr('disabled', 'disabled');
        }
    });

    function validaCheckbox() {
        var frm = document.form1;
        //Percorre os elementos do formulário
        for (i = 0; i < frm.length; i++) {
            //Verifica se o elemento do formulário corresponde a um checkbox 
            if (frm.elements[i].type == "checkbox") {
                //Verifica se o checkbox foi selecionado
                if (frm.elements[i].checked) {
                    // alert("Exite ao menos um checkbox selecionado!");
                    return true;
                }
            }
        }
        alert("Nenhuma Turma  foi selecionada!");
        return false;
    }
//function verificarCheckBox() {
//    var check = document.getElementsByName("itemCheck"); 
//
//    for (var i=0;i<check.length;i++){ 
//        if (check[i].checked == true){ 
//            // CheckBox Marcado... Faça alguma coisa...
//
//        }  else {
//           // CheckBox Não Marcado... Faça alguma outra coisa...
//        }
//    }
//}
//Confirmar se pode deletar
    function deletar() {
        var u = $('#usuario').val();
        var r = confirm("Já Posso Enviar " + u + "? ");

        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
