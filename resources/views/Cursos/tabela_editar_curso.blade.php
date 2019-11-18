<script>
    $(document).ready(function () {
        //Data Table
        var table = $('#example').DataTable({
            //
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }],
            "lengthMenu": [[10, 15, 20, 100, -1], [10, 15, 20, "All"]],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Nenhum aluno encontrado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ total de Disciplinas)",
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
    });
</script>
<!--<script type="text/javascript">
    $(document).ready(function () {
        $(".BOLETIM").hide('slow');
        $('.BOLETIM_ORD').hide('slow');
//        $('table td:nth-child(4)').css("display", "none");
        $('#btBoletim').click(function () {
            var ativar = $("#btBoletim").hasClass("ativar");
            if (ativar) {
                $("#btBoletim").removeClass("btn-warning ativar");
                $("#btBoletim").addClass("btn-primary desativar");
                $(".BOLETIM").show('slow');
                $('.BOLETIM_ORD').show('slow');
            } else {
                $("#btBoletim").removeClass("btn-primary desativar");
                $("#btBoletim").addClass("btn-warning ativar");
                $(".BOLETIM").hide('slow');
                $('.BOLETIM_ORD').hide('slow');
            }
        });
    });
</script> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".FICHA_DESCRITIVA").hide('slow');
        $('#btFICHA_DESCRITIVA').click(function () {
            var ativar_FICHA_DESCRITIVA = $("#btFICHA_DESCRITIVA").hasClass("ativar_FICHA_DESCRITIVA");
            if (ativar_FICHA_DESCRITIVA) {
                $("#btFICHA_DESCRITIVA").removeClass("btn-warning ativar_FICHA_DESCRITIVA");
                $("#btFICHA_DESCRITIVA").addClass("btn-primary desativar_FICHA_DESCRITIVA");
                $(".FICHA_DESCRITIVA").show('slow');
                $('.FICHA_DESCRITIVA').show('slow');
            } else {
                $("#btFICHA_DESCRITIVA").removeClass("btn-primary desativar_FICHA_DESCRITIVA");
                $("#btFICHA_DESCRITIVA").addClass("btn-warning ativar_FICHA_DESCRITIVA");
                $(".FICHA_DESCRITIVA").hide('slow');
                $('.FICHA_DESCRITIVA').hide('slow');
            }
        });
    });
</script> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".ATA").hide('slow');
        $('#btATA').click(function () {
            var ativar_FICHA_DESCRITIVA = $("#btATA").hasClass("ativar_ATA");
            if (ativar_FICHA_DESCRITIVA) {
                $("#btATA").removeClass("btn-warning ativar_ATA");
                $("#btATA").addClass("btn-primary desativar_ATA");
                $(".ATA").show('slow');
                $('.ATA').show('slow');
            } else {
                $("#btATA").removeClass("btn-primary desativar_ATA");
                $("#btATA").addClass("btn-warning ativar_ATA");
                $(".ATA").hide('slow');
                $('.ATA').hide('slow');
            }
        });
    });
</script> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".BNC").hide('slow');
        $('#btBNC').click(function () {
            var ativar_FICHA_DESCRITIVA = $("#btBNC").hasClass("ativar_BNC");
            if (ativar_FICHA_DESCRITIVA) {
                $("#btBNC").removeClass("btn-warning ativar_BNC");
                $("#btBNC").addClass("btn-primary desativar_BNC");
                $(".BNC").show('slow');
                $('.BNC').show('slow');
            } else {
                $("#btBNC").removeClass("btn-primary desativar_BNC");
                $("#btBNC").addClass("btn-warning ativar_BNC");
                $(".BNC").hide('slow');
                $('.BNC').hide('slow');
            }
        });
    });
</script> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".CH").hide('slow');
        $('#btCH').click(function () {
            var ativar_FICHA_DESCRITIVA = $("#btCH").hasClass("ativar_CH");
            if (ativar_FICHA_DESCRITIVA) {
                $("#btCH").removeClass("btn-warning ativar_CH");
                $("#btCH").addClass("btn-primary desativar_CH");
                $(".CH").show('slow');
                $('.CH').show('slow');
            } else {
                $("#btCH").removeClass("btn-primary desativar_CH");
                $("#btCH").addClass("btn-warning ativar_CH");
                $(".CH").hide('slow');
                $('.CH').hide('slow');
            }
        });
    });
</script> -->